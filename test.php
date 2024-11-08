public function printBoard(): void
{
echo '<div class="board">';
    echo '<table class="table">';
        for ($i = 1; $i <= 9; $i++) {
        echo '<tr>';
            for ($j = 1; $j <= 9; $j++) {
            // $celle = ($i-1)*9 + $j;
            echo '<td class="cell" ' . (($this->sudoku[$i][$j] != 0 && $this->board[$i][$j] != $this->sudoku[$i][$j] && $this->mask[$i][$j] == 0) ? 'style="color:red;"' : '') .
            (($this->sudoku[$i][$j] != 0 && $this->board[$i][$j] == $this->sudoku[$i][$j] && $this->mask[$i][$j] == 0) ? 'style="color:rgb(198, 152, 250);"' : '') .
            ' data-cell="' . $i.$j . '">' . (($this->sudoku[$i][$j] != 0) ? $this->sudoku[$i][$j] : '<div CLASS="microCollectCell" id="'.$i.$j.'0">
                <div class="microcell" id="'.$i.$j.'1">1</div>
                <div class="microcell" id="'.$i.$j.'2">2</div>
                <div class="microcell" id="'.$i.$j.'3">3</div>
                <div class="microcell" id="'.$i.$j.'4">4</div>
                <div class="microcell" id="'.$i.$j.'5">5</div>
                <div class="microcell" id="'.$i.$j.'6">6</div>
                <div class="microcell" id="'.$i.$j.'7">7</div>
                <div class="microcell" id="'.$i.$j.'8">8</div>
                <div class="microcell" id="'.$i.$j.'9">9</div>
            </div>').'</td>';
            }
            echo '</tr>';
        }
        echo '</table>';
    echo '</div>';
}
