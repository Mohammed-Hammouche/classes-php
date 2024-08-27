<?php
require 'db_conn.php';
require 'User.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (User::delete($conn, $id)) {
        echo "<p>User deleted successfully!</p>";
    } else {
        echo "<p>Failed to delete user.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete User</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        p { margin: 10px 0; }
        a { color: #4CAF50; text-decoration: none; }
    </style>
</head>
<body>
    <h1>Delete User</h1>
    <p>User has been deleted.</p>

    <a href="index.php">Back to Home</a>
</body>
</html>
