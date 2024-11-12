<?php include 'views/htmlHeader.php' ?>

        <div class="board">
            <div class="container">
                <div class="innerContainer">

                        <?php
                            if (isset($user[0]) && ($user[0]->getId() != 0)) {
                                echo '<h1>NOTIFICATION</h1>
                                  <h2>Congratulation!<br>You have successfully updated your data.</h2><br> 
                                  <form action="index.php" method="POST">
                                     <input type="hidden" name="action" value="showMain">
                                     <input type="hidden" name="area" value="play">
                                     <input type="hidden" name="view" value="levelSelection">
                                     
                                     <input style="font-size: x-large; width: 150px;" type="submit" value="Let`s Play">
                                  </form>';

                            } else {
                                echo "<h1>NOTIFICATION</h1>
                                  <h2>Uuups!<br>Something went wrong here.<br>Registration has failed</h2><br> ";
                            }
                        ?>

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



