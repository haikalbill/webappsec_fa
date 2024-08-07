# Final Assessment

## Group Name
Wazer

## Group Members
1. Nik Raeidi Bin Nik Salimi (2013837)
2. Muhammad Haikal Bin Azhari (2014711)

## Table of Contents
1. [Introduction](#int)
2. [Objective](#obj)
3. [Task](#task)
4. [Web Application Security Enhancements](#web)
    1. [Input Validation](#inp)
    2. [Authentication](#authe)
    3. [Authorization](#autho)
    4. [XSS and CSRF Prevention](#xss)
    5. [Database Security Principles](#data)
    6. [File Security Principles](#fil)

## Tittle
### 🏨Flower Hotel Booking
<br>

## <a name="int"/> Introduction
<br>
In our Web Application Security group project, we are tasked with enhancing our previous web application, developed during the Web Technologies course (INFO 2302), by incorporating comprehensive security measures. This involves applying all the security elements and components we've learned in class to ensure the web application is fortified against potential vulnerabilities. Our enhanced web application will demonstrate robust security practices, addressing the most critical aspects of web security. The culmination of this project will be a presentation of the secured web application during the examination week, showcasing our efforts in making the application resilient and secure.

## <a name="obj"/>Objectives
<br>
The objectives of this Web Application Security group project is to enhance the previously developed web application from the Web Technologies course (INFO 2302) by integrating comprehensive security measures. This involves implementing key security elements such as input validation, authentication, authorization, XSS and CSRF prevention, and enforcing database and file security. The goal is to ensure that the web application provides a secure service to its users, is resilient against common vulnerabilities, and remains available when needed. The project aims to demonstrate our ability to apply learned security principles and techniques to create a robust and secure web application


## <a name="task"/>Task Distribution
| Name | Matric No | Task |
|---------|-------------|------------------------------|
| Nik Raeidi Bin Nik Salimi | 2013837 | Input Validation, Aunthentication, Authorization |
| Muhammad Haikal Bin Azhari | 2014711 | XSS & CSRF Prevention, Database Security Principles, File Security Principles |




## <a name="web"/>Web Application Security Enhancements:

### <a name="inp"/> 1.Input Validation (Haikal & Raeidi)
1. For login.php and LoginProcess.php
  - Username Validation:
    - The username field is validated to only allow alphanumeric characters (letters and numbers) using the regex /^[a-zA-Z0-9]+$/.
  - Password Validation:
    - Length Check: The password must be at least 8 characters long
    - Uppercase Check: The password must contain at least one uppercase letter, enforced using the regex /[A-Z]/.
    - Lowercase Check: The password must contain at least one uppercase letter, enforced using the regex /[a-z]/.
    - Number Check: The password must contain at least one number, enforced using the regex /[0-9]/.
    - Alphanumeric Check: The password must be alphanumeric, ensuring it contains only letters and numbers, using the regex /[a-zA-Z0-9]/.
````
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
          var lowercaseRegex = /[a-z]/;
          if (!lowercaseRegex.test(password)) {
            alert('Password must contain at least one lowercase letter.');
            return false;
          }
          var numberRegex = /[0-9]/;
          if (!numberRegex.test(password)) {
            alert('Password must contain at least one number.');
            return false;
          }
          var alphanumericRegex = /[a-zA-Z0-9]/;
          if (!alphanumericRegex.test(password)) {
            alert('Password must be alphanumeric.');
            return false;
          }
````

2. For Signup.php and SignupProcess.php

- Client-Side Validation
  - HTML5 Validation:
    - Uses the required attribute to ensure fields are not empty.
  - Username Validation:
    - The username field is validated to only allow alphanumeric characters (letters and numbers) using the regex /^[a-zA-Z0-9]+$/.
  - Password Validation:
    - Length Check: The password must be at least 8 characters long
    - Uppercase Check: The password must contain at least one uppercase letter, enforced using the regex /[A-Z]/.
    - Lowercase Check: The password must contain at least one uppercase letter, enforced using the regex /[a-z]/.
    - Number Check: The password must contain at least one number, enforced using the regex /[0-9]/.
    - Alphanumeric Check: The password must be alphanumeric, ensuring it contains only letters and numbers, using the regex /[a-zA-Z0-9]/.

- Server-Side Validation:
  - Sanitization:
    - Uses htmlspecialchars and trim to sanitize inputs, preventing XSS attacks.
  - Username Validation:
    - preg_match('/^[a-zA-Z0-9]+$/', $username): check only alphanumeric characters are allowed
  - Password Validation:
    - Length Check: strlen($password) < 8 : ensure at least 8 characters long.
    - Uppercase Check: preg_match('/[A-Z]/', $password) : ensure contain at least one uppercase letter.
    - Lowercase Check: preg_match('/[a-z]/', $password) : ensure contain at least one lowercase letter.
    - Number Check: preg_match('/[0-9]/', $password) : ensure contain at least one number.
    - Alphanumeric Check: preg_match('/[a-zA-Z0-9]/', $password) : ensure it is only alphanumeric.
  - Database Check: Checks if the username already exists in the database to prevent duplicates.
````
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
        var lowercaseRegex = /[a-z]/;
        if (!lowercaseRegex.test(password)) {
            alert('Password must contain at least one lowercase letter.');
            return false;
        }
        var numberRegex = /[0-9]/;
        if (!numberRegex.test(password)) {
            alert('Password must contain at least one number.');
            return false;
        }
        var alphanumericRegex = /[a-zA-Z0-9]/;
        if (!alphanumericRegex.test(password)) {
            alert('Password must be alphanumeric.');
            return false;
        }
````
````
// Validate password
if (strlen($password) < 8) {
    die('Password must be at least 8 characters long.');
}
if (!preg_match('/[a-z]/', $password)) {
    die('Password must contain at least one lowercase letter.');
}
if (!preg_match('/[A-Z]/', $password)) {
    die('Password must contain at least one uppercase letter.');
}
if (!preg_match('/[0-9]/', $password)) {
    die('Password must contain at least one number.');
}
if (!preg_match('/[a-zA-Z0-9]/', $password)) {
    die('Password must be alphanumeric.');
}
````
````
// Check if username already exists
$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    die('Username already exists.');
}
````

3. For Booking.php and BookingProcess.php
- Client-Side Validation
  - Username Validation:
    - The username field is validated to only allow letters and spaces  using the regex /^[a-zA-Z\s]+$/.
  - Phone Validation:
    - Only allow phone number between 10 and 11 digits using the regex /^[0-9]{10,11}$/.
  - Date Validation:
    - Ensure check-out date must be after the check-in date.
  - Adults Validation:
    - Ensure number of adults must be at least 1.
  - Child Validation:
    - Ensure number of children is not negative.

- Server-Side Validation:
  - Username Validation:
    - preg_match('/^[a-zA-Z\s]+$/', $name), ensure name can only contain letters and spaces.
  - Phone Validation:
    - preg_match('/^[0-9]{10,11}$/', $phoneNumber). ensure phone number between 10 and 11 digits.
  - Date Validation:
    - empty($checkInDate), ensure check-in date is required.
    - empty($checkOutDate), ensure ensure check-out date is required.
    - strtotime($checkInDate) >= strtotime($checkOutDate), ensure check-out date after the check-in date.
  - Adults Validation:
    - ($numAdults <= 0), ensure number of adults must be at least 1.
  - Child Validation:
    - ($numChildren < 0), ensure number of children is not negative.
````
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
````
````
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
````

### <a name="authe"/> 2. Authentication (Raeidi)

1. Added a login and signup page where username and password need to be enter.

2. Securing Password-Based Authentication
- The password complexity are set Numbers + Lowercase Letters + Uppercase letters + at least 8 characters by using regex
````
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
          var lowercaseRegex = /[a-z]/;
          if (!lowercaseRegex.test(password)) {
            alert('Password must contain at least one lowercase letter.');
            return false;
          }
          var numberRegex = /[0-9]/;
          if (!numberRegex.test(password)) {
            alert('Password must contain at least one number.');
            return false;
          }
          var alphanumericRegex = /[a-zA-Z0-9]/;
          if (!alphanumericRegex.test(password)) {
            alert('Password must be alphanumeric.');
            return false;
          }
````
- Properly store passwords by using hashing algorithm
````
// Hash the password
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);
````
![Screenshot 2024-06-26 085516](https://github.com/haikalbill/webappsec_fa/assets/162496054/7af3f5ca-d478-43df-ab65-a4195292d227)

3. Allow account lockout (prevent brute-force attack)
- Allow account to be lockout for 15 minutes if failed attempt more than 5 times and timeframe are recorded in the database.  
````
// Check if the account is locked
    $lockout_duration = 15 * 60; // 15 minutes in seconds
    $current_time = time();
    $last_failed_attempt = strtotime($row['last_failed_attempt']);
    $failed_attempts = $row['failed_attempts'];

    if ($failed_attempts >= 5 && ($current_time - $last_failed_attempt) < $lockout_duration) {
        echo "<script>alert('Account is locked. Please try again after 15 minutes.'); window.location.href='login.php';</script>";
        exit;
    } elseif (($current_time - $last_failed_attempt) >= $lockout_duration) {
        // Reset failed attempts after lockout duration
        $failed_attempts = 0;
        $sql = "UPDATE users SET failed_attempts = 0, last_failed_attempt = NULL WHERE username='$username'";
        $conn->query($sql);
    }
    if (password_verify($password, $row['password'])) {
        // Reset failed attempts on successful login
        $sql = "UPDATE users SET failed_attempts = 0, last_failed_attempt = NULL WHERE username='$username'";
        $conn->query($sql);
        ...
        // Update failed attempts count and timestamp
        $failed_attempts++;
        $sql = "UPDATE users SET failed_attempts = $failed_attempts, last_failed_attempt = NOW() WHERE username='$username'";
        $conn->query($sql);
````

### <a name="autho"/> 3. Authorization (Raeidi)
1. Add a admin user where it can see the booking records and delete data.
````
// Redirect to Index.php or admin.php based on user role
         // Check if the user is Admin123
        if ($username === 'Admin123') {
            $_SESSION['admin_loggedin'] = true;
            header("Location: admin.php");
            exit;
        } else {
            // Redirect to Index.php for regular users
            header("Location: Index.php");
            exit;
        }
````

2. Regenerating Session IDs on Authentication
````
session_regenerate_id(true);
````
  
3. Enforcing Idle Session Timeout
````
$inactive = 1800; // 30 minutes in seconds
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $inactive)) {
    session_unset(); // unset $_SESSION variable for the run-time
    session_destroy(); // destroy session data in storage
    header("Location: login.php"); // Redirect to login page
    exit;
}
$_SESSION['last_activity'] = time(); // Update last activity time stamp
````

4. Enforcing Absolute Session Timeout
````
$session_lifetime = 3600; // 1 hour in seconds
if (isset($_SESSION['created']) && (time() - $_SESSION['created'] > $session_lifetime)) {
    session_unset(); // unset $_SESSION variable for the run-time
    session_destroy(); // destroy session data in storage
    header("Location: login.php"); // Redirect to login page
    exit;
}
$_SESSION['created'] = time(); // Set session creation time
````

### <a name="xss"/> 4. XSS and CSRF Prevention (Haikal)

1. CSP Header: The script correctly sets a Content Security Policy header, which is a good practice for mitigating some types of XSS attacks by preventing the browser from loading malicious scripts from unauthorized sources.
![image](https://github.com/haikalbill/webappsec_fa/assets/90669152/c6f039e0-fc1b-4ef3-b814-af443dbc8b53)


CSRF Protection:
CSRF Token Generation: The code generates a CSRF token using bin2hex(random_bytes(32)) and stores it in the user's session with $_SESSION['csrf_token'] = $token;. This token should be included in forms as a hidden input and verified on form submission to protect against CSRF attacks.
- ![image](https://github.com/haikalbill/webappsec_fa/assets/90669152/abb7c0d4-3ef1-4096-a416-7d48ac67f71f)

2. Sanitization of Input: The function sanitizeInput() uses htmlspecialchars() and trim() to sanitize user inputs, which is a common defense against XSS attacks. This function is applied to the $name and $message variables after they are received from the POST request, ensuring that any HTML special characters are converted to their corresponding HTML entities. This prevents malicious scripts from being executed in the browser.
- ![image](https://github.com/haikalbill/webappsec_fa/assets/90669152/06575ff1-f0fe-430c-a243-9e9915b9d648)



### <a name="data"/> 5. Database Security Principles (Haikal)

1. SQL Injection Prevention: The code uses $conn->real_escape_string($username) to escape special characters in the $username variable before it is used in the SQL query. This is a basic measure against SQL injection attacks.

- ![image](https://github.com/haikalbill/webappsec_fa/assets/90669152/fb217c25-27c3-4ed2-9f7d-46e4e2ac9989)

2. Password Hashing Verification: It uses password_verify($password, $row['password']) to check the password. This function is secure for verifying hashed passwords, indicating that passwords are not stored in plain text in the database.

- ![image](https://github.com/haikalbill/webappsec_fa/assets/90669152/70dc7215-9df9-43fd-9fa7-b8093c115ed0)
- ![image](https://github.com/haikalbill/webappsec_fa/assets/90669152/51291578-33c6-4a46-aff5-79d2e9795926)


3. Error Handling: Where a more secure approach is to handle errors without revealing details about the system or database structure to the end-user.
- ![image](https://github.com/haikalbill/webappsec_fa/assets/90669152/16abb892-e001-4634-9451-6da123a03100)




### <a name="fil"/> 6. File Security Principles (Haikal)
1. SSL Certificate & HTTPS: Use a HTTPS to encrypt data transmitted between the client and server, protecting the data from being intercepted or tampered with.
- ![image](https://github.com/haikalbill/webappsec_fa/assets/90669152/f6b98825-37d6-4d47-b8f7-24fea74b4cb9)
- ![image](https://github.com/haikalbill/webappsec_fa/assets/90669152/e87f1e59-6497-4b26-8d7c-daaff417245f)


#### References:
1. Class Slides
2. www.w3schools.com
3. www.tutorialspoint.com
4. https://stackoverflow.com/
5. www.php.net
6. www.simplilearn.com

