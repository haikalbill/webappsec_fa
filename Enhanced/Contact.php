<!DOCTYPE html>
<?php
session_start();
header("Content-Security-Policy: default-src 'self'; frame-src https://www.google.com/maps/embed?*; script-src 'self' https://ajax.googleapis.com");
// Generate CSRF token
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
  }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="Styles/NavigationBar.css">
    <link rel="stylesheet" href="Styles/Contact Us_style.css">
    
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
        
        function addCsrfToken() {
            var csrfToken = "<?php echo $_SESSION['csrf_token']; ?>";
            var forms = document.getElementsByTagName('form');
            for (var i = 0; i < forms.length; i++) {
                var form = forms[i];
                var input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'csrf_token';
                input.value = csrfToken;
                form.appendChild(input);
            }
        }
        
        function sanitizeInput() {
            var inputs = document.getElementsByTagName('input');
            for (var i = 0; i < inputs.length; i++) {
                var input = inputs[i];
                if (input.type === 'text' || input.type === 'email') {
                    input.value = escapeHtml(input.value);
                }
            }
        }
        
        function init() {
            addCsrfToken();
            sanitizeInput();
        }
        
        window.onload = init;
    </script>
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
            <li><a class="pasive" href="About Us.php">About Us</a></li>
            <li><a class="active" href="Contact.php">Contact Us</a></li>
          <li><a class="pasive" href="logout.php">Log Out</a></li>
          
        </ul>
        </nav>

    <h1 class="title-page">Contact Us</h1>
   <div class="flexbox-container">
        <div class="flexbox-main">

            <h3 class="contact-label">Contact</h3>
            <div class="box b1">
                <h4 class="content phoneN">Phone No.  : 012-3456789</h4>
            </div>

            <h3 class="contact-label">Address</h3>
            <div class="box">
                <h4 class="content address">Jalan Gombak, 53100, Selangor <br>
                    Universiti Islam Antarabangsa <br> Malaysia.</h4>
            </div>
        </div>

        <div class="flexbox-main">
            <h3 class="contact-label">Location</h3>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3983.3994748623677!2d101.73248081414566!3d3.2504820534292924!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc38c2f70795af%3A0xf808897bf1163a3!2sUniversiti%20Islam%20Antarabangsa%20Malaysia!5e0!3m2!1sms!2smy!4v1640243472811!5m2!1sms!2smy" width="500" height="550" allowfullscreen="" loading="lazy"></iframe>
        
            </div>
   </div>
</div>

<script src="https://kit.fontawesome.com/57086d82eb.js" crossorigin="anonymous"></script>
</body>
</html>
