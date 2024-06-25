<?php
session_start();

header("Content-Security-Policy: default-src 'self'; style-src 'self' 'unsafe-inline'; script-src * 'unsafe-eval' 'unsafe-inline';");
header("X-XSS-Protection: 1; mode=block");
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// // Check if user is logged in and CSRF token is valid
// if (!isset($_SESSION['user_id']) || !isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
//     // Handle unauthorized access or invalid CSRF token
//     echo "Unauthorized access or invalid CSRF token.";
//     exit;
// }
// signup_process.php
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
//get data
$name = $_POST['name'];
$phoneNumber = $_POST['phoneNumber'];
$checkInDate = $_POST['checkInDate'];
$checkOutDate = $_POST['checkOutDate'];
$numAdults = $_POST['numAdults'];
$numChildren = $_POST['numChildren'];

// Insert data into database
$sql = "INSERT INTO booking (name, phoneNumber, checkInDate, checkOutDate, numAdults, numChildren  ) VALUES ('$name','$phoneNumber', '$checkInDate', '$checkOutDate','$numAdults', '$numChildren')";



if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Booking is successful.'); window.location.href='booking.php';</script>";

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();


?>


