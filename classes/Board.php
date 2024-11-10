<?php
class Board
{
    public int $solutionCount = 0;
    /**
     * @var array
     */
    private array $mask = [];
    /**
     * @var array
     */
    private array $board = [];
    /**
     * @var array
     */
    private array $sudoku = [];
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

        $this->mask = $this->board;
        $this->sudoku = $this->board;

        $this->field[1] = [1 => [1, 1], 2 => [2, 1], 3 => [3, 1], 4 => [1, 2], 5 => [2, 2], 6 => [3, 2], 7 => [1, 3], 8 => [2, 3], 9 => [3, 3]];
        $this->field[2] = [1 => [4, 1], 2 => [5, 1], 3 => [6, 1], 4 => [4, 2], 5 => [5, 2], 6 => [6, 2], 7 => [4, 3], 8 => [5, 3], 9 => [6, 3]];
        $this->field[3] = [1 => [7, 1], 2 => [8, 1], 3 => [9, 1], 4 => [7, 2], 5 => [8, 2], 6 => [9, 2], 7 => [7, 3], 8 => [8, 3], 9 => [9, 3]];

        $this->field[4] = [1 => [1, 4], 2 => [2, 4], 3 => [3, 4], 4 => [1, 5], 5 => [2, 5], 6 => [3, 5], 7 => [1, 6], 8 => [2, 6], 9 => [3, 6]];
        $this->field[5] = [1 => [4, 4], 2 => [5, 4], 3 => [6, 4], 4 => [4, 5], 5 => [5, 5], 6 => [6, 5], 7 => [4, 6], 8 => [5, 6], 9 => [6, 6]];
        $this->field[6] = [1 => [7, 4], 2 => [8, 4], 3 => [9, 4], 4 => [7, 5], 5 => [8, 5], 6 => [9, 5], 7 => [7, 6], 8 => [8, 6], 9 => [9, 6]];

        $this->field[7] = [1 => [1, 7], 2 => [2, 7], 3 => [3, 7], 4 => [1, 8], 5 => [2, 8], 6 => [3, 8], 7 => [1, 9], 8 => [2, 9], 9 => [3, 9]];
        $this->field[8] = [1 => [4, 7], 2 => [5, 7], 3 => [6, 7], 4 => [4, 8], 5 => [5, 8], 6 => [6, 8], 7 => [4, 9], 8 => [5, 9], 9 => [6, 9]];
        $this->field[9] = [1 => [7, 7], 2 => [8, 7], 3 => [9, 7], 4 => [7, 8], 5 => [8, 8], 6 => [9, 8], 7 => [7, 9], 8 => [8, 9], 9 => [9, 9]];
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

    /**
     * @param $Row
     * @param $col
     * @return void
     */
    public function setSudokuRowCol($Row, $col, $value): void
    {
        $this->sudoku[$Row][$col] = $value;
    }

    /**
     * @param $Row
     * @param $col
     * @return void
     */
    public function setMaskRowCol($Row, $col, $value): void
    {
        $this->mask[$Row][$col] = $value;
    }

    /**
     * @return array|array[]
     */
    public function getSudoku(): array
    {
        return $this->sudoku;
    }

    /**
     * @param array $board
     * @return void
     */
    public function setSudoku(array $board): void
    {
        $this->sudoku = $board;
    }

    /**
     * @return array|array[]
     */
    public function getMask(): array
    {
        return $this->mask;
    }

    /**
     * @return array[]
     */
    public function getBoard(): array
    {
        return $this->board;
    }

    /**
     * @param $board
     * @return array
     */
    public function setBoard(array $board): void
    {
        $this->board = $board;
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
                echo '<td class="cell" data-cell="' . $i.$j . '">' . (($this->sudoku[$i][$j] != 0) ? $this->sudoku[$i][$j] : " " .'</td>');
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

            $number = random_int(1, 9);

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

    /**
     * @return bool
     */
    public function solutionsCount(): bool
    {
        if ($this->allNumbersSet()){
            $this->solutionCount++;
            if ($this->solutionCount >= 100) return true;
            return false;
        }

        list($row, $col) = $this->nextFreeCell();

        for ($number = 1; $number <= 9; $number++) {
            if ($this->numberAllowed($row, $col, $number)) {
                $this->setNumber($row, $col, $number);

                if ($this->solutionsCount()) {
                    return true;
                }

                $this->setNumber($row, $col, 0);
            }
        }
        return false;
    }

    /**
     * @param int $range
     * @return array
     */
    public function randomFields(int $range): array
    {
        $fields = [];
        $min = $range;
        $max = $range + 3;
        $randRange = rand($min, $max);
        for ($f = 1; $f <= $randRange; $f++) {
            $z = rand(1, 9);
            if (!in_array($z, $fields)) {
                $fields[] = $z;
            } else {
            $f--;
            }
        }
        return $fields;
    }

    /**
     * @param int $range
     * @return void
     */
    public function createMask(int $range): void
    {
        for ($field = 1; $field <= 9; $field++) {
            $cells = $this->randomFields($range);
            foreach ($cells as $cell) {
                list($row, $col) = $this->field[$field][$cell];
                $this->setMaskRowCol($row, $col, 1);
            }
        }
    }

    /**
     * @param array $board
     * @param array $mask
     * @return array[]
     */
    public function createSudoku(array $board, array $mask): array
    {
        for ($row = 1; $row <= 9; $row++) {
            for ($col = 1; $col <= 9; $col++) {
                if ($_SESSION['mask'][$row][$col] == 1) {
                    $value = $this->getBoardRowCol($row, $col);
                    $this->setSudokuRowCol($row, $col, $value);
                } else {
                    $this->setSudokuRowCol($row, $col, 0);
                }
            }
        }
        return $this->getSudoku();
    }

    /**
     * @param string $board
     * @param string $mask
     * @param int $range
     * @return void
     * @throws Exception
     */
    public function enterObject(string $board, string $mask, int $range): void
    {
        try {
            $pdo = Db::getConnection();
            $sql = 'INSERT INTO sudokus (board, mask, level) VALUES (:board, :mask, :level)';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':board', $board);
            $stmt->bindParam(':mask', $mask);
            $stmt->bindParam(':level', $range);
            $stmt->execute();
        } catch(Error $e) {
            throw new Exception($e);
        }
    }

    /**
     * @param int $level
     * @return array
     * @throws Exception
     */
    function getRandomObjectByLevel(int $level): array
    {
        $pdo = Db::getConnection();
        $sql = 'SELECT * FROM sudokus WHERE level=:level ORDER BY RAND() LIMIT 1';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':level', $level);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
}