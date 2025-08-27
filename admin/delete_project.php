<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../index.html");
    exit();
}
include 'db_connect.php';

$id = $_GET['id'];
$stmt = $conn->prepare("DELETE FROM projects WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: admin.php");
exit();
?>