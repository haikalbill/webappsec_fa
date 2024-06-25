<?php
session_start();
header("Content-Security-Policy: default-src 'self'; script-src 'self' https://ajax.googleapis.com");
header("X-XSS-Protection: 1; mode=block");

if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "auth";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    // Log error instead of displaying it
    error_log("Connection failed: " . $conn->connect_error);
    die("Connection failed.");
}

// Get form data
$username = $_POST['username'];
$password = $_POST['password'];

// Prevent SQL Injection
$username = $conn->real_escape_string($username);

// Check user credentials
$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        // Set session variable
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        
        // Redirect to Index.php
        header("Location: Index.php");
        exit;
    } else {
        echo "<script>alert('Incorrect password.'); window.location.href='login.php';</script>";
    }
} else {
    echo "<script>alert('User not found.'); window.location.href='login.php';</script>";
}

$conn->close();
?>
