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
            <div class="container">
                <div class="innerContainer">
                    <h1>NOTIFICATION</h1>
                    <h2>
                        Ooops, there was a mistake!<br>
                        The administrator has been informed.
                    </h2>
                </div>
            </div>
        </div>
        <div class ="footer">
            <p></p>
        </div>
    </div>
</body>
</html>



