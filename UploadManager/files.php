<!-- Visualises the user's file in table format -->

<?php
$pageTitle = 'Качени файлове';
include 'includes' . DIRECTORY_SEPARATOR . 'header.php';

if($_SESSION['isLogged']) {

    //Scans the user directory set in header.php
    $dirContents = scandir($userDir);
    echo '<p>Твоите файлове: </p>';

    if(count($dirContents) <= 2) {
        echo '<p>Няма качени файлове</p>';
    }
    else {
        echo '<table border="1">
             <thead><tr><th>Име</th><th>Размер</th></tr></thead>';

        // Iterates through the contents of the user directory
        // Jumps over the first two entries in the array since they are not valid files

        for($i = 2; $i < count($dirContents); $i++) {

            // Saves the filesize of the current file.
            $size = filesize($userDir . DIRECTORY_SEPARATOR . $dirContents[$i]);
            // Formats the filesize to a more human-readable format.
            $size = formatSizeUnits($size);

            // Passes the filename to the download.php page
            // So it can be used to force the download of the file
            $link = '<a href="download.php?file=' . $dirContents[$i] . '" >';

            echo '<tr><td>'.$link. $dirContents[$i] .'</a></td><td>'.$size.'</td></tr>';
        }
        echo '</table>';
    }
}

include 'includes' . DIRECTORY_SEPARATOR . 'footer.php';
?>