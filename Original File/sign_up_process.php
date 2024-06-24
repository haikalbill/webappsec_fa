<?php
// Start the session
session_start();

// Retrieve the username and password from POST request
$username = $_POST['username'];
$password = $_POST['password'];

// Store the credentials in the session
$_SESSION['user_data'][$username] = $password;

// Redirect to login page
header("Location: login1.html");
exit();
?>
