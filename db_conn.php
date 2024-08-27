<?php
$host = 'localhost'; // Your host
$user = 'root'; // Your database user
$password = ''; // Your database password
$dbname = 'classes'; // Your database name

$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
