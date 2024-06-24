<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "auth";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$username = $_POST['username'];
$password = $_POST['password'];

// Sanitize input
$username = htmlspecialchars(trim($username), ENT_QUOTES, 'UTF-8');
$password = htmlspecialchars(trim($password), ENT_QUOTES, 'UTF-8');

// Validate username
if (!preg_match('/^[a-zA-Z0-9]+$/', $username)) {
    die('Invalid username. Only alphanumeric characters are allowed.');
}

// Validate password
if (strlen($password) < 8) {
    die('Password must be at least 8 characters long.');
}
if (!preg_match('/[A-Z]/', $password)) {
    die('Password must contain at least one uppercase letter.');
}
if (!preg_match('/[a-zA-Z0-9]/', $password)) {
    die('Password must be alphanumeric.');
}

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

// Check if username already exists
$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    die('Username already exists.');
}

// Insert user into database
$sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashedPassword')";
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Signup successful. Please login.'); window.location.href='login.php';</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
