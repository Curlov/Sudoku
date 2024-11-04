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
                    <h1>EDIT</h1>
                    <form action="index.php" method="post">

                        <input type="hidden" name="action" value="showAuthentication">
                        <input type="hidden" name="area" value="authentication">
                        <input type="hidden" name="id" value="<?php echo $user[0]->getId(); ?>">

                        <label>Username<br>
                            <input type="text" name="username" required maxlength="20" value="<?php echo $user[0]->getUsername(); ?>"><br>
                        </label>
                        <label>New Password<br>
                            <input type="password" name="password" required maxlength="20"><br>
                        </label>
                        <label>Country<br>
                            <select name="country">
                                <?php
                                    echo '<option value="...">select...</option>';
                                    foreach (LoginHelper::COUNTRIES as $country) {
                                        echo '<option value="' . $country . '"' . ($user[0]->getCountry() == $country ? ' selected' : '') . '>' . $country . '</option>';
                                    }
                                ?>
                            </select><br>
                        </label>
                        <input type="submit" name="view" value="Update">

                    </form>
                </div>
            </div>

        </div>
        <div class ="footer">
            <p></p>
        </div>
    </div>
</body>
</html>



