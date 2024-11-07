<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./src/styles/styles.css">
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
            $game = new Board();
            if(isset($_SESSION['sudoku'])){
                $game->setSudoku($_SESSION['sudoku']);
            }
            $game->printBoard();
        ?>

        </div>
        <div class ="footer">
            <div class="button-group-action">
                <form action="index.php" method="post">
                    <div>
                        <input id="ButtonErase" type="submit" class="buttonAction" name="action" value="Erase">
                    </div>
                </form>
                <div>
                    <input form="gamePlay" type="hidden" name="note" id="noteHidden" value="<?php echo isset($_SESSION['note']) ? $_SESSION['note'] : '0'; ?>">
                    <button type="button" id="toggleButton" class="buttonAction2 <?php echo isset($_SESSION['note']) && $_SESSION['note'] == '1' ? 'active' : ''; ?>" onclick="toggleNote()">
                        Note
                    </button>
                </div>
            </div>
           <form id="gamePlay" action="index.php" method="post">
               <input type="hidden" name="action" value="showPlay">
               <input type="hidden" name="area" value="play">
               <input type="hidden" name="view" value="play">
               <input id="hiddenField" type="hidden" name="field" value="0">

               <div class="button-group-numbers">
                   <input id="ButtonNumber1" type="submit" class="buttonNumbers" name="submit" value="1">
                   <input id="ButtonNumber2" type="submit" class="buttonNumbers" name="submit" value="2">
                   <input id="ButtonNumber3" type="submit" class="buttonNumbers" name="submit" value="3">
                   <input id="ButtonNumber4" type="submit" class="buttonNumbers" name="submit" value="4">
                   <input id="ButtonNumber5" type="submit" class="buttonNumbers" name="submit" value="5">
                   <input id="ButtonNumber6" type="submit" class="buttonNumbers" name="submit" value="6">
                   <input id="ButtonNumber7" type="submit" class="buttonNumbers" name="submit" value="7">
                   <input id="ButtonNumber8" type="submit" class="buttonNumbers" name="submit" value="8">
                   <input id="ButtonNumber9" type="submit" class="buttonNumbers" name="submit" value="9">
               </div>
           </form>
        </div>
    </div>
    <script src="/src/scripts.js"></script>
</body>
</html>



