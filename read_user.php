<?php
require 'db_conn.php';
require 'User.php';

$user = null;
if (isset($_GET['id'])) {
    $user = User::read($conn, $_GET['id']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
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
                <h1>User Details</h1>
                <div class="header-actions">
                    <a href="index.php" class="btn-primary">
                        <i class="fas fa-arrow-left"></i> Back to Dashboard
                    </a>
                </div>
            </header>

            <?php if ($user): ?>
                <div class="user-detail-card">
                    <div class="user-avatar large">
                        <?php echo strtoupper(substr($user['firstname'], 0, 1)); ?>
                    </div>
                    <div class="user-info-grid">
                        <div class="info-item">
                            <span class="info-label"><i class="fas fa-user"></i> Login</span>
                            <span class="info-value"><?php echo htmlspecialchars($user['login']); ?></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label"><i class="fas fa-envelope"></i> Email</span>
                            <span class="info-value"><?php echo htmlspecialchars($user['email']); ?></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label"><i class="fas fa-id-card"></i> First Name</span>
                            <span class="info-value"><?php echo htmlspecialchars($user['firstname']); ?></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label"><i class="fas fa-id-card"></i> Last Name</span>
                            <span class="info-value"><?php echo htmlspecialchars($user['lastname']); ?></span>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="error-card">
                    <i class="fas fa-exclamation-circle"></i>
                    <p>User not found.</p>
                </div>
            <?php endif; ?>
        </main>
    </div>
</body>
</html>
