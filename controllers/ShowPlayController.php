<?php
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

        if(isset($delivery['note']) && $delivery['note'] == 1){
            $_SESSION['note'] = 1;
        } else {
            $_SESSION['note'] = 0;
        }

        $game = new Game();

        if (isset($delivery['field']) && isset($delivery['number'])) {
            list($row, $col) = $game->getPosRowCol($delivery['field']);
            if (!isset($delivery['note'])) {
                if ($game->isCellEditable($row, $col)) {
                    if ($game->isNumberCorrect($row, $col, $delivery['number'])) {
                        $game->setNumberByRowCol($row, $col, $delivery['number']);
                    } else {
                        $game->setNumberByRowCol($row, $col, $delivery['number']);
                        $game->addFaulty();
                    }
                }
            } elseif ($delivery['note'] == 1) {
                $game->addNote($row, $col, $delivery['number']);
            }

        } elseif (isset($delivery['field']) && isset($delivery['submit']) && $delivery['submit'] == 'Erase') {
            list($row, $col) = $game->getPosRowCol($delivery['field']);
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
        }

        if ($game->getFaulty() >= 3) {
            $this->view = 'lose';
        }

        return ['arrayName' => 'nothing', 'data' => $delivery];
    }

}