<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
    exit();
}
include '../db_connect.php';

$title = $_POST['title'];
$desc = $_POST['description'];
$link = $_POST['link'];

$stmt = $conn->prepare("INSERT INTO projects (title, description, link) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $title, $desc, $link);
$stmt->execute();

header("Location: admin.php");
exit();
?>