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

// Check user credentials
$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        // Check if user is already logged in
        if (!isset($_SESSION['username'])) {
            $_SESSION['username'] = $username; // Store username in session for one-time login
            session_unset(); // remove all stored values in session variables
            session_destroy(); // Destroys all data registered to a session
            session_write_close(); // End the current session and store session data.
            setcookie(session_name(),'',0,'/'); // Send Cookie to client web browser.
        }
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