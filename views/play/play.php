<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./src/styles/styles.css">
    <title>PROJECT Sudoku</title>
    <!-- PHP-Startzeitpunkt als JavaScript-Variable definieren -->
    <script>
        const startTime = <?php echo $_SESSION['startTime'] * 1000; ?>;
    </script>
</head>
<body class="gameBody">
    <div id="errorStatus" data-error="<?php  echo isset($fault) ? ($fault ? 'true' : 'false') : 'true'; ?>"
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
            $game = new Game();
            if(isset($_SESSION['sudoku'])){
                $game->setSudoku($_SESSION['sudoku']);
            }
            $game->printBoard();
        ?>

        </div>
        <div class ="footer">
            <div class="messageBoard">
                <div class="messageBoardLeft">
                    <p class="faulty"><?php echo $_SESSION['faults']?>/3 FAULTS</p>
                </div>
                <div class="messageBoardRight">
                    <?php
                        $currentTime = time();
                        $elapsedTime = $currentTime - $_SESSION['startTime'];
                        $minutes = floor($elapsedTime / 60);
                        $seconds = $elapsedTime % 60;
                        $formattedTime = sprintf('%02d:%02d', $minutes, $seconds);
                    echo '<p class="time">TIME '.$formattedTime.'</p>';
                    ?>
                </div>
            </div>
            <div class="button-group-action">
                <div>
                    <input form="gamePlay" id="ButtonErase" type="submit" class="buttonAction" name="submit" value="Erase">
                </div>
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
                   <input id="ButtonNumber1" type="submit" class="buttonNumbers" name="number" value="1" <?php echo $game->allNumberSet(1) ? "disabled":""; ?>>
                   <input id="ButtonNumber2" type="submit" class="buttonNumbers" name="number" value="2" <?php echo $game->allNumberSet(2) ? "disabled":""; ?>>
                   <input id="ButtonNumber3" type="submit" class="buttonNumbers" name="number" value="3" <?php echo $game->allNumberSet(3) ? "disabled":""; ?>>
                   <input id="ButtonNumber4" type="submit" class="buttonNumbers" name="number" value="4" <?php echo $game->allNumberSet(4) ? "disabled":""; ?>>
                   <input id="ButtonNumber5" type="submit" class="buttonNumbers" name="number" value="5" <?php echo $game->allNumberSet(5) ? "disabled":""; ?>>
                   <input id="ButtonNumber6" type="submit" class="buttonNumbers" name="number" value="6" <?php echo $game->allNumberSet(6) ? "disabled":""; ?>>
                   <input id="ButtonNumber7" type="submit" class="buttonNumbers" name="number" value="7" <?php echo $game->allNumberSet(7) ? "disabled":""; ?>>
                   <input id="ButtonNumber8" type="submit" class="buttonNumbers" name="number" value="8" <?php echo $game->allNumberSet(8) ? "disabled":""; ?>>
                   <input id="ButtonNumber9" type="submit" class="buttonNumbers" name="number" value="9" <?php echo $game->allNumberSet(9) ? "disabled":""; ?>>
               </div>
           </form>
        </div>
    </div>
    <script src="/src/scripts/gameScripts.js"></script>
</body>
</html>