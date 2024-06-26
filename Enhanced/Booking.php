<!DOCTYPE html>
<?php
// Content Security Policy Header
header("Content-Security-Policy: default-src 'self'; script-src 'self' https://ajax.googleapis.com; style-src 'self'");
session_start();
$token = bin2hex(random_bytes(32));
$_SESSION['csrf_token'] = $token;

// Validate login
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="Styles/NavigationBar.css">
    <link rel="stylesheet" href="Styles/Booking_style.css">
    <script src="Javascript/Book.js"></script>
    <script src="Javascript/onoffline.js"></script>
    <script src="Javascript/Hide_form.js"></script>

    <script>
        function validateBookingForm() {
            var name = document.getElementById('name').value;
            var phoneNumber = document.getElementById('phoneNumber').value;
            var checkInDate = document.getElementById('checkInDate').value;
            var checkOutDate = document.getElementById('checkOutDate').value;
            var numAdults = document.getElementById('numAdults').value;
            var numChildren = document.getElementById('children').value;

            // Regex for name validation
            var nameRegex = /^[a-zA-Z\s]+$/;
            if (!nameRegex.test(name)) {
                alert('Name can only contain letters and spaces.');
                return false;
            }

            // Regex for phone number validation
            var phoneRegex = /^[0-9]{10,11}$/;
            if (!phoneRegex.test(phoneNumber)) {
                alert('Phone number must be between 10 and 11 digits.');
                return false;
            }

            // Check date fields
            if (checkInDate === '') {
                alert('Check-in date is required.');
                return false;
            }
            if (checkOutDate === '') {
                alert('Check-out date is required.');
                return false;
            }
            if (new Date(checkInDate) >= new Date(checkOutDate)) {
                alert('Check-out date must be after the check-in date.');
                return false;
            }

            // Check number fields
            if (numAdults <= 0) {
                alert('Number of adults must be at least 1.');
                return false;
            }
            if (numChildren < 0) {
                alert('Number of children cannot be negative.');
                return false;
            }

            return true;
        }
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
            <li><a class="active" href="Booking.php">Booking</a></li>
            <li><a class="pasive" href="Room.php">Room</a></li>
            <li><a class="pasive" href="Facility.php">Facility</a></li>
            <li><a class="pasive" href="About Us.php">About Us</a></li>
            <li><a class="pasive" href="Contact.php">Contact Us</a></li>
            <li><a class="pasive" href="logout.php">Log Out</a></li>
          </ul>
        </nav>

    <div class="container-title">Booking</div>

    <div class="flexbox-container">
      <h4 class="main-content">
      <strong>FLOWER HOTEL 4-STAR HOTEL IN GOMBAK CITY , KUALA LUMPUR </strong> <br>
         FLOWER Hotel makes up one of the trifecta of hotels within Gombak City, 
         offering greenest scenery ever to the customer with the great facilities 
         that always been take care by our staffs. These include the East Mall 
         and Melawati shopping Mall.With the added facilities and various event
          venues located within walking distance, FLOWER Hotel is ideal for guests 
          travelling both for honeymoon and leisure. <br> <br> <strong> Come and join us.</strong> <br>Press the button below.
      </h4>
    </div>
    
    <div class="button-container">
        <button id="more">Book Now</button>
    </div>
<div class="body">  
    <div class="container">
        <div class="content">
        <form action="BookingProcess.php" id="form" method="post" onsubmit="return validateBookingForm()">
            <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">
            <div class="user_details">

            <div class="input_box">
                <label for="name">Name :</label> 
                <input type="text" name="name" id="name">
            </div>
               
            <div class="input_box">
                <label for="pnumber">Phone no. :</label>
                <input type="text" name="phoneNumber" id="phoneNumber">
            </div> 

            <div class="input_box">        
                <label for="checkInDate">Check-in :</label>
                <input type="date" name="checkInDate" id="checkInDate">
            </div>

            <div class="input_box">
                <label for="checkOutDate">Check-out :</label>
                <input type="date" name="checkOutDate" id="checkOutDate">
            </div> 

            <div class="input_box">
                <label for="numAdults">No. adult :</label>
                <input type="number" name="numAdults" id="numAdults">
            </div>
             
            <div class="input_box">
                <label for="numChildren">No. children :</label>
                <input type="number" name="numChildren" id="children">
            </div>
            
            <!-- Add a submit button to the form -->
            <div class="button">
                <input type="submit" value="Submit Booking">
            </div>
            
            </div>
        </form>
        </div>
        </div>
    </div>
</div>
<script src="https://kit.fontawesome.com/57086d82eb.js" crossorigin="anonymous"></script>
</body>
</html>
</div>
<script src="https://kit.fontawesome.com/57086d82eb.js" crossorigin="anonymous"></script>
</body>
</html>

