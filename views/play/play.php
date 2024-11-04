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
                    $board = [
                        1 => [1 => 2, 2 => 6, 3 => 9, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 8 => 0, 9 => 0],
                        2 => [1 => 0, 2 => 8, 3 => 1, 4 => 7, 5 => 0, 6 => 3, 7 => 0, 8 => 0, 9 => 4],
                        3 => [1 => 4, 2 => 7, 3 => 0, 4 => 9, 5 => 2, 6 => 0, 7 => 1, 8 => 0, 9 => 5],
                        4 => [1 => 6, 2 => 9, 3 => 4, 4 => 0, 5 => 5, 6 => 0, 7 => 2, 8 => 0, 9 => 0],
                        5 => [1 => 0, 2 => 0, 3 => 2, 4 => 3, 5 => 9, 6 => 0, 7 => 5, 8 => 4, 9 => 0],
                        6 => [1 => 0, 2 => 5, 3 => 0, 4 => 0, 5 => 8, 6 => 0, 7 => 0, 8 => 0, 9 => 0],
                        7 => [1 => 0, 2 => 0, 3 => 5, 4 => 0, 5 => 0, 6 => 2, 7 => 4, 8 => 0, 9 => 9],
                        8 => [1 => 9, 2 => 0, 3 => 6, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 8 => 5, 9 => 2],
                        9 => [1 => 7, 2 => 0, 3 => 0, 4 => 5, 5 => 0, 6 => 9, 7 => 3, 8 => 0, 9 => 0]
                    ];
                    $spiel = new Board();
                    $spiel->setMask($board);
                    $spiel->backtracking();
                    $spiel->printBoard();
                ?>

        </div>
        <div class ="footer">
            <p></p>
        </div>
    </div>
</body>
</html>



