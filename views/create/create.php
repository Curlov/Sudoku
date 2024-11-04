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
                    $spiel->printBoard();
                ?>

        </div>
        <div class ="footer">
            <form>
                <input class="button_G" style="width: 150px; margin-right: 10px; padding: 5px" type="submit" name="board" value="Create Board">
                <input class="button_G" style="width: 150px; margin-right: 10px; padding: 5px" type="submit" name="mask" value="Create Mask">
                <input class="button_G" style="width: 150px; margin-right: 10px; padding: 5px" type="submit" name="board" value="Check Game">
            </form>
        </div>
    </div>
</body>
</html>



