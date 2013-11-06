<?php
session_start(); //Връща TRUE,ако сесията е стартирала
$link = mysqli_connect('localhost','root','', 'msgboard');
mysqli_query($link, 'SET NAMES utf8');
?>
