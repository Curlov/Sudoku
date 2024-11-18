<?php include './views/htmlHeader.php' ?>

        <div class="board">

                <?php
                    $newBoard = new Board();
                    if (!empty($_SESSION['board'])) {
                        $newBoard->setBoard($_SESSION['board']);
                    } else {
                        $_SESSION['board'] = $newBoard->getBoard();
                    }

                    if (!empty($_SESSION['mask'])) {
                        $board = $newBoard->createSudoku($_SESSION['board'], $_SESSION['mask']);
                        $newBoard->setSudoku($board);
                    } else {
                        $board = $_SESSION['board'];
                        $newBoard->setSudoku($board);
                    }
                    $_SESSION['sudoku'] = $board;
                    $newBoard->printBoard();
                ?>

        </div>
        <div class ="footer">
            <div class="button-group">
                <form id="board" action="index.php" method="post">
                    <input type="hidden" name="action" value="showCreateBoard">
                    <input type="hidden" name="area" value="create">
                    <input type="hidden" name="view" value="create">
                    <input class="button_G" style="width: 150px; margin-right: 5px; padding: 5px" type="submit" name="submit" value="Create Board">
                </form>
                <form id="mask" action="index.php" method="post">
                    <input type="hidden" name="action" value="showCreateMask">
                    <input type="hidden" name="area" value="create">
                    <input type="hidden" name="view" value="create">
                    <input class="button_G" style="width: 150px; margin-right: 5px; padding: 5px" type="submit" name="submit" value="Create Mask">
                </form>
                <form action="index.php" method="post">
                    <input type="hidden" name="action" value="showCreateCheck">
                    <input type="hidden" name="area" value="create">
                    <input type="hidden" name="view" value="create">
                    <input class="button_G" style="width: 150px; margin-right: 5px; padding: 5px" type="submit" name="submit" value="Check Game">
                </form>
            </div>
            <div style="display: flex; justify-content: center; margin-top: 10px; align-content: center">
                <div class="slidecontainer">
                    <input form="mask" type="range" min="2" max="4" value="<?php echo $_SESSION['range'] ?? 3; ?>" class="slider" name="range" id="myRange">
                </div>
            </div>
            <div style="display: flex; justify-content: center; margin-top: 5px; align-content: center">
                <form action="index.php" method="post">
                    <input type="hidden" name="action" value="showCreateSafe">
                    <input type="hidden" name="area" value="create">
                    <input type="hidden" name="view" value="safeSudoku">
                    <input class="button_G" style="width: 150px; margin-right: 5px; padding: 5px" type="submit" name="submit" value="Safe Game" <?php echo (isset($solutionCount) && $solutionCount === 1) ? '' : 'disabled'; ?>>
                </form>
            </div>
            <div>

                <?php
                    if (isset($_SESSION['solutions'])) {
                        if ($_SESSION['solutions'] >= 100) {
                            $solutions = 'Too many solutions!';
                        } else {
                            $solutions = 'Solutions '.$_SESSION['solutions'];
                        }
                    } else {
                        $solutions = '&nbsp;';
                    }
                    echo '<h2>'.$solutions.'</h2>';
                ?>

            </div>
        </div>
    </div>
    <script src="./src/scripts/baseScripts.js"></script>
</body>
</html>
