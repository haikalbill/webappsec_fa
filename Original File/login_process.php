<?php
// Start the session
session_start();

// Retrieve username and password from POST request
$username = $_POST['username'];
$password = $_POST['password'];

// Check if the credentials are valid
if (isset($_SESSION['user_data'][$username]) && $_SESSION['user_data'][$username] === $password) {
    // Set session variables
    $_SESSION["loggedin"] = true;
    $_SESSION["username"] = $username;

    // Redirect to Index.html
    header("Location: Index.html");
    exit();
} else {
    // Redirect to the login page with an error message
    header("Location: login.html?error=invalid_credentials");
    exit();
}
?>
