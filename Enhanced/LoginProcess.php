<?php
session_start();
header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline' https://ajax.googleapis.com https://kit.fontawesome.com; style-src 'self' 'unsafe-inline'; img-src 'self' data:; font-src 'self';");
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

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();

    // Check if the account is locked
    $lockout_duration = 15 * 60; // 15 minutes in seconds
    $current_time = time();
    $last_failed_attempt = strtotime($row['last_failed_attempt']);
    $failed_attempts = $row['failed_attempts'];

    if ($failed_attempts >= 5 && ($current_time - $last_failed_attempt) < $lockout_duration) {
        echo "<script>alert('Account is locked. Please try again after 15 minutes.'); window.location.href='login.php';</script>";
        exit;
    } elseif (($current_time - $last_failed_attempt) >= $lockout_duration) {
        // Reset failed attempts after lockout duration
        $failed_attempts = 0;
        $sql = "UPDATE users SET failed_attempts = 0, last_failed_attempt = NULL WHERE username='$username'";
        $conn->query($sql);
    }

    if (password_verify($password, $row['password'])) {
        // Reset failed attempts on successful login
        $sql = "UPDATE users SET failed_attempts = 0, last_failed_attempt = NULL WHERE username='$username'";
        $conn->query($sql);

        // Regenerate session ID to prevent session fixation
        session_regenerate_id(true);
        
        // Set session variables
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;

        // Check if the user is Admin321
        if ($username === 'Admin123') {
            $_SESSION['admin_loggedin'] = true;
            header("Location: admin.php");
            exit;
        } else {
            // Redirect to Index.php for regular users
            header("Location: Index.php");
            exit;
        }
    } else {
        // Update failed attempts count and timestamp
        $failed_attempts++;
        $sql = "UPDATE users SET failed_attempts = $failed_attempts, last_failed_attempt = NOW() WHERE username='$username'";
        $conn->query($sql);

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
