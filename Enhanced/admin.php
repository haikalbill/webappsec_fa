<?php
session_start();
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
header("Content-Security-Policy: default-src 'self'; script-src 'self' https://ajax.googleapis.com");

// Validate admin login (you need to add your own admin authentication logic here)
if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] !== true) {
    header("Location: admin_login.php");
    exit;
}

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

// Handle deletion of a booking
if (isset($_GET['delete'])) {
    $id = $conn->real_escape_string($_GET['delete']);
    $delete_sql = "DELETE FROM booking WHERE id='$id'";
    if ($conn->query($delete_sql) === TRUE) {
        echo "<script>alert('Booking deleted successfully.'); window.location.href='admin.php';</script>";
    } else {
        echo "Error: " . $delete_sql . "<br>" . $conn->error;
    }
}

// Retrieve bookings
$sql = "SELECT * FROM booking";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - View Bookings</title>
    <link rel="stylesheet" href="Styles/NavigationBar.css">
    <link rel="stylesheet" href="Styles/Admin_style.css">
</head>
<body>

<nav>
    <a class="logo-link" href="Index.php">
    <nav class="nav-container">
      <div class="logo-container">
        <img class="logo-img" src="Image/Hotel logo.png" />
        <h4>Flower Hotel</h4>
      </div></a>

      <input type="checkbox" id="click" />
      <label for="click" class="menu-btn">
        <i class="fas fa-bars"></i>
      </label>

      <ul class="list-link-container">
        <li><a class="pasive" href="Index.php">Home</a></li>
        <li><a class="pasive" href="Booking.php">Booking</a></li>
        <li><a class="pasive" href="Room.php">Room</a></li>
        <li><a class="pasive" href="Facility.php">Facility</a></li>
        <li><a class="pasive" href="About Us.php">About Us</a></li>
        <li><a class="pasive" href="Contact.php">Contact Us</a></li>
        <li><a class="active" href="admin.php">Admin</a></li>
        <li><a class="pasive" href="logout.php">Log Out</a></li>
      </ul>
    </nav>
</nav>

<div class="container-title">Admin - View Bookings</div>

<div class="container">
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Phone Number</th>
                <th>Check-In Date</th>
                <th>Check-Out Date</th>
                <th>No. of Adults</th>
                <th>No. of Children</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['phoneNumber'] . "</td>";
                    echo "<td>" . $row['checkInDate'] . "</td>";
                    echo "<td>" . $row['checkOutDate'] . "</td>";
                    echo "<td>" . $row['numAdults'] . "</td>";
                    echo "<td>" . $row['numChildren'] . "</td>";
                    echo "<td><a href='admin.php?delete=" . $row['id'] . "' onclick=\"return confirm('Are you sure you want to delete this booking?');\">Delete</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No bookings found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script src="https://kit.fontawesome.com/57086d82eb.js" crossorigin="anonymous"></script>
</body>
</html>

<?php
$conn->close();
?>
