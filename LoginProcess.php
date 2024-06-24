<?php
session_start();
header("Content-Security-Policy: default-src 'self'; script-src 'self' https://ajax.googleapis.com");
// Database credentials
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

// Prevent SQL Injection
$username = $conn->real_escape_string($username);

// Check user credentials
$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_username = "Admin123"; // change this to your admin username
    $admin_password = "Admin123"; // change this to your admin password

    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $admin_username && $password === $admin_password) {
        $_SESSION['admin_loggedin'] = true;
        header("Location: admin.php");
        exit;
    } else {
        $error = "Invalid username or password";
    }
}

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        // Regenerate session ID to prevent session fixation
        session_regenerate_id(true);
        
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


<?php
// Check if user is inactive for 30 minutes or session is older than 1 hour
$inactive = 1800; // 30 minutes in seconds
$session_lifetime = 3600; // 1 hour in seconds

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $inactive)) {
    session_unset(); // unset $_SESSION variable for the run-time
    session_destroy(); // destroy session data in storage
    header("Location: login.php"); // Redirect to login page
    exit;
}

if (isset($_SESSION['created']) && (time() - $_SESSION['created'] > $session_lifetime)) {
    session_unset(); // unset $_SESSION variable for the run-time
    session_destroy(); // destroy session data in storage
    header("Location: login.php"); // Redirect to login page
    exit;
}

$_SESSION['last_activity'] = time(); // Update last activity time stamp
?>

