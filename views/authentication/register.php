<?php include './views/htmlHeader.php' ?>

        <div class="board">
            <div class="container">
                <div class="innerContainer">
                    <h1>REGISTRATION</h1>
                    <form action="index.php" method="post">

                        <input type="hidden" name="action" value="showAuthentication">
                        <input type="hidden" name="area" value="authentication">
                        <input type="hidden" name="view" value="insert">

                        <label>Username<br>
                            <input type="text" name="username" required maxlength="20"><br>
                        </label>
                        <label>Password<br>
                            <input type="password" name="password" required maxlength="20"><br>
                        </label>
                        <label>Country<br>
                            <select name="country">

                                <?php
                                echo '<option value="...">select...</option>';
                                // Es wird durch die Konstante COUNTRIES iteriert. COUNTRIES ist in der Klasse LoginHelder gespeichert
                                foreach (loginHelper::COUNTRIES as $country) {
                                    echo '<option value="' . $country . '">' . $country . '</option>';
                                }
                                ?>

                            </select><br>
                        </label>
                        <input type="submit" name="submit" value="Register">
                    </form>
                </div>
            </div>
        </div>
        <div class ="footer">
            <p></p>
        </div>
    </div>
    <script src="./src/scripts/baseScripts.js"></script>
</body>
</html>



