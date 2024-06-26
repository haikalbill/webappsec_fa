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

// Validate name
if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
    $errors[] = 'Name can only contain letters and spaces.';
}

// Validate phone number
if (!preg_match('/^[0-9]{10,11}$/', $phoneNumber)) {
    $errors[] = 'Phone number must be between 10 and 11 digits.';
}

// Validate dates
if (empty($checkInDate)) {
    $errors[] = 'Check-in date is required.';
}
if (empty($checkOutDate)) {
    $errors[] = 'Check-out date is required.';
}
if (!empty($checkInDate) && !empty($checkOutDate) && strtotime($checkInDate) >= strtotime($checkOutDate)) {
    $errors[] = 'Check-out date must be after the check-in date.';
}

// Validate number of adults
if ($numAdults <= 0) {
    $errors[] = 'Number of adults must be at least 1.';
}

// Validate number of children
if ($numChildren < 0) {
    $errors[] = 'Number of children cannot be negative.';
}

// If there are validation errors, display them and stop execution
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<script>alert('$error'); window.history.back();</script>";
    }
    exit;
}

// Insert data into database
$sql = "INSERT INTO booking (name, phoneNumber, checkInDate, checkOutDate, numAdults, numChildren  ) VALUES ('$name','$phoneNumber', '$checkInDate', '$checkOutDate','$numAdults', '$numChildren')";



if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Booking is successful.'); window.location.href='booking.php';</script>";

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();


?>


