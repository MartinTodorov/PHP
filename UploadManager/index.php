<!-- The login form
     Checks if the username and password exist in the userbase
     And then logs them in and saves the username-->

<?php
    $pageTitle = "Вход";
    include 'includes' . DIRECTORY_SEPARATOR . 'header.php';

    if(!$_SESSION['isLogged']) {

        if($_POST) {

            if(file_exists('database/userbase.txt')) {
                $username = trim($_POST['username']);
                $pass = trim($_POST['pass']);

                $readCredentials = file('database/userbase.txt');

                foreach ($readCredentials as $val) {
                    $column = explode('!*/', $val);

                    if($username == trim($column[0]) && $pass == trim($column[1])) {

                        // Sets the user as isLogged = true for use in the login checks
                        $_SESSION['isLogged'] = true;
                        // Saves the username so it can be used when uploading and visualising
                        // the user's files
                        $_SESSION['username'] = $username;

                        header('Location: index.php');
                        exit;
                    }
                }
                if(!$_SESSION['isLogged']) {
                    echo '<p>Невалидно име или парола!</p>';
                }

            }
            else{
                echo '<p>Не съществуват регистрирани потребители!<p>';
            }
        }
        ?>
        <p>Вход:</p>
        <form method="POST">
            <div>Username: <input type="text" name="username"></div>
            <div>Password: <input type="password" name="pass"></div>
            <div><input type="submit" value="Вход"></div>
        </form>
<?php
    }

    include 'includes' . DIRECTORY_SEPARATOR . 'footer.php';
?>
