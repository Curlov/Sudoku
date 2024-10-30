<?php

class Board
{
    public int $solutionCount = 0;
    /**
     * @var array
     */
    private array $mask = [];
    /**
     * @var array[]
     */
    private array $board = [];

    /**
     * @var array
     */
    private array $field = [];

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

        $this->field[1] = [[1, 1], [2, 1], [3, 1], [1, 2], [2, 2], [3, 2], [1, 3], [2, 3], [3, 3]];
        $this->field[2] = [[4, 1], [5, 1], [6, 1], [4, 2], [5, 2], [6, 2], [4, 3], [5, 3], [6, 3]];
        $this->field[3] = [[7, 1], [8, 1], [9, 1], [7, 2], [8, 2], [9, 2], [7, 3], [8, 3], [9, 3]];

        $this->field[4] = [[1, 4], [2, 4], [3, 4], [1, 5], [2, 5], [3, 5], [1, 6], [2, 6], [3, 6]];
        $this->field[5] = [[4, 4], [5, 4], [6, 4], [4, 5], [5, 5], [6, 5], [4, 6], [5, 6], [6, 6]];
        $this->field[6] = [[7, 4], [8, 4], [9, 4], [7, 5], [8, 5], [9, 5], [7, 6], [8, 6], [9, 6]];

        $this->field[7] = [[1, 7], [2, 7], [3, 7], [1, 8], [2, 8], [3, 8], [1, 9], [2, 9], [3, 9]];
        $this->field[8] = [[4, 7], [5, 7], [6, 7], [4, 8], [5, 8], [6, 8], [4, 9], [5, 9], [6, 9]];
        $this->field[9] = [[7, 7], [8, 7], [9, 7], [7, 8], [8, 8], [9, 8], [7, 9], [8, 9], [9, 9]];
    }

    /**
     * @param $x
     * @param $y
     * @return int
     */
    public function rowColToField($x, $y): int
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

    public function setMask(array $mask): void
    {
        $this->mask = $mask;
        $this->board = $mask;
    }

    /**
     * @return array[]
     */
    public function getBoard(): array
    {
        return $this->board;
    }

    /**
     * @param $row
     * @param $col
     * @return int
     */
    public function getBoardRowCol($row,$col): int
    {
        return $this->board[$row][$col];
    }

    /**
     * @param int $row
     * @param int $col
     * @param int $value
     * @return void
     */
    public function setNumber(int $row, int $col, int $value = 0): void
    {
        $this->board[$row][$col] = $value;
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
                $celle = ($i-1)*9 + $j;
                echo '<td class="cell" ' . (($this->mask[$i][$j] ?? 0) != 0 ? 'style="color:black;"' : '') .
                     ' id="' . $celle . '">' . (($this->board[$i][$j] != 0) ? $this->board[$i][$j] : '&nbsp;') . '</td>';
            }
            echo '</tr>';
        }
        echo '</table>';
        echo '</div>';
    }

    /**
     * @param int $col
     * @param int $number
     * @return bool
     */
    public function numberAllowedInCol(int $col, int $number): bool
    {
        for ($i = 1; $i <= 9; $i++) {
            if ($this->getBoardRowCol($i, $col) === $number) {
                return false;
            }
        }
        return true;
    }

    /**
     * @param int $row
     * @param int $number
     * @return bool
     */
    public function numberAllowedInRow(int $row, int $number): bool
    {
        for ($i = 1; $i <= 9; $i++) {
            if ($this->getBoardRowCol($row, $i) === $number) {
                return false;
            }
        }
        return true;
    }

    /**
     * @param int $row
     * @param int $col
     * @param int $number
     * @return bool
     */
    public function numberAllowedInField(int $row, int $col, int $number)
    {
        $fieldNumber = $this->rowColToField($row, $col);
        foreach ($this->field[$fieldNumber] as [$row, $col])
        {
            if (($this->getBoardRowCol($row, $col)) == $number) {
                return false;
            }
        }
        return true;
    }

    /**
     * @return bool
     */
    public function allNumbersSet(): bool
    {
        foreach ($this->board as $row) {
            if (in_array(0, $row)) {
                return false;
            }
        }
        return true;
    }

    /**
     * @param $row
     * @param $col
     * @param $number
     * @return bool
     */
    public function numberAllowed ($row, $col, $number): bool
    {
        if($this->numberAllowedInRow($row, $number) &&
            $this->numberAllowedInCol($col, $number) &&
            $this->numberAllowedInField($row, $col, $number)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return int[]|null
     */
    public function nextFreeCell(): ?array
    {
        for ($row = 1; $row <= 9; $row++) {
            for ($col = 1; $col <= 9; $col++) {
                if ($this->getBoardRowCol($row, $col) === 0) {
                    return [$row, $col];
                }
            }
        }
        return null;
    }

    /**
     * @return bool
     * @throws \Random\RandomException
     */
    public function backtracking(): bool
    {
        if ($this->allNumbersSet()){
            return true;
        }

        list($row, $col) = $this->nextFreeCell();

        for ($number = 1; $number <= 9; $number++) {

            // Falls keine Maske übergeben wurde, verwenden wir Zufallszahlen
            // für eine bessere Verteilung der Zahlen
            if (empty($this->mask)) {
                $number = random_int(1, 9);
            }

            if ($this->numberAllowed($row, $col, $number)) {
                $this->setNumber($row, $col, $number);

                $solved = $this->backtracking();
                if ($solved) {
                    return true;
                }

                $this->setNumber($row, $col, 0);
            }
        }
        return false;
    }

    public function solutionsCount(): bool
    {
        if ($this->allNumbersSet()){
            $this->solutionCount++;
            return false;
        }

        list($row, $col) = $this->nextFreeCell();

        for ($number = 1; $number <= 9; $number++) {
            if ($this->numberAllowed($row, $col, $number)) {
                $this->setNumber($row, $col, $number);

                $this->backtracking();

                $this->setNumber($row, $col, 0);
            }
        }
        return false;
    }



}