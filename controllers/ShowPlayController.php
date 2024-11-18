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
        // Speichert das markierte Feld (Zelle) in der SESSION. Das "value" des "id=hiddenField" oder
        // "name=field" wird durch JavaScript gesetzt.
        if(isset($delivery['field'])){
            $_SESSION['field'] = $delivery['field'];
        }

       // Prüft ob der "Notieren-Schalter" gesetzt ist und schaltet ihn um.
        if(isset($delivery['note']) && $delivery['note'] == 1){
            $_SESSION['note'] = 1;
        } else {
            $_SESSION['note'] = 0;
        }

        $game = new Game();

        // Sofern ein "Feld"-Kennzahl per Array übertragen wird oder eine per SESSION besteht und
        // eine Zahl übertragen wurde erfolgt:
        if (isset($delivery['field']) && isset($delivery['number']) || $_SESSION['field'] && isset($delivery['number'])) {
            if (isset($delivery['field'])) {
                // Zeile und Spalte wird errechnet aus dem Field aus dem Array.
                list($row, $col) = $game->getPosRowCol($delivery['field']);
            } else {
                // Zeile und Spalte wird errechnet aus dem Field aus der SESSION.
                list($row, $col) = $game->getPosRowCol($_SESSION['field']);
            }
            // Wenn "note" nicht per Array übertragen wird
            if (!isset($delivery['note'])) {
                // Prüf, ob die Zelle bestandteil des Sudoku ist und nicht zur Maske gehört.
                if ($game->isCellEditable($row, $col)) {
                    // Vergleicht die eingegebene Zahl mit dem "Board" an Position X/Y
                    // und gibt "true" zurück, wenn sie richtig ist.
                    if ($game->isNumberCorrect($row, $col, $delivery['number'])) {
                        // Schreibt die Zahl in das Sudoku an Position X/Y.
                        $game->setNumberByRowCol($row, $col, $delivery['number']);
                        // Sorgt dafür, dass alle Notizen der gesetzten Zahl aus den Zeilen,
                        // Spalten und dem Feld gelöscht werden.
                        $game->deleteSpezialNote($row, $col, $delivery['number']);
                    } else {
                        // Wenn die Zahl nicht korrekt ist, wird sie trotzdem geschrieben. Das kann man alternativ
                        // auch auskommentieren. Je nach Vorliebe.
                        $game->setNumberByRowCol($row, $col, $delivery['number']);
                        // Der Fehler wird um 1 erhöht.
                        $game->addFaults();
                        // "fault" wird auf "true" gesetzt, um den "Error-Sound" auszulösen
                        $fault = true;
                    }
                }
            // Wenn "note" gleich 1 ist und per Array übertragen wird.
            } elseif ($delivery['note'] == 1) {
                if (!$game->isNumberSet($row, $col, $delivery['number'])) {
                    // Wenn die Zahl nicht in Zeile, Spalte oder Feld bereits vorhanden ist, speichere sie als Notiz
                    $game->addNote($row, $col, $delivery['number']);
                } else {
                    // "fault" wird auf "true" gesetzt, um den "Error-Sound" auszulösen
                    $fault = true;
                }
            }
        // Die Logik des Löschvorgangs.
        } elseif (isset($delivery['field']) && isset($delivery['submit']) && $delivery['submit'] == 'Erase' || $_SESSION['field'] && isset($delivery['submit']) && $delivery['submit'] == 'Erase'){
            if (isset($delivery['field'])) {
                // Zeile und Spalte wird errechnet aus dem Field aus dem Array.
                list($row, $col) = $game->getPosRowCol($delivery['field']);
            } else {
                // Zeile und Spalte wird errechnet aus der SESSION.
                list($row, $col) = $game->getPosRowCol($_SESSION['field']);
            }
            // Wenn "note" nicht aktiviert ist.
            if (!isset($delivery['note'])) {
                // Und die Zelle Editierbar ist.
                if ($game->isCellEditable($row, $col)) {
                    // Wird die Zelle auf 0 gesetzt.
                    $game->deleteNumberByRowCol($row, $col);
                }
            // Wenn "note" existiert und gleich 1 ist.
            } elseif ($delivery['note'] == 1) {
                // Wird der letzte Eintrag des "note"-Arrays gelöscht
                $game->deleteLastNote($row, $col);
            }
        }

        // Alle SESSIONS werden neu gesetzt.
        $game->setSessions();

        // Prüft, ob das Spiel gewonnen ist.
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

        // Prüft, ob das Spiel verloren ist
        if ($game->getFaults() >= 3) {
            $this->view = 'lose';
        }

        //Gibt die Anzahl der Fehler per Array zurück
        return ['arrayName' => 'fault', 'data' => $fault];
    }

}