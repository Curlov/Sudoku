<?php
class Game
{
    /**
     * @var int
     */
    private int $field;
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
    private int $faults;

    /**
     * @param array $sudoku
     * @param array $mask
     * @param array $board
     */
    public function __construct()
    {
        $this->notes = $_SESSION['notes'] ;
        $this->sudoku = $_SESSION['sudoku'] ;
        $this->mask = $_SESSION['mask'];
        $this->board = $_SESSION['board'] ;
        $this->faults = $_SESSION['faults'];
        $this->field = $_SESSION['field'];
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
        $_SESSION['faults'] = $this->faults;
        $_SESSION['notes'] = $this->notes;
        $_SESSION['field'] = $this->field;
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

    /**
     * @return void
     */
    public function addFaults(): void
    {
        $this->faults++;
    }

    /**
     * @return int
     */
    public function getFaults(): int
    {
        return $this->faults;
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

    /**
     * @param $row
     * @param $col
     * @param $value
     * @return void
     */
    public function addNote($row, $col, $value): void
    {
        if(!in_array($value, $this->notes[$row][$col])) {
            $this->notes[$row][$col][] = $value;
        }
    }

    /**
     * @param $row
     * @param $col
     * @return void
     */
    public function deleteLastNote($row, $col): void
    {
        array_pop($this->notes[$row][$col]);
    }

    /**
     * @param int $number
     * @return bool
     */
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

    /**
     * @param $row
     * @param $col
     * @param $number
     * @return void
     */
    public function deleteSpezialNote($row, $col, $number): void
    {
        $board = new Board();
        $field = $board->rowColToField($row, $col);
        $cells = $board->getField($field);

        // Entfernen der Notiz aus den Zellen des Feldes
        foreach ($cells as [$r, $c]) {
            if (isset($this->notes[$r][$c])) {
                if (($key = array_search($number, $this->notes[$r][$c])) !== false) {
                    unset($this->notes[$r][$c][$key]);
                    $this->notes[$r][$c] = array_values($this->notes[$r][$c]);
                }
            }
        }
        // Entfernen der Notiz aus den Arrays der Zeile
        for ($c = 1; $c <= 9; $c++) {
            if (isset($this->notes[$row][$c])) {
                if (($key = array_search($number, $this->notes[$row][$c])) !== false) {
                    unset($this->notes[$row][$c][$key]);
                    $this->notes[$row][$c] = array_values($this->notes[$row][$c]);
                }
            }
        }
        // Entfernen der Notiz aus den Arrays in der Spalte
        for ($r = 1; $r <= 9; $r++) {
            if (isset($this->notes[$r][$col])) {
                if (($key = array_search($number, $this->notes[$r][$col])) !== false) {
                    unset($this->notes[$r][$col][$key]);
                    $this->notes[$r][$col] = array_values($this->notes[$r][$col]);
                }
            }
        }
    }

    /**
     * @param int $row
     * @param int $col
     * @param int $number
     * @return bool
     */
    public function isNumberSet(int $row, int $col, int $number): bool
    {
        $board = new Board();
        $field = $board->rowColToField($row, $col);
        $cells = $board->getField($field);

        foreach ($cells as [$r, $c]) {
            if ($this->sudoku[$row][$col] == $number) return true;
        }
        for ($r = 1; $r <= 9; $r++) {
            if ($this->sudoku[$r][$col] == $number) return true;
        }
        for ($c = 1; $c <= 9; $c++) {
            if ($this->sudoku[$row][$c] == $number) return true;
        }
        return false;
    }

}
