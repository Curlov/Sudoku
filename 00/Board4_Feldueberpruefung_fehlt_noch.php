<?php

namespace SaftyFirst;
class Board4_Feldueberpruefung_fehlt_noch
{
    /**
     * @var array[]
     */
    private array $board = [];
    /**
     * @var int[]
     */
    private array $referenceLine = [];
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
        $this->referenceLine = [1, 2, 3, 4, 5, 6, 7, 8, 9];
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
     * @param $section
     * @param $position
     * @return void
     */
    public function killPosInSection($section, $position): void
    {
        unset($this->$section[$position]);
        $this->$section = array_values($this->$section);
    }

    /**
     * @param int $positionX
     * @param int $positionY
     * @param int $value
     * @return void
     */
    public function setNumberByPosition(string $section, int $position, int $cell, int $value = 0): void
    {
        if ($section === 'row') {
            $this->board[$position][$cell] = $value;
        }
        if ($section === 'col') {
            $this->board[$cell][$position] = $value;
        }
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
    public function freeNumbersInLine(string $section, int $position): array
    {
        $output = [];
        for ($i = 1; $i <= 9; $i++) {
            if ($section === 'row') {
                if ($this->getBoardXY($position, $i) !== 0) {
                    $output[] = $this->getBoardXY($position, $i);
                }
            } elseif ($section === 'col') {
                if ($this->getBoardXY($i, $position) !== 0) {
                    $output[] = $this->getBoardXY($i, $position);
                }
            }
        }
        return array_diff($this->getReferenceLine(), $output);
    }

    /**
     * @param string $section
     * @param $position
     * @return array
     */
    public function freeCells(string $section, $position): array
    {
        $result = [];
        for ($i = 1; $i <= 9; $i++) {
            if ($section === 'row') {
                if ($this->getBoardXY($position, $i) === 0) {
                    $result[$i] = array_intersect($this->freeNumbersInLine('col', $i),
                        $this->freeNumbersInLine('row', $position));
                }
            } elseif ($section === 'col') {
                if ($this->getBoardXY($i, $position) === 0) {
                    $result[$i] = array_intersect($this->freeNumbersInLine('row', $i),
                        $this->freeNumbersInLine('col', $position));
                }
            }
        }
        return $result;
    }

    /**
     * @param $section
     * @return int
     */
    public function getCountOfSection($section): int
    {
        return (count($this->$section) - 1);
    }

    /**
     * @param $section
     * @return array
     */
    public function getSectionPositionByIndex($section, $index): int
    {
        return $this->$section[$index];
    }

    /**
     * @param $section
     * @return array
     */
    public function getSection($section): array
    {
        return $this->$section;
    }

    /**
     * @param string $section
     * @param int $position
     * @param int $swapCell
     * @param int $lastCell
     * @param int $lastNumber
     * @return void
     */
    public function swapNumbers(string $section, int $position, int $swapCell, int $lastCell, int $lastNumber): void
    {
        if ($section === 'row') {
            $this->setBoardXY($position, $lastCell, $this->getBoardXY($position, $swapCell));
            $this->setBoardXY($position, $swapCell, $lastNumber);
        } elseif ($section === 'col') {
            $this->setBoardXY($lastCell, $position, $this->getBoardXY($position, $swapCell));
            $this->setBoardXY($swapCell, $position, $lastNumber);
        }
    }

    /**
     * @return void
     */
    public function designPattern()
    {
        for ($j = 1; $j <= 11; $j++) {

            $section = ($j % 2 != 0) ? 'row' : 'col';
            //$section = 'row';

            $randomIndex = rand(0, $this->getCountOfSection($section));
            $position = $this->getSectionPositionByIndex($section, $randomIndex);
            $this->killPosInSection($section, $randomIndex);

            //FreeNumbers beinhaltet die Zahlen, die in der aktuell zu beschreibenen Reihe gesetzt werden können.
            $freeNumbers = $this->freeNumbersInLine($section, $position);

            //FreeCells beinhaltet alle freien Zellen einer Reihe mit den möglichen Zahlen, die dort gesetzt werden können.
            $freeCells = $this->freeCells($section, $position);

            //Sortieren der freien Zellen, nach der Anzahl der möglichen Zahlen, die gesetzt werden können.
            uasort($freeCells, function ($a, $b) {
                return count($a) <=> count($b);
            });

            //PossibleNumbers beinhaltet alle Zahlen die in der aktuellen Zelle gesetzt werden können.
            foreach ($freeCells as $cell => $possibleNumbers) {
                foreach ($freeNumbers as $key => $number) {
                    if (in_array($number, $possibleNumbers)) {
                        $this->setNumberByPosition($section, $position, $cell, $number);
                        $setCells[$cell] = $number;
                        $possibleNumbersInCell[$cell] = $possibleNumbers;
                        unset($freeCells[$cell]);
                        unset($freeNumbers[$key]);
                        break;
                    } else {
                        $lastCell = $cell;
                    }
                }
            }

            if (count($freeNumbers) > 0) {
                //In $freeCells[Celle] befinden sich die möglichen Zahlen, die hier gesetzt werden können.
                //In $setCells befinden sich alle beschriebenen Zellen mit den entsprechenden Zahlen.
                $lastNumber = end($freeNumbers);

                $reversedSetCells = array_reverse($setCells, true);

                //Hier kommt etwas Textausgabe zur Orientierung und Hilfe.
                echo "<br>" . $section . " " . $position . " Zelle " . $lastCell . " konnte nicht gesetzt werden.<br>";
                echo "Die Zahl: " . end($freeNumbers) . " konnte nicht gesetzt werden.<br>";

                foreach ($reversedSetCells as $key => $value) {
                    if (in_array($lastNumber, $possibleNumbersInCell[$key]) && (in_array($value, $freeCells[$lastCell]))) {
                        $this->swapNumbers($section, $position, $key, $lastCell, $lastNumber);
                        echo "Sie wurde gegen die Zahl $value in der Zelle $key getauscht<br>";
                        break;
                    }
                }


            }

            $setCells = [];
            $possibleNumbersInCell = [];

        }
        //print_r($this->row);
        //print_r($this->col);

    }

}