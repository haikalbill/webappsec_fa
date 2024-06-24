<!DOCTYPE html>
<?php
session_start();
header("Content-Security-Policy: default-src 'self'; script-src 'self' https://ajax.googleapis.com");
?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Index</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="Styles/NavigationBar.css">
    <link rel="stylesheet" href="Styles/login1.css" />
    
    <script src="Javascript/onoffline.js"></script>
    <script src="Javascript/Index.js"></script>
    <script src="Javascript/Surprise.js"></script>
    <script src="Javascript/Index-alert.js"></script>
    
    <script>
      function validateForm() {
          var username = document.getElementById('username').value;
          var password = document.getElementById('password').value;

          var usernameRegex = /^[a-zA-Z0-9]+$/;
          if (!usernameRegex.test(username)) {
              alert('Username can only contain letters and numbers.');
              return false;
          }

          if (password.length < 8) {
              alert('Password must be at least 8 characters long.');
              return false;
          }

          var uppercaseRegex = /[A-Z]/;
          if (!uppercaseRegex.test(password)) {
              alert('Password must contain at least one uppercase letter.');
              return false;
          }

          var alphanumericRegex = /[a-zA-Z0-9]/;
          if (!alphanumericRegex.test(password)) {
              alert('Password must be alphanumeric.');
              return false;
          }

          return true;
      }
    </script>
    
  </head>
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
          <li><a class="pasive" href="login.php">Login</a></li>
          <li><a class="pasive" href="signup.php">Sign Up</a></li>
        </ul>
      </nav>
    </nav>

    <section class="form-container">
      <form class="form" action="SignupProcess.php" method="POST" onsubmit="return validateForm()">
        <h2>Sign Up</h2>
        <div class="input-group">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" required />
        </div>
        <div class="input-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" required />
        </div>
        <button type="submit" class="submit-btn">Sign Up</button>
      </form>
    </section>
  </body>
</html>
