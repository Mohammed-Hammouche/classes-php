<?php
require 'db_conn.php';
require 'User.php';

// Get all users
$sql = "SELECT * FROM utilisateurs";
$result = $conn->query($sql);

// Count total users
$totalUsers = $result->num_rows;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management Dashboard</title>
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
                <a href="index.php" class="active"><i class="fas fa-home"></i> Dashboard</a>
                <a href="create_user.php"><i class="fas fa-user-plus"></i> Add User</a>
                <a href="#"><i class="fas fa-cog"></i> Settings</a>
            </nav>
        </div>

        <main class="main-content">
            <header class="dashboard-header">
                <h1>User Management Dashboard</h1>
                <div class="header-actions">
                    <a href="create_user.php" class="btn-primary">
                        <i class="fas fa-plus"></i> Add New User
                    </a>
                </div>
            </header>

            <div class="stats-container">
                <div class="stat-card">
                    <i class="fas fa-users"></i>
                    <h3>Total Users</h3>
                    <p class="stat-number"><?php echo $totalUsers; ?></p>
                </div>
                <!-- Add more stat cards as needed -->
            </div>

            <div class="table-wrapper">
                <div class="table-header">
                    <h2>User List</h2>
                    <div class="table-actions">
                        <input type="text" id="searchInput" placeholder="Search users..." class="search-input">
                    </div>
                </div>

                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Login</th>
                            <th>Email</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($user = $result->fetch_assoc()): ?>
                            <tr class="table-row">
                                <td><?php echo htmlspecialchars($user['id']); ?></td>
                                <td>
                                    <div class="user-info-cell">
                                        <span class="user-avatar"><?php echo strtoupper(substr($user['firstname'], 0, 1)); ?></span>
                                        <?php echo htmlspecialchars($user['login']); ?>
                                    </div>
                                </td>
                                <td><?php echo htmlspecialchars($user['email']); ?></td>
                                <td><?php echo htmlspecialchars($user['firstname']); ?></td>
                                <td><?php echo htmlspecialchars($user['lastname']); ?></td>
                                <td class="actions-cell">
                                    <a href="read_user.php?id=<?php echo htmlspecialchars($user['id']); ?>" class="action-btn view-btn" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="update_user.php?id=<?php echo htmlspecialchars($user['id']); ?>" class="action-btn edit-btn" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="delete_user.php?id=<?php echo htmlspecialchars($user['id']); ?>" 
                                       class="action-btn delete-btn" 
                                       title="Delete"
                                       onclick="return confirm('Are you sure you want to delete this user?');">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <script>
        // Simple search functionality
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let searchQuery = this.value.toLowerCase();
            let rows = document.querySelectorAll('.table-row');
            
            rows.forEach(row => {
                let text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchQuery) ? '' : 'none';
            });
        });

        // Add animation class to rows
        document.querySelectorAll('.table-row').forEach((row, index) => {
            row.style.animationDelay = `${index * 0.1}s`;
            row.classList.add('fade-in');
        });
    </script>
</body>
</html>
