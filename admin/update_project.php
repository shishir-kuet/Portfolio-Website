<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
    exit();
}
include '../db_connect.php';

$id = $_POST['id'];
$title = $_POST['title'];
$desc = $_POST['description'];
$link = $_POST['link'];

$stmt = $conn->prepare("UPDATE projects SET title=?, description=?, link=? WHERE id=?");
$stmt->bind_param("sssi", $title, $desc, $link, $id);
$stmt->execute();

header("Location: admin.php");
exit();
?>