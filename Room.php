<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self'; object-src 'none';">
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Room</title>
    <link rel="stylesheet" href="Styles/NavigationBar.css" />
    <link rel="stylesheet" href="Styles/Room_style.css" />
    <script src="Javascript/onoffline.js"></script>
    <script>
      function escapeHtml(unsafe) {
        return unsafe
          .replace(/&/g, "&amp;")
          .replace(/</g, "&lt;")
          .replace(/>/g, "&gt;")
          .replace(/"/g, "&quot;")
          .replace(/'/g, "&#039;");
      }
    </script>
  </head>
  <body ononline="onFunction()" onoffline="offFunction()">
    <?php
      session_start();
      $token = bin2hex(random_bytes(32));
      $_SESSION['csrf_token'] = $token;

      // Validate login
      if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
      header("Location: login.php");
      exit;
      }
    ?>
    <nav>
      <a class="logo-link" href="Index.php">
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
        <li><a class="passive" href="Index.php">Home</a></li>
        <li><a class="pasive" href="Booking.php">Booking</a></li>
        <li><a class="active" href="Room.php">Room</a></li>
        <li><a class="pasive" href="Facility.php">Facility</a></li>
        <li><a class="pasive" href="About Us.php">About Us</a></li>
        <li><a class="pasive" href="Contact.php">Contact Us</a></li>
        <li><a class="pasive" href="logout.php">Log Out</a></li>
      </ul>
    </nav>

    <h1 class="page-title">Room</h1>

    <div class="flexbox-container">
      <h4 class="main-content">
        We know how important a good night’s sleep can be and also how much
        difference real rest and recuperation can mean to you. At our hotel, we
        take great pride and care in providing you a plush sanctuary of
        uncompromised comfort for you to indulge in. Planning getaways or taking
        that well-deserved break now seems so much more intriguing with our
        hotel promotions at great value you will appreciate.Plan a perfect
        getaway with your loved ones and create a notable experience with us.
      </h4>
    </div>

    <div class="flexbox-container">
      <div class="flexbox">
        <div class="image img1"></div>
        <h3 class="sub-title">Single Room</h3>
        <p class="content">
          A room with the facility of single bed. It is meant for single
          occupancy. It has an attached bathroom, a small dressing table, a
          small bedside table, and a small writing table
        </p>
      </div>
      <div class="flexbox">
        <div class="image img2"></div>
        <h3 class="sub-title">Double Room</h3>
        <p class="content">
          A room with the facility of double bed. There are two variants in this
          type depending upon the size of the bed such as a room with king size
          double bed or room with queen size double bed.
        </p>
      </div>
      <div class="flexbox">
        <div class="image img3"></div>
        <h3 class="sub-title">Twin Room</h3>
        <p class="content">
          This room provides two single beds with separate headboards. It is
          meant for two independent people. It also has a single bedside table
          shared between the two beds.
        </p>
      </div>
      <div class="flexbox">
        <div class="image img4"></div>
        <h3 class="sub-title">Regular Suite</h3>
        <p class="content">
          It is composed of one or more bedrooms, a living room, and a dining
          area. It is excellent for the guests who prefer more space, wish to
          entertain their guests without interruption and giving up privacy.
        </p>
      </div>
    </div>
    <script src="https://kit.fontawesome.com/57086d82eb.js" crossorigin="anonymous"></script>
    <script>
      // CSRF token
      const token = "<?php echo $token; ?>";
      const forms = document.getElementsByTagName("form");
      for (let i = 0; i < forms.length; i++) {
        forms[i].insertAdjacentHTML(
          "beforeend",
          `<input type="hidden" name="csrf_token" value="${token}">`
        );
      }

      // XSS protection
      const elements = document.querySelectorAll(".content");
      for (let i = 0; i < elements.length; i++) {
        elements[i].innerHTML = escapeHtml(elements[i].innerHTML);
      }
    </script>
  </body>
</html>
