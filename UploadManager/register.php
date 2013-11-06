<!-- A simple register form
     Implements a check for the username.
     If it already exists, doesn't complete the registration -->

<?php
$pageTitle = "Регистрирай се";
include 'includes' . DIRECTORY_SEPARATOR . 'header.php';

if($_SESSION['isLogged']) {
    echo '<p>Already logged in as '. $_SESSION['username'] .'!</p>';
}
else {
    if($_POST) {

        // Normalises and validates the username and the password
        $username = trim($_POST['username']);
        $username = str_replace('!*/', '', $username);

        $pass = trim($_POST['pass']);
        $pass = str_replace('!*/', '', $pass);

        $errorFlag = false;

        if(mb_strlen($username) < 4) {
            echo 'Името трябва да е поне 4 символа!';
            $errorFlag = true;
        }
        if(mb_strlen($pass) < 4) {
            echo 'Паролата трябва да е поне 4 символа!';
            $errorFlag = true;
        }

        // Checks if the user already exists
        // If he doesn't, saves the user credentials to "database/userbase.txt"
        // to be used later for user login.
        if(!$errorFlag) {
            if(checkUsername($username)) {
                echo '<p>Вече съществува потребител с това име!</p>';
            }
            else {
                $input = $username . '!*/' . $pass . PHP_EOL;
                file_put_contents('database/userbase.txt', $input, FILE_APPEND);

                $userDir = 'database' . DIRECTORY_SEPARATOR . $username;
                mkdir($userDir);

                echo '<p>Регистрацията е успешна!<p>';
            }
        }
    }

    ?>

    <p>Регистрирай се</p>
    <form method="POST">
        <div>Име: <input type="text" name="username"></div>
        <div>Парола: <input type="password" name="pass"></div>
        <div><input type="submit" value="Регистрирай се"> </div>
    </form>
    <?php
}
include 'includes' . DIRECTORY_SEPARATOR . 'footer.php';
?>