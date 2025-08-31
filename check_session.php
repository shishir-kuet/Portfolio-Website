<?php
session_start();
header('Content-Type: application/json');

if (isset($_SESSION['username'])) {
    echo json_encode(['status' => 'valid', 'redirect' => 'admin/admin.php']);
} else {
    echo json_encode(['status' => 'invalid']);
}
?>