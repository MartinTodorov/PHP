<?php
require './includes/config.php'; //изискваме файла config
if(!isset($_SESSION['isLogged'])) // isset проверява дали дадена променлива/функция е поставена в кода и дали не е нула
{
  header('Location:login.php');
  exit;
}
if($_SESSION['power'] == 2 && isset($_GET['del']))
{
    $delID=(int) $_GET['del'];
    $sql = 'DELETE FROM msg WHERE msg_id='.$delID;
    if(mysqli_query($link, $sql))
    {
        header('Location: index.php?succdel=1');
        exit;
    }
}
require 'header.php';
$linkFix='asc';
$sqlFilter='';
$sqlDateFilter='desc';
if (isset($_GET['c'])){
    
}
?>
