<?php

namespace SaftyFirst;
class Board2
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
            if ($this->board[$x][$y] != 0) {
                $result[] = $this->board[$x][$y];
            }
        }
        return $result;
    }

    public function numbersInCol(int $y): array
    {
        $result = [];
        for ($x = 1; $x <= 9; $x++) {
            if ($this->board[$x][$y] != 0) {
                $result[] = $this->board[$x][$y];
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
                $currentLine = array_values($diffArray);

                //Hier wird die Zeile beschrieben wenn sie 0 ist
                $z = 0;
                for ($i = 1; $i <= 9; $i++) {
                    if ($this->getBoardXY($position, $i) == 0) {
                        $this->setNumberByPosition($position, $i, $currentLine[$z]);
                        $z++;
                    }
                }
                //Beschriebene Zeile aus dem Zeilen-Verzeichnis löschen
                unset($this->row[$posInArray]);
                $this->row = array_values($this->row);


            } else {
                //Hier wird die Spalte nach bereits bestehenden Zahlen abgesucht
                $position = $this->col[$posInArray];
                $diffArray = array_diff($this->basisLine, $this->numbersInCol($position));
                $currentLine = array_values($diffArray);

                // Hier wird die Spalte beschrieben wenn sie 0 ist
                $z = 0;
                for ($i = 1; $i <= 9; $i++) {
                    if ($this->getBoardXY($i, $position) == 0) {
                        $this->setNumberByPosition($i, $position, $currentLine[$z]);
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