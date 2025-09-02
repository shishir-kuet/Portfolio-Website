<?php
// db_connect.php

$servername = "localhost";  
$dbUsername = "root";    
$dbPassword = "";           
$dbName = "portfolio";  


$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
