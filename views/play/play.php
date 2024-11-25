<?php include './views/htmlHeader.php' ?>

        <!-- PHP-Startzeitpunkt als JavaScript-Variable definieren -->
        <script>
            const startTime = <?php echo $_SESSION['startTime'] * 1000; ?>;
        </script>
        <div id="errorStatus" data-error="<?php  echo isset($fault) ? ($fault ? 'true' : 'false') : 'true'; ?>"
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
                <div class="messageBoardMiddel">
                    <p class="copyright"> &copy 2024 Curlov</p>
                </div>
                <div class="messageBoardRight">
                    <?php
                        // Berechnung und Ausgabe der verstrichenen Zeit. Die Zeit muss sowohl über PHP
                        // als auch über JavaScript aktualisiert werden
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
                <input form="gamePlay" id="ButtonErase" type="submit" class="buttonAction" name="submit" value="Erase">
                <!-- Ein hidden Field um den "note"-Schalter zu setzen -->
                <input form="gamePlay" type="hidden" name="note" id="noteHidden" value="<?php echo isset($_SESSION['note']) ? $_SESSION['note'] : '0'; ?>">
                <button type="button" id="toggleButton" class="buttonAction2 <?php echo isset($_SESSION['note']) && $_SESSION['note'] == '1' ? 'active' : ''; ?>" onclick="toggleNote()">
                    Note
                </button>
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
    <script src="./src/scripts/gameScripts.js"></script>
</body>
</html>