<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        mb_internal_encoding('UTF-8');
        $pageTitle = 'Качване на файлове';
        include 'includes' . DYRECTORY_SEPARATOR . 'header.php';

        if ($_SESSION['isLogged']) {
            if ($_FILES) {
//Checks whether user directory exists and creates it if it doesn't
                if (!$userDir) {
                    $userDir = 'database' . DYRECTORY_SEPARATOR . $_SESSION(['username']);
                }


// Saving file in specified user directory
                if (move_uploaded_file($_FILES['upload']['tmp_name'], $userDir . DIRECTORY_SEPARATOR . $_FILES['upload']['name'])) {
                    echo '<p>Файлът е качен успешно!</p>';
                } else {
                    echo '<p>Файлът не е качен успешно!</p>';
                }
                ?>
                <form method="POST" enctype="multipart/form-data">
                    <div>Качи файл: <input type="file" name="upload"></div>
                    <div><input type="submit" value="Качи"> </div>
                </form>
                <?php
                include 'includes' . DIRECTORY_SEPARATOR . 'footer.php';
                
            }
        }
        ?>