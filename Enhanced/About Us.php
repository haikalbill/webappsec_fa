<!DOCTYPE html>
<?php
header("Content-Security-Policy: default-src 'self'; script-src 'self' https://ajax.googleapis.com");
  // Start session
  session_start();

// Validate login
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  header("Location: login.php");
  exit;
}

  // Generate CSRF token
  if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
  }

  // Function to sanitize input
  function sanitizeInput($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
  }

  // Check if form is submitted
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate CSRF token
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
      die('Invalid CSRF token');
    }

    // Sanitize input data
    $name = sanitizeInput($_POST['name']);
    $message = sanitizeInput($_POST['message']);

    // Perform further validation and processing
    // ...
  }
?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>About Us</title>
    <link rel="stylesheet" href="Styles/NavigationBar.css" />
    <link rel="stylesheet" href="Styles/About Us_style.css" />
    <link rel="stylesheet" href="Styles/Scrollbar.css" />
    <script src="Javascript/onoffline.js"></script>
  </head>
  <body ononline="onFunction()" onoffline="offFunction()">
   
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
          <li><a class="active" href="About Us.php">About Us</a></li>
          <li><a class="pasive" href="Contact.php">Contact Us</a></li>
          <li><a class="pasive" href="logout.php">Log Out</a></li>
        </ul>
      </nav>

    <h1 class="title-page">About Us</h1>
    <div class="flexbox-container c1">
      <div class="flexbox-main">
        <h4 class="main-content">
          Welcome to Flower Hotel, your number one choice in staying. As we
          continue to grow, we don't lose sight of what's most important to
          people. Flower hotel is a workplace where coworkers become friends.
          Every day we care for our guests. Care is at the heart of our
          business, and it's distinct guest experience that makes Flower one of
          the world's best hospitality brands. Meet Flower thrive, our corporate
          social responsibility platform. Our purpose of care defines our
          practice of responsibility. By building strong communities and
          fostering sustainable practices, we're wroking to create an
          environment in which people thrive. As the Flower footprint expands to
          meet the needs of a more connected and traveled world, we have the
          oppurtunity and the responsibility to grow with purpose and to protect
          our environment for generations to come.
        </h4>

        <div class="hotel-video-box">
          <video controls autoplay>
            <source src="Video/Flower Hotel.mp4" type="video/mp4"/>
          </video>
        </div>

      </div>

    </div>
    <div class="flexbox-container">
      <div class="flexbox-main">
        <h1 class="title-page">Sustainability Commitment</h1>
        <h4 class="main-content">
          As part of the hotel's on-going commitment to environmental
          sustainability, we use our 10% profits to fund and an organisation
           that help in eradicating plastic waste in the sea as part of our 
           contribution to the world community.
           And also <strong>support the Malaysia Tourism</strong> 
        </h4>
      </div>
    </div>

    <div class="flexbox-container c2">
      <div class="flexbox">
        <h3 class="sub-title">Mission</h3>
        <p class="content">
          To provide outstanding lodging Facility and services to our guests
          that encourage sustainability strategies.
        </p>
      </div>
      <div class="flexbox">
        <h3 class="sub-title">Vision</h3>
        <p class="content">
          To continue to apply and set the highest standards of service quality
          that justify and uphold the reputation.
        </p>
      </div>
      <div class="flexbox">
        <h3 class="sub-title">Goals</h3>
        <p class="content">
          Achieve the establishment of sustainable growth that highlights the
        </p>
      </div>
      <div class="flexbox">
        <h3 class="sub-title">Essence</h3>
        <p class="content">Being attentive to the guest request and needs</p>
      </div>
      <div class="flexbox">
        <h3 class="sub-title">Promise</h3>
        <p class="content">
          Ensure that our lodging Facility and environment are adequately
          meeting the needs of guest
        </p>
      </div>
    </div>
    <script src="https://kit.fontawesome.com/57086d82eb.js" crossorigin="anonymous"></script>
  </body>
</html>

