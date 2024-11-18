<?php
// Der Controller, der das eigentliche Spiel steuert
class ShowPlayController extends BaseController
{
    public function __construct(string $area,string $view)
    {
        parent::__construct($area);
        $this->view = $view;
    }
    /**
     * @param array $delivery
     * @return array
     */
    public function invoke(array $delivery = []) : array
    {
        $fault = false;
        // Speichert das üb
        if(isset($delivery['field'])){
            $_SESSION['field'] = $delivery['field'];
        }

        if(isset($delivery['note']) && $delivery['note'] == 1){
            $_SESSION['note'] = 1;
        } else {
            $_SESSION['note'] = 0;
        }

        $game = new Game();

        if (isset($delivery['field']) && isset($delivery['number']) || $_SESSION['field'] && isset($delivery['number'])) {
            if (isset($delivery['field'])) {
                list($row, $col) = $game->getPosRowCol($delivery['field']);
            } else {
                list($row, $col) = $game->getPosRowCol($_SESSION['field']);
            }
            if (!isset($delivery['note'])) {
                if ($game->isCellEditable($row, $col)) {
                    if ($game->isNumberCorrect($row, $col, $delivery['number'])) {
                        $game->setNumberByRowCol($row, $col, $delivery['number']);
                        $game->deleteSpezialNote($row, $col, $delivery['number']);
                    } else {
                        $game->setNumberByRowCol($row, $col, $delivery['number']);
                        $game->addFaults();
                        $fault = true;
                    }
                }
            } elseif ($delivery['note'] == 1) {
                if (!$game->isNumberSet($row, $col, $delivery['number'])) {
                    $game->addNote($row, $col, $delivery['number']);
                } else {
                    $fault = true;
                }
            }

        } elseif (isset($delivery['field']) && isset($delivery['submit']) && $delivery['submit'] == 'Erase' || $_SESSION['field'] && isset($delivery['submit']) && $delivery['submit'] == 'Erase'){
            if (isset($delivery['field'])) {
                list($row, $col) = $game->getPosRowCol($delivery['field']);
            } else {
                list($row, $col) = $game->getPosRowCol($_SESSION['field']);
            }
            if (!isset($delivery['note'])) {
                if ($game->isCellEditable($row, $col)) {
                    $game->deleteNumberByRowCol($row, $col);
                }
            } elseif ($delivery['note'] == 1) {
                $game->deleteLastNote($row, $col);
            }
        }

        $game->setSessions();

        if ($game->allNumbersCorrectSet()){
            $this->view = 'won';
            $currentTime = time();
            $elapsedTime = $currentTime - $_SESSION['startTime'];
            $minutes = floor($elapsedTime / 60);
            $seconds = $elapsedTime % 60;
            if (!isset($_SESSION['neededTime'])) {
                $_SESSION['neededTime'] = sprintf('%02d:%02d', $minutes, $seconds);
            }
        }

        if ($game->getFaults() >= 3) {
            $this->view = 'lose';
        }

        return ['arrayName' => 'fault', 'data' => $fault];
    }

}