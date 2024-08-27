<?php
require 'db_conn.php';
require 'User.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['login'] ?? null;
    $password = $_POST['password'] ?? null;
    $email = $_POST['email'] ?? null;
    $firstname = $_POST['firstname'] ?? null;
    $lastname = $_POST['lastname'] ?? null;

    // Ensure all fields are provided
    if ($login && $password && $email && $firstname && $lastname) {
        $user = new User($login, $password, $email, $firstname, $lastname);
        if ($user->create($conn)) {
            echo "<p>User created successfully!</p>";
        } else {
            echo "<p>Failed to create user.</p>";
        }
    } else {
        echo "<p>All fields are required!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create User</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        form { margin-bottom: 20px; padding: 10px; border: 1px solid #ddd; border-radius: 5px; background-color: #f9f9f9; }
        input[type="text"], input[type="email"], input[type="password"] { width: calc(100% - 22px); padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 5px; }
        input[type="submit"] { background-color: #4CAF50; color: white; border: none; padding: 10px; cursor: pointer; border-radius: 5px; }
        input[type="submit"]:hover { background-color: #45a049; }
    </style>
</head>
<body>
    <h1>Create User</h1>
    <form method="post" action="">
        <input type="text" name="login" placeholder="Login" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="firstname" placeholder="First Name" required>
        <input type="text" name="lastname" placeholder="Last Name" required>
        <input type="submit" value="Create User">
    </form>

    <a href="index.php">Back to Home</a>
</body>
</html>
