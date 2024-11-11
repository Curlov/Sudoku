<?php include 'views/htmlHeader.php' ?>

        <div class="board">
            <div class="container">
                <div class="innerContainer">

                        <?php
                            if (isset($_SESSION['username'])) {
                                echo '<h1>NOTIFICATION</h1>
                                      <h2>Hello '.ucfirst($_SESSION['username']).',<br>nice to have you back!</h2><br>
                                 
                                      <form action="index.php" method="POST">
                                         <input type="hidden" name="action" value="showMain">
                                         <input type="hidden" name="area" value="play">
                                         <input type="hidden" name="view" value="levelSelection">
                                         <input style="font-size: x-large; width: 150px;" type="submit" value="Let`s Play">                 
                                      </form>';

                                if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
                                    echo '
                                        <form action="index.php" method="POST">
                                             <input type="hidden" name="action" value="showCreate">
                                             <input type="hidden" name="area" value="create">
                                             <input type="hidden" name="view" value="create">
                                             <input style="font-size: x-large; width: 150px;" type="submit" value="Create">                 
                                        </form>';
                                }
                            } else {
                                echo '<h1>NOTIFICATION</h1>
                                      <h2>Sorry, the login was unsuccessful</h2>';
                            }


                        ?>

                </div>
            </div>

        </div>
        <div class ="footer">
            <p></p>
        </div>
    </div>
</body>
</html>



