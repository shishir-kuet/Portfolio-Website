<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit();
}
include '../db_connect.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Admin Panel</title>
</head>

<body>
    <h1>Admin Panel</h1>

    <h2>Manage Projects</h2>
    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Link</th>
            <th>Actions</th>
        </tr>

        <!-- Row for Adding a New Project -->
        <tr>
            <form action="add_project.php" method="POST">
                <td>New</td>
                <td><input type="text" name="title" placeholder="Title" required></td>
                <td><textarea name="description" placeholder="Description"></textarea></td>
                <td><input type="text" name="link" placeholder="Link"></td>
                <td><button type="submit">Add</button></td>
            </form>
        </tr>

        <!-- Existing Projects -->
        <?php
        $result = $conn->query("SELECT * FROM projects ORDER BY id DESC");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <form action='update_project.php' method='POST'>
                    <td>{$row['id']}<input type='hidden' name='id' value='{$row['id']}'></td>
                    <td><input type='text' name='title' value='" . htmlspecialchars($row['title']) . "'></td>
                    <td><textarea name='description'>" . htmlspecialchars($row['description']) . "</textarea></td>
                    <td><input type='text' name='link' value='" . htmlspecialchars($row['link']) . "'></td>
                    <td>
                        <button type='submit'>Update</button>
                        <a href='delete_project.php?id={$row['id']}' onclick='return confirm(\"Delete this project?\")'>Delete</a>
                    </td>
                </form>
            </tr>";
        }
        ?>
    </table>

    <br>
    <a href="logout.php">Logout</a>
</body>

</html>