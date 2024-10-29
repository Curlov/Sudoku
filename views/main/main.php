<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../styles/styles.css">
    <script src="/src/scripts.js"></script>
    <title>The Sudoku Project</title>
</head>
<body>

<div id="registerContainer">
    <div class="innerContainer">
        <h1>REGISTRATION</h1>
        <form action="index.php" method="post">

            <input type="hidden" name="action" value="showRegister">
            <input type="hidden" name="area" value="main">
            <input type="hidden" name="view" value="main">

            <label>USERNAME
                <input type="text" name="username">
            </label>
            <label>PASSWORD<br>
                <input type="password" name="password">
            </label>
            <label>CONTRY
                <select name="contry">
                    <?php include "./src/countrys.php"; ?>
                </select>
            </label>
            <input type="submit" name="submit" value="Register">
        </form>
    </div>
</div>

    <div>
        <div class="header">
            <div class="left">
                <img src="images/logo75.jpg" alt="logo">
            </div>
            <div class="right">
                <form action="index.php" method="post">
                    <label>Username:<br>
                        <input class="inputField" type="text" name="username">
                    </label>
                    <label>Password:<br>
                        <input class="inputField" type="password" name="password">
                    </label>
                    <div class="button-group">
                        <button class="button_LuR" onclick="showRegisterField()">Register</button>
                        <input class="button_LuR" type="submit" value="Login">
                    </div>
                </form>
            </div>
        </div>
        <div class="board">
            <?php
                $spiel = new Board();
                $spiel->printBoard();
            ?>
        </div>
        <div class ="footer">
            <p></p>
        </div>
    </div>
</body>
</html>



