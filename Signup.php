<!DOCTYPE html>
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
            <li><a class="pasive" href="login1.html">Login</a></li>
            <li><a class="pasive" href="sign_up.html">Sign Up</a></li>
          </ul>
        </nav>
    <section class="form-container">
        <form class="form" action="SignupProcess.php" method="POST">
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