<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./src/styles/styles.css">
    <script src="/src/scripts.js"></script>
    <title>PROJECT Sudoku</title>
</head>
<body>

    <div class="base">
        <div class="header">
            <div class="left">
                <a href="index.php">
                    <img src="src/images/logo.png" alt="logo">
                </a>
            </div>
            <div class="right">
                <?php loginHelper::getlogin() ?>
            </div>
        </div>
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
                    $newBoard->printBoard();
                ?>

        </div>
        <div class ="footer">
            <div class="button-group">
                <form action="index.php" method="post">
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
                    <input type="hidden" name="action" value="showCreate">
                    <input type="hidden" name="area" value="create">
                    <input type="hidden" name="view" value="create">
                    <input class="button_G" style="width: 150px; margin-right: 5px; padding: 5px" type="submit" name="submit" value="Check Game">
                </form>
            </div>
            <div style="display: flex; justify-content: center; margin-top: 10px; align-content: center">
                <div class="slidecontainer">
                    <input form="mask" type="range" min="2" max="8" value="5" class="slider" name="range" id="myRange">
                </div>
            </div>
            <div style="display: flex; justify-content: center; margin-top: 20px; align-content: center">
                <form action="index.php" method="post">
                    <input type="hidden" name="action" value="showSafeGame">
                    <input type="hidden" name="area" value="create">
                    <input type="hidden" name="view" value="create">
                    <input class="button_G" style="width: 150px; margin-right: 5px; padding: 5px" type="submit" name="submit" value="Safe Game">
                </form>
            </div>
        </div>
    </div>
</body>
</html>
