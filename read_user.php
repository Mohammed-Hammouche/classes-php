<?php
require 'db_conn.php';
require 'User.php';

$user = null;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $user = User::read($conn, $id);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Read User</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .user-details { padding: 10px; border: 1px solid #ddd; border-radius: 5px; background-color: #f9f9f9; }
        .user-details p { margin: 5px 0; }
        a { color: #4CAF50; text-decoration: none; }
    </style>
</head>
<body>
    <h1>Read User</h1>
    <?php if ($user): ?>
        <div class="user-details">
            <p><strong>ID:</strong> <?php echo htmlspecialchars($user['id']); ?></p>
            <p><strong>Login:</strong> <?php echo htmlspecialchars($user['login']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
            <p><strong>First Name:</strong> <?php echo htmlspecialchars($user['firstname']); ?></p>
            <p><strong>Last Name:</strong> <?php echo htmlspecialchars($user['lastname']); ?></p>
        </div>
    <?php else: ?>
        <p>User not found.</p>
    <?php endif; ?>

    <a href="index.php">Back to Home</a>
</body>
</html>
