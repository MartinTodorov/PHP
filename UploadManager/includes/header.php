<?php
    session_start();
    mb_internal_encoding('UTF-8');

    include 'functions.php';
?>
<!doctype html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title><?= $pageTitle ?></title>
</head>
<body>

<?php
    if($_SESSION['isLogged']) {

        //$userDir holds the directory for the current User
        //Used to specify where to upload files
        $userDir = realpath('database' . DIRECTORY_SEPARATOR . $_SESSION['username']);

        ?>
        <div>Hello, <?= $_SESSION['username'] ?>!

        <!-- Navbar for easier site navigation -->
        <a href="upload.php">Качи файл</a>
        <a href="files.php">Разгледай файловете</a>
        <a href="register.php">Регистрирай нов абонат</a>
        <a href="destroy.php">Изход</a></div>
        <?php
    }
    else {
        ?>
        <a href="index.php">Влез</a>
        <a href="register.php">Регистрирай нов абонат</a>
        <?php
    }
?>