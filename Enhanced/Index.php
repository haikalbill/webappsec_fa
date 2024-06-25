<?php
session_start();
header("Content-Security-Policy: default-src 'self'; script-src 'self' https://ajax.googleapis.com");
// Validate login
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  header("Location: login.php");
  exit;
}

// Validate CSRF token
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    die('Invalid CSRF token');
  }
}

// Function to sanitize input
function sanitizeInput($input) {
  return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Index</title>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="Styles/NavigationBar.css">
  <link rel="stylesheet" href="Styles/Index_style.css" />

  <script src="Javascript/onoffline.js"></script>
  <script src="Javascript/Index.js"></script>
  <script src="Javascript/Surprise.js"></script>
  <script src="Javascript/Index-alert.js"></script>

  <body ononline="onFunction()" onoffline="offFunction()">

    <nav>
    <a class="logo-link" href="Index.html">
      <nav class="nav-container">
      <div class="logo-container">
        <img class="logo-img" src="Image/Hotel logo.png" />
        <h4>Flower Hotel</h4>
      </div>
    </a>

    <input type="checkbox" id="click" />
    <label for="click" class="menu-btn">
      <i class="fas fa-bars"></i>
    </label>

    <ul class="list-link-container">
      <li><a class="active" href="Index.php">Home</a></li>
      <li><a class="pasive" href="Booking.php">Booking</a></li>
      <li><a class="pasive" href="Room.php">Room</a></li>
      <li><a class="pasive" href="Facility.php">Facility</a></li>
      <li><a class="pasive" href="About Us.php">About Us</a></li>
      <li><a class="pasive" href="Contact.php">Contact Us</a></li>
      <li><a class="pasive" href="logout.php">Log Out</a></li>
    </ul>
    </nav>

    <section class="flexbox-container">
    <div class="flexbox f1">
      <img id="music-btn" class="logo-img1" src="Image/Hotel logo.png" />
    </div>
    <div class="flexbox f2">
      <h1 class="title-logo">Flower Hotel</h1>
      <p class="slogon">Here where the story start to bloom</p>
      <button class="learn-more" type="button" onclick="window.location.href = 'About Us.php';">LEARN MORE</button>

      <p onclick="music_alert()" class="notice">Click Here </p>
    </div>
    </section>

    <audio id="music-box" loop>
    <source src="Audio/Flower (Crash Landing On You OST)-Instrumental.mp3" type="audio/mpeg">
    </audio>
    <script src="https://kit.fontawesome.com/57086d82eb.js" crossorigin="anonymous"></script>
  </body>
</html>
