<?php
// Set session lifetime to 24 minutes (1440 seconds)
ini_set('session.gc_maxlifetime', 1440);
session_set_cookie_params(1440);

session_start();
include 'db_connect.php';

// If session already exists, redirect to admin
if (isset($_SESSION['username'])) {
    header("Location: admin/admin.php");
    exit();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Find user in database
    $stmt = $conn->prepare("SELECT * FROM admin_users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Plain text password check (not secure, but works if db has plain passwords)
        if ($password === $row['password']) {
            // Set session
            $_SESSION['username'] = $username;

            // Redirect to admin page
            header("Location: admin/admin.php");
            exit();
        }
    }

    // If login fails
    echo "Invalid login! <a href='index.html'>Try again</a>";
}
?>

