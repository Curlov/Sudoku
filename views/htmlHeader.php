<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./src/styles/styles.css">
    <title>PROJECT Sudoku</title>
</head>
<body>
<div class="base">
    <div class="header">
        <div class="left">
            <a href="index.php">
                <img class="logo" src="./src/images/logoG.png" alt="logo">
            </a>
        </div>
        <div class="right">
            <!-- Das Anmeldeformular wird inkludiert -->
            <?php LoginHelper::getlogin() ?>
        </div>
    </div>
