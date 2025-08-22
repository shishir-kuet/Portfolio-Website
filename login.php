<?php
session_start();
include 'db_connect.php';

if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM admin_users WHERE username=? AND password=?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows === 1){
        $_SESSION['username'] = $username;
        header("Location: admin.php"); // Redirect to admin page
        exit();
    } else {
        echo "<script>alert('Incorrect username or password!'); window.location='index.html';</script>";
        exit();
    }
}
?>
