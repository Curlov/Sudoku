<?php include 'views/htmlHeader.php' ?>

        <div class="board">
            <div class="container">
                <div class="innerContainer">
                    <h1>LEVEL SELECTION</h1><br>
                    <form action="index.php" method="POST">
                        <input type="hidden" name="action" value="showPlayLevelSelection">
                        <input type="hidden" name="area" value="play">
                        <input type="hidden" name="view" value="play">
                        <input style="font-size: x-large; width: 150px;" type="submit" name="submit" value="Light"><br><br>
                        <input style="font-size: x-large; width: 150px;" type="submit" name="submit" value="Medium"><br><br>
                        <input style="font-size: x-large; width: 150px;" type="submit" name="submit" value="Heavy">
                    </form>
                </div>
            </div>
        </div>
        <div class ="footer">
            <p></p>
        </div>
    </div>
    <script src="/src/scripts/baseScripts.js"></script>
</body>
</html>



