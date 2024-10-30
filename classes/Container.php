<?php

class Container
{

    public static function register($visible)
    {
        echo '
        <div id="registerContainer" style="display:'.$visible.'">
            <div class="innerContainer">
                <h1>REGISTRATION</h1>
                <form action="index.php" method="post">
        
                    <input type="hidden" name="action" value="showEnter">
                    <input type="hidden" name="area" value="main">
                    <input type="hidden" name="view" value="register">
        
                    <label>USERNAME<br>
                        <input type="text" name="username"><br>
                    </label>
                    <label>PASSWORD<br>
                        <input type="password" name="password"><br>
                    </label>
                    <label>COUNTRY<br>
                        <select name="country"><br>
                            <?php include "./src/countrys.php"; ?>
                        </select>
                    </label>
                    <input type="submit" name="submit" value="Register">
                </form>
            </div>
        </div>
        ';
    }

}