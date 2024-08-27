<?php
require 'db_conn.php';
require 'User.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $login = $_POST['login'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];

    $user = new User($login, $password, $email, $firstname, $lastname, $id);
    if ($user->update($conn)) {
        echo "<p>User updated successfully!</p>";
    } else {
        echo "<p>Failed to update user.</p>";
    }
}

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
    <title>Update User</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        form { margin-bottom: 20px; padding: 10px; border: 1px solid #ddd; border-radius: 5px; background-color: #f9f9f9; }
        input[type="text"], input[type="email"], input[type="password"] { width: calc(100% - 22px); padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 5px; }
        input[type="submit"] { background-color: #4CAF50; color: white; border: none; padding: 10px; cursor: pointer; border-radius: 5px; }
        input[type="submit"]:hover { background-color: #45a049; }
    </style>
</head>
<body>
    <h1>Update User</h1>
    <?php if ($user): ?>
        <form method="post" action="">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id']); ?>">
            <input type="text" name="login" value="<?php echo htmlspecialchars($user['login']); ?>" required>
            <input type="password" name="password" placeholder="New Password">
            <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            <input type="text" name="firstname" value="<?php echo htmlspecialchars($user['firstname']); ?>" required>
            <input type="text" name="lastname" value="<?php echo htmlspecialchars($user['lastname']); ?>" required>
            <input type="submit" value="Update User">
        </form>
    <?php else: ?>
        <p>User not found.</p>
    <?php endif; ?>

    <a href="index.html">Back to Home</a>
</body>
</html>
