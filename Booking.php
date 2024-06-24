
<!DOCTYPE html>
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
    <?php
        // CSRF Protection
        session_start();
        $token = bin2hex(random_bytes(32));
        $_SESSION['csrf_token'] = $token;

        // Validate login
        if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header("Location: booking.php");
        exit;
        }
    ?>
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
        
        <!-- Update the action attribute to point to BookingProcess.php -->
        <form action="BookingProcess.php" id="form" method="post">
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
