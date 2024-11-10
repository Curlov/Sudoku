<?php
class Game
{
    /**
     * @var int
     */
    private int $field;
    /**
     * @var string
     */
    private string $startTime;
    /**
     * @var array
     */
    private array $sudoku;
    /**
     * @var array
     */
    private array $mask;
    /**
     * @var array
     */
    private array $board;
    /**
     * @var array[]
     */
    private array $notes;
    /**
     * @var int
     */
    private int $faulty;

    /**
     * @param array $sudoku
     * @param array $mask
     * @param array $board
     */
    public function __construct()
    {
        $this->notes = $_SESSION['notes'];
        $this->sudoku = $_SESSION['sudoku'];
        $this->mask = $_SESSION['mask'];
        $this->board = $_SESSION['board'];
        $this->faulty = $_SESSION['faulty'];
        $this->field = $_SESSION['field'];
    }

    /**
     * @return void
     */
    public function setStartTime(): void
    {
        $this->startTime = microtime(true);
        $_SESSION['startTime'] = $this->startTime;
    }

    /**
     * @return string
     */
    public function getStartTime(): string
    {
        return $this->startTime;
    }

    /**
     * @param array $sudoku
     * @return void
     */
    public function setSudoku(array $sudoku): void
    {
        $this->sudoku = $sudoku;
    }

    /**
     * @return array
     */
    public function getSudoku(): array
    {
        return $this->sudoku;
    }

    /**
     * @param array $mask
     * @return void
     */
    public function setMask(array $mask): void
    {
        $this->mask = $mask;
    }

    /**
     * @return array
     */
    public function getMask(): array
    {
        return $this->mask;
    }

    /**
     * @param array $board
     * @return void
     */
    public function setBoard(array $board): void
    {
        $this->board = $board;
    }

    /**
     * @return array
     */
    public function getBoard(): array
    {
        return $this->board;
    }

    /**
     * @param int $field
     * @return array
     */
    public function getPosRowCol(int $field): array
    {
        $row = floor($field / 10);
        $col = $field % 10;
        return [$row, $col];
    }

    /**
     * @param array $sudoku
     * @param array $mask
     * @param array $board
     * @return void
     */
    public function setSessions(): void
    {
        $_SESSION['sudoku'] = $this->sudoku;
        $_SESSION['mask'] = $this->mask;
        $_SESSION['board'] = $this->board;
        $_SESSION['faulty'] = $this->faulty;
        $_SESSION['notes'] = $this->notes;
        $_SESSION['field'] = $this->field;
    }

    public function getSessions(): void
    {
        $this->sudoku = $_SESSION['sudoku'];
        $this->mask = $_SESSION['mask'];
        $this->board = $_SESSION['board'];
        $this->faulty = $_SESSION['faulty'];
        $this->notes = $_SESSION['notes'];
        $this->field = $_SESSION['field'];
    }

    /**
     * @param int $row
     * @param int $col
     * @return bool
     */
    public function isCellFree(int $row, int $col): bool
    {
        if ($this->sudoku[$row][$col] === 0) {
            return true;
        }   else {
            return false;
        }
    }

    /**
     * @param int $row
     * @param int $col
     * @param int $value
     * @return void
     */
    public function setNumberByRowCol(int $row, int $col, int $value): void
    {
        $this->sudoku[$row][$col] = $value;
    }

    /**
     * @param int $row
     * @param int $col
     * @return void
     */
    public function deleteNumberByRowCol(int $row, int $col): void
    {
        $this->sudoku[$row][$col] = 0;
    }

    /**
     * @param int $row
     * @param int $col
     * @return bool
     */
    public function isCellEditable(int $row, int $col): bool
    {
        if ($this->mask[$row][$col] === 0) {
            return true;
        }   else {
            return false;
        }
    }

    /**
     * @param int $row
     * @param int $col
     * @param int $value
     * @return bool
     */
    public function isNumberCorrect(int $row, int $col, int $value): bool
    {
        if ($this->board[$row][$col] === $value) {
            return true;
        }   else {
            return false;
        }
    }

    /**
     * @return bool
     */
    public function allNumbersCorrectSet(): bool
    {
        for($row = 1; $row <= 9; $row++) {
            for($col = 1; $col <= 9; $col++) {
                if ($this->sudoku[$row][$col] != $this->board[$row][$col]) {
                    return false;
                }
            }
        }
        return true;
    }

    public function addFaulty(): void
    {
        $this->faulty++;
    }

    public function getFaulty(): int
    {
        return $this->faulty;
    }

    public function setFaultyZero(): void
    {
        $this->faulty = 0;
    }

    public function printBoard(): void
    {
        echo '<div class="board">';
        echo '<table class="table">';
        for ($i = 1; $i <= 9; $i++) {
            echo '<tr>';
            for ($j = 1; $j <= 9; $j++) {
               // $celle = ($i-1)*9 + $j;
                echo '<td class="cell" ' . (($this->sudoku[$i][$j] != 0 && $this->board[$i][$j] != $this->sudoku[$i][$j] && $this->mask[$i][$j] == 0) ? 'style="color:#D80000; font-weight: bold;"' : '') .
                                           (($this->sudoku[$i][$j] != 0 && $this->board[$i][$j] == $this->sudoku[$i][$j] && $this->mask[$i][$j] == 0) ? 'style="color:#9D1798;"' : '') .
                                            ' data-cell="' . $i.$j . '">' . (($this->sudoku[$i][$j] != 0) ? $this->sudoku[$i][$j] : '<div CLASS="microCollectCell" id="'.$i.$j.'0">');
                if ($this->sudoku[$i][$j] == 0) {
                    for ($n = 1; $n <= 9; $n++) {
                        if (in_array($n, $this->notes[$i][$j])) {
                            echo '<div class="microcell" id="' . $i . $j . '1">' . $n . '</div>';
                        } else {
                            echo '<div class="microcell" id="' . $i . $j . '1">&nbsp;</div>';
                        }
                    }
                }
                echo ($this->sudoku[$i][$j] != 0) ? '</div></td>' : '</td>';

            }
            echo '</tr>';
        }
        echo '</table>';
        echo '</div>';
    }

    public function addNote($row, $col, $value): void
    {
        $this->notes[$row][$col][]= $value;
    }

    public function deleteLastNote($row, $col): void
    {
        array_pop($this->notes[$row][$col]);
    }

    public function allNumberSet(int $number): bool
    {
        $sum = 0;
        for ($row = 1; $row <= 9; $row++) {
            for ($col = 1; $col <= 9; $col++) {
                if ($this->sudoku[$row][$col] && $this->board[$row][$col] == $number) {
                    $sum++;
                }
            }
        }
        if ($sum >= 9) {
            return true;
        } else {
            return false;
        }
    }


}
