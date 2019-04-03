<?php
session_start();

//Creat Time Out Session
$time = $_SERVER['REQUEST_TIME'];
$timeout_duration = 300;
if (isset($_SESSION['LAST_ACTIVITY']) && 
   ($time - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
    session_unset();
    session_destroy();
    session_start();
}
$_SESSION['LAST_ACTIVITY'] = $time;

//Test Auth
if ($_SESSION["Login"] !== true){
header("Location: index.php");    
}
?>