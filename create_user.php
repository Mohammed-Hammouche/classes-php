<?php
require 'db_conn.php';
require 'User.php';

$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['login'] ?? null;
    $password = $_POST['password'] ?? null;
    $email = $_POST['email'] ?? null;
    $firstname = $_POST['firstname'] ?? null;
    $lastname = $_POST['lastname'] ?? null;

    if ($login && $password && $email && $firstname && $lastname) {
        $user = new User($login, $password, $email, $firstname, $lastname);
        $result = $user->create($conn);
        
        switch ($result) {
            case 'success':
                $message = "User created successfully!";
                $messageType = "success";
                break;
            case 'email_exists':
                $message = "This email address is already registered. Please use a different email.";
                $messageType = "error";
                break;
            case 'login_exists':
                $message = "This username is already taken. Please choose a different one.";
                $messageType = "error";
                break;
            default:
                $message = "Failed to create user. Please try again.";
                $messageType = "error";
                break;
        }
    } else {
        $message = "All fields are required!";
        $messageType = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
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
                <a href="create_user.php" class="active"><i class="fas fa-user-plus"></i> Add User</a>
                <a href="#"><i class="fas fa-cog"></i> Settings</a>
            </nav>
        </div>

        <main class="main-content">
            <header class="dashboard-header">
                <h1>Create New User</h1>
                <div class="header-actions">
                    <a href="index.php" class="btn-primary">
                        <i class="fas fa-arrow-left"></i> Back to Dashboard
                    </a>
                </div>
            </header>

            <?php if ($message): ?>
                <div class="message-card <?php echo $messageType; ?>">
                    <i class="fas <?php echo $messageType === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'; ?>"></i>
                    <p><?php echo $message; ?></p>
                </div>
            <?php endif; ?>

            <div class="form-card">
                <form method="post" action="" class="create-user-form">
                    <div class="form-group">
                        <label for="login">
                            <i class="fas fa-user"></i> Login
                        </label>
                        <input type="text" id="login" name="login" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="password">
                            <i class="fas fa-lock"></i> Password
                        </label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="email">
                            <i class="fas fa-envelope"></i> Email
                        </label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="firstname">
                            <i class="fas fa-id-card"></i> First Name
                        </label>
                        <input type="text" id="firstname" name="firstname" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="lastname">
                            <i class="fas fa-id-card"></i> Last Name
                        </label>
                        <input type="text" id="lastname" name="lastname" class="form-control" required>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-user-plus"></i> Create User
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script>
        // Add animation to form elements
        document.querySelectorAll('.form-group').forEach((group, index) => {
            group.style.animationDelay = `${index * 0.1}s`;
            group.classList.add('fade-in');
        });
    </script>
</body>
</html>
