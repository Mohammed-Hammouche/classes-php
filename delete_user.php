<?php
require 'db_conn.php';
require 'User.php';

$message = '';
$messageType = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (User::delete($conn, $id)) {
        $message = "User deleted successfully!";
        $messageType = "success";
    } else {
        $message = "Failed to delete user.";
        $messageType = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="dashboard-container">
        <div class="sidebar">
            <div class="logo">
                <i class="fas fa-users-cog"></i>
                <span>User Manager</span>
            </div>
            <nav>
                <a href="index.php"><i class="fas fa-home"></i> Dashboard</a>
                <a href="create_user.php"><i class="fas fa-user-plus"></i> Add User</a>
                <a href="#"><i class="fas fa-cog"></i> Settings</a>
            </nav>
        </div>

        <main class="main-content">
            <header class="dashboard-header">
                <h1>Delete User</h1>
                <div class="header-actions">
                    <a href="index.php" class="btn-primary">
                        <i class="fas fa-arrow-left"></i> Back to Dashboard
                    </a>
                </div>
            </header>

            <div class="message-card <?php echo $messageType; ?>">
                <i class="fas <?php echo $messageType === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'; ?>"></i>
                <p><?php echo $message; ?></p>
            </div>
        </main>
    </div>
</body>
</html>
