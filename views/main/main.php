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
                    <h1>PROJECT WORK</h1>
                    <h4>
                        This website was created as part of my retraining as an IT
                        specialist and offers a self-programmed Sudoku game. The aim
                        was to combine playful and technical elements while applying
                        the basics of web development. The realisation of the game
                        not only emphasised the logical structure of Sudoku, but also
                        deepened my insight into interactive functions, user
                        interfaces and problem-solving in everyday programming.
                    </h4>
                    <h4>To play, log in.</h4>
                </div>
            </div>
        </div>
        <div class ="footer">
            <p></p>
        </div>
    </div>
</body>
</html>



