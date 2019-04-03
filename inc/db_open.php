<?php
include_once './inc/config.php';

//connect to a DSN "myDSN" 
$connection_string = "DRIVER={SQL Server};SERVER=$server;DATABASE=$database"; 
$conn = odbc_connect($connection_string,$user,$pass);
?>
