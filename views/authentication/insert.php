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

    <div>
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

            <div class="container">
                <div class="innerContainer">

                        <?php
                            if (isset($user[0]) && ($user[0]->getId() != 0)) {
                                echo '<h1>NOTIFICATION</h1>
                                      <h2>Congratulation!<br>You have successfully registered.</h2><br> 
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
</body>
</html>


