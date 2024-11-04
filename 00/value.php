<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./styles/styles.css">
    <script src="/src/scripts.js"></script>
    <title>PROJECT Sudoku</title>
</head>
<body>

    <div>
        <div class="header">
            <div class="left">
                <img src="images/logo.png" alt="logo">
            </div>
            <div class="right">
                <?php loginHelper::getlogin() ?>
            </div>
        </div>
        <div class="board">

            <div class="container">
                <div class="innerContainer">

                        <?php
                            if ($user['id'] != 0) {
                                echo '<h1>Congratulation!</h1>
                                  <h1>You have successfully registered.</h1><br> 
                                  <form action="index.php" method="POST">
                                     <input type="hidden" name="action" value="showMain">
                                     <input type="hidden" name="area" value="play">
                                     <input type="hidden" name="view" value="levelSelection">
                                     
                                     <input type="submit" value="Let`s Play">
                                  </form>';

                            } else {
                                echo "<h1>Uuups!</h1>
                                  <h2>Something went wrong here.</h2> 
                                  <h2>Registration has failed</h2><br> ";
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



