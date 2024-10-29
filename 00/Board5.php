<?php

namespace SaftyFirst;
class Board
{
    /**
     * @var array[]
     */
    private array $board = [];

    /**
     * @var array
     */
    private array $field = [];

    /**
     * @var int[]
     */
    private array $referenceLine = [];

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
        $this->referenceLine = [1, 2, 3, 4, 5, 6, 7, 8, 9];
        for ($i = 1; $i <= 9; $i++) {
            $this->field[$i] = [];
        }
    }

    /**
     * @param $x
     * @param $y
     * @return int
     */
    public function coordsToField($x, $y): int
    {
        if ($x >= 1 && $x <= 3 && $y >= 1 && $y <= 3) $fieldNumber = 1;
        if ($x >= 4 && $x <= 6 && $y >= 1 && $y <= 3) $fieldNumber = 2;
        if ($x >= 7 && $x <= 9 && $y >= 1 && $y <= 3) $fieldNumber = 3;

        if ($x >= 1 && $x <= 3 && $y >= 4 && $y <= 6) $fieldNumber = 4;
        if ($x >= 4 && $x <= 6 && $y >= 4 && $y <= 6) $fieldNumber = 5;
        if ($x >= 7 && $x <= 9 && $y >= 4 && $y <= 6) $fieldNumber = 6;

        if ($x >= 1 && $x <= 3 && $y >= 7 && $y <= 9) $fieldNumber = 7;
        if ($x >= 4 && $x <= 6 && $y >= 7 && $y <= 9) $fieldNumber = 8;
        if ($x >= 7 && $x <= 9 && $y >= 7 && $y <= 9) $fieldNumber = 9;

        return $fieldNumber;
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
    public function getBoardXY($x, $y): int
    {
        return $this->board[$x][$y];
    }

    /**
     * @param $x
     * @param $y
     * @param $value
     * @return void
     */
    public function setBoardXY($x, $y, $value): void
    {
        $this->board[$x][$y] = $value;
    }

    /**
     * @param int $positionX
     * @param int $positionY
     * @param int $value
     * @return void
     */
    public function setNumberByPosition(int $position, int $cell, int $value = 0): void
    {
        $this->board[$position][$cell] = $value;
    }

    /**
     * @return void
     */
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

    /**
     * @return int[]
     */
    public function getReferenceLine(): array
    {
        shuffle($this->referenceLine);
        return $this->referenceLine;
    }

    /**
     * @param string $section
     * @param int $position
     * @return array
     */
    public function freeNumbersInCrossLine(int $position): array
    {
        $output = [];
        for ($i = 1; $i <= 9; $i++) {
            if ($this->getBoardXY($i, $position) !== 0) {
                $output[] = $this->getBoardXY($i, $position);
            }
        }
        return array_diff($this->getReferenceLine(), $output);
    }

    /**
     * @param string $section
     * @param int $position
     * @param int $swapCell
     * @param int $lastCell
     * @param int $lastNumber
     * @return void
     */
    public function swapNumbers(int $position, int $swapCell, int $lastCell, int $lastNumber): void
    {
        $this->setBoardXY($position, $lastCell, $this->getBoardXY($position, $swapCell));
        $this->setBoardXY($position, $swapCell, $lastNumber);
    }

    public function insertNumberInField(int $fieldNumber, int $value): void
    {
        $this->field[$fieldNumber][] = $value;
    }

    public function deleteNumberInField(int $field, int $value): void
    {
        if (($key = array_search($value, $this->field[$field])) !== false) {
            unset($this->field[$field][$key]);
        }
    }

    /**
     * @return void
     */
    public function designPattern()
    {
        $lastCols = [];
        for ($row = 1; $row <= 9; $row++) {

            // Liste der Zahlen, die in dieser Reihe gesetzt werden sollen
            $freeNumbers = $this->getReferenceLine();
            echo "ROW : $row<br>";

            // Iteriere durch jede Spalte in der aktuellen Reihe
            for ($col = 1; $col <= 9; $col++) {
                $set = false;
                foreach ($freeNumbers as $key => $number) {
                    if (in_array($number, $this->freeNumbersInCrossLine($col)) &&
                        !in_array($number, $this->field[($this->coordsToField($row, $col))])) {

                        // Zahl setzen und aus $freeNumbers entfernen
                        $this->insertNumberInField($this->coordsToField($row, $col), $number);
                        $this->setNumberByPosition($row, $col, $number);
                        unset($freeNumbers[$key]);
                        echo "gesetzt wird $number <br>";
                        $set = true;
                        break;
                    } else {
                        echo " Die $number konnte nicht gesetzt werden<br>";
                    }
                }
                // Falls keine Zahl gesetzt wurde, setze $lastCol
                if (!$set) $lastCols[] = $col;
            }
            echo "Folgende Positionen konnten nicht gesetzt werden ";
            foreach ($lastCols as $col) {
                echo " " . $col . " ";
            }
            // Falls noch freie Zahlen übrig sind, tausche die Zahl
            if (count($freeNumbers) > 0) {
                foreach ($lastCols as $lastCol) {
                    $lastNumber = end($freeNumbers);
                    echo "<br>Hier wird versucht zu korrigieren<br>";

                    // Versuche eine passende Position für die letzte Zahl in der Reihe zu finden
                    for ($col = 9; $col >= 1; $col--) {
                        if (in_array($lastNumber, $this->freeNumbersInCrossLine($col)) &&
                            in_array($this->getBoardXY($row, $col), $this->freeNumbersInCrossLine($lastCol)) &&
                            !in_array($lastNumber, $this->field[($this->coordsToField($row, $col))])) {
                            $this->deleteNumberInField($row, $col);
                            // Tausche die letzte Zahl in der Zelle $lastCol mit einer passenden Zahl
                            $this->swapNumbers($row, $col, $lastCol, $lastNumber);

                            //$this->insertNumberInField($this->coordsToField($row, $col), $lastNumber);
                            echo "Hier wird korrigiert<br>";
                            //print_r($lastCols);
                            break;
                        }
                    }
                }

            }
            $lastCols = [];
            echo "<br>";
            echo "<br>";
        }
        print_r($freeNumbers);
        // Prüfen, ob noch eine Zahl auf 0 im Board steht
        $containsZero = false;
        foreach ($this->getBoard() as $row) {
            if (in_array(0, $row)) {
                $containsZero = true;
                break;
            }
        }

        //} while ($containsZero);
    }


}