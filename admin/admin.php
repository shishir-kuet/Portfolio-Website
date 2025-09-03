<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
    exit();
}
include '../db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>

<div class="container">
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="?page=show">Show Projects</a></li>
            <li><a href="?page=add">Add Project</a></li>
            <li><a href="?page=update">Update Projects</a></li>
            <li><a href="?page=delete">Delete Projects</a></li>
            <li><a href="?page=messages">Show Messages</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <div class="content">
        <?php
        if (isset($_GET['page']) && $_GET['page'] == 'show') {
            echo "<h2>All Projects</h2>";
            $result = $conn->query("SELECT * FROM projects ORDER BY id DESC");
            echo "<table>
                    <tr><th>ID</th><th>Title</th><th>Description</th><th>Link</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>" . htmlspecialchars($row['title']) . "</td>
                        <td>" . htmlspecialchars($row['description']) . "</td>
                        <td><a href='{$row['link']}' target='_blank'>Visit</a></td>
                      </tr>";
            }
            echo "</table>";
        }

        elseif (isset($_GET['page']) && $_GET['page'] == 'add') {
            echo "<h2>Add New Project</h2>
                  <form action='add_project.php' method='POST'>
                    <input type='text' name='title' placeholder='Title' required><br>
                    <textarea name='description' placeholder='Description'></textarea><br>
                    <input type='text' name='link' placeholder='Link'><br>
                    <button type='submit'>Add Project</button>
                  </form>";
        }

        elseif (isset($_GET['page']) && $_GET['page'] == 'update') {
            echo "<h2>Update Projects</h2>";
            $result = $conn->query("SELECT * FROM projects ORDER BY id DESC");
            echo "<table>
                    <tr><th>ID</th><th>Title</th><th>Description</th><th>Link</th><th>Action</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <form action='update_project.php' method='POST'>
                            <td>{$row['id']}<input type='hidden' name='id' value='{$row['id']}'></td>
                            <td><input type='text' name='title' value='" . htmlspecialchars($row['title']) . "'></td>
                            <td><textarea name='description'>" . htmlspecialchars($row['description']) . "</textarea></td>
                            <td><input type='text' name='link' value='" . htmlspecialchars($row['link']) . "'></td>
                            <td><button type='submit'>Update</button></td>
                        </form>
                      </tr>";
            }
            echo "</table>";
        }

        elseif (isset($_GET['page']) && $_GET['page'] == 'delete') {
            echo "<h2>Delete Projects</h2>";
            $result = $conn->query("SELECT * FROM projects ORDER BY id DESC");
            echo "<table>
                    <tr><th>ID</th><th>Title</th><th>Action</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>" . htmlspecialchars($row['title']) . "</td>
                        <td><a href='delete_project.php?id={$row['id']}' onclick='return confirm(\"Delete this project?\")'>Delete</a></td>
                      </tr>";
            }
            echo "</table>";
        }

        elseif (isset($_GET['page']) && $_GET['page'] == 'messages') {
            echo "<h2>Contact Messages</h2>";
            $result = $conn->query("SELECT * FROM contact_messages ORDER BY created_at ASC");
            if ($result && $result->num_rows > 0) {
                echo "<table>
                        <tr><th>ID</th><th>Name</th><th>Email</th><th>Subject</th><th>Message</th><th>Date</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>" . htmlspecialchars($row['name']) . "</td>
                            <td>" . htmlspecialchars($row['email']) . "</td>
                            <td>" . htmlspecialchars($row['subject']) . "</td>
                            <td>" . nl2br(htmlspecialchars($row['message'])) . "</td>
                            <td>{$row['created_at']}</td>
                          </tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No messages found.</p>";
            }
        }

        else {
            echo "<h2>Welcome to Admin Dashboard</h2><p>Select an option from the sidebar.</p>";
        }
        ?>
    </div>
</div>

</body>
</html>
