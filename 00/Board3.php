<?php

namespace SaftyFirst;
class Board3
{
    /**
     * @var array[]
     */
    private array $board = [];
    /**
     * @var int[]
     */
    private array $basisLine = [];
    /**
     * @var array
     */
    private array $row = [];
    /**
     * @var array
     */
    private array $col = [];
    /**
     * @var int
     */
    private int $level;
    /**
     * @var int
     */
    private int $faulty;

    /**
     * Board
     */
    public function __construct()
    {
        $this->board = [
            1 => [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 8 => 0, 9 => 0],
            2 => [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 8 => 0, 9 => 0],
            3 => [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 8 => 0, 9 => 0],
            4 => [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 8 => 0, 9 => 0],
            5 => [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 8 => 0, 9 => 0],
            6 => [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 8 => 0, 9 => 0],
            7 => [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 8 => 0, 9 => 0],
            8 => [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 8 => 0, 9 => 0],
            9 => [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 8 => 0, 9 => 0]
        ];
        $this->basisLine = [1, 2, 3, 4, 5, 6, 7, 8, 9];
        $this->row = [1, 2, 3, 4, 5, 6, 7, 8, 9];
        $this->col = [1, 2, 3, 4, 5, 6, 7, 8, 9];
        $this->level = 0;
        $this->faulty = 0;
    }

    /**
     * @return array
     */
    public function getBoard(): array
    {
        return $this->board;
    }

    /**
     * @param $x
     * @param $y
     * @return int|mixed
     */
    public function getBoardXY($x, $y)
    {
        return $this->board[$x][$y];
    }

    /**
     * @param int $positionX
     * @param int $positionY
     * @param int $value
     * @return void
     */
    public function setNumberByPosition(int $positionX, int $positionY, int $value = 0): void
    {
        $this->board[$positionX][$positionY] = $value;
    }

    public function printBoard(): void
    {
        echo '<div class="board">';
        echo '<table class="table">';
        for ($i = 1; $i <= 9; $i++) {
            echo '<tr>';
            for ($j = 1; $j <= 9; $j++) {
                echo '<td class="cell"">' . (($this->board[$i][$j] != 0) ? $this->board[$i][$j] : '&nbsp;') . '</td>';
            }
            echo '</tr>';
        }
        echo '</table>';
        echo '</div>';
    }

    public function numbersInRow(int $x): array
    {
        $result = [];
        for ($y = 1; $y <= 9; $y++) {
            if ($this->getBoardXY($x, $y) !== 0) {
                $result[] = $this->getBoardXY($x, $y);
            }
        }
        return $result;
    }

    public function numbersInCol(int $y): array
    {
        $result = [];
        for ($x = 1; $x <= 9; $x++) {
            if ($this->getBoardXY($x, $y) !== 0) {
                $result[] = $this->getBoardXY($x, $y);
            }
        }
        return $result;
    }

    public function emptyFieldsInRow(int $x): array
    {
        $result = [];
        for ($y = 1; $y <= 9; $y++) {
            if ($this->getBoardXY($x, $y) === 0) {
                $result[] = $y;
            }
        }
        return $result;
    }

    public function emptyFieldsInCol(int $y): array
    {
        $result = [];
        for ($x = 1; $x <= 9; $x++) {
            if ($this->getBoardXY($x, $y) === 0) {
                $result[] = $x;
            }
        }
        return $result;
    }


    public function designPattern()
    {
        for ($j = 1; $j <= 3; $j++) {
            $coordinates = ($j % 2 != 0) ? 'row' : 'col';
            $currentArray = ($coordinates === 'row') ? $this->row : $this->col;
            $posInArray = rand(0, count($currentArray) - 1);

            shuffle($this->basisLine);

            if ($coordinates === 'row') {
                //Hier wird die Differenz aus $basisLine und $currentLine in $currentLine gespeichert und aktualisiert
                $position = $this->row[$posInArray];
                $diffArray = array_diff($this->basisLine, $this->numbersInRow($position));
                $numericMemory = array_values($diffArray);
                $emptyFields = $this->emptyFieldsInRow($position);

                //Hier wird die Zeile beschrieben wenn sie 0 ist
                foreach ($emptyFields as $key => $valueEmptyField) {
                    $foundMatch = false;
                    foreach ($numericMemory as $key2 => $valueNumericMemoryItem) {
                        if (!in_array($valueNumericMemoryItem, $this->numbersInCol($valueEmptyField))) {
                            $this->setNumberByPosition($position, $valueEmptyField, $valueNumericMemoryItem);
                            unset($emptyFields[$key]);
                            unset($numericMemory[$key2]);
                            $foundMatch = true;
                            break;
                        }
                        if ($foundMatch) break;
                    }
                    $feld = $valueEmptyField;
                    unset($valueEmptyField);
                    unset($valueNumericMemoryItem);
                }
                echo "Position : " . $position . " Feld : " . $feld . "  " . print_r($emptyFields) . print_r($numericMemory);
                echo '<br>';

            } else {
                //Hier wird die Spalte nach bereits bestehenden Zahlen abgesucht
                $position = $this->col[$posInArray];
                $diffArray = array_diff($this->basisLine, $this->numbersInCol($position));
                $numericMemory = array_values($diffArray);

                // Hier wird die Spalte beschrieben wenn sie 0 ist
                $z = 0;
                for ($i = 1; $i <= 9; $i++) {
                    if ($this->getBoardXY($i, $position) == 0) {
                        $this->setNumberByPosition($i, $position, $numericMemory[$z]);
                        $z++;
                    }
                }
                //Beschriebene Spalten aus dem Spaltenverzeichnis löschen
                unset($this->col[$posInArray]);
                $this->col = array_values($this->col);
            }

        }

    }

}