<?php
// db_connect.php

$servername = "localhost";  // XAMPP default
$dbUsername = "root";       // XAMPP default
$dbPassword = "";           // XAMPP default
$dbName = "portfolio";  // Replace with your DB name

// Create connection
$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Uncomment below to check connection (optional)
// echo "Connected successfully";
?>
