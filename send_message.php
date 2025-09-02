<?php
// send_message.php
session_start();
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $message = $_POST['message'] ?? '';

    $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    if ($stmt->execute()) {
        // Success - redirect with success status
        header("Location: index.php?status=success#contact");
    } else {
        // Error - redirect with error status
        header("Location: index.php?status=error#contact");
    }

    $stmt->close();
    $conn->close();
    exit();
}
?>