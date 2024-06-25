# Final Assessment

## Group Name
Wazer

## Group Members
1. Nik Raeidi Bin Nik Salimi (2013837)
2. Muhammad Haikal Bin Azhari (2014711)

## Table of Contents
1. [Introduction](#int)
2. [Objective](#obj)
3. Task
4. [Web Application Security Enhancements](#web)
    1. [Input Validation](#inp)
    2. [Authentication](#authe)
    3. [Authorization](#autho)
    4. [XSS and CSRF Prevention](#xss)
    5. [Database Security Principles](#data)
    6. [File Security Principles](#fil)

## Tittle
### 🏨Flower Hotel Booking

## <a name="int"/> Introduction
<br>
In our Web Application Security group project, we are tasked with enhancing our previous web application, developed during the Web Technologies course (INFO 2302), by incorporating comprehensive security measures. This involves applying all the security elements and components we've learned in class to ensure the web application is fortified against potential vulnerabilities. Our enhanced web application will demonstrate robust security practices, addressing the most critical aspects of web security. The culmination of this project will be a presentation of the secured web application during the examination week, showcasing our efforts in making the application resilient and secure.

## <a name="obj"/>Objectives
<br>
The objectives of this Web Application Security group project is to enhance the previously developed web application from the Web Technologies course (INFO 2302) by integrating comprehensive security measures. This involves implementing key security elements such as input validation, authentication, authorization, XSS and CSRF prevention, and enforcing database and file security. The goal is to ensure that the web application provides a secure service to its users, is resilient against common vulnerabilities, and remains available when needed. The project aims to demonstrate our ability to apply learned security principles and techniques to create a robust and secure web application


## Task Distribution
| Name | Matric No | Task |
|---------|-------------|------------------------------|
| Nik Raeidi Bin Nik Salimi | 2013837 | Input Validation, Aunthentication, Authorization |
| Muhammad Haikal Bin Azhari | 2014711 | XSS & CSRF Prevention, Database Security Principles, File Security Principles |




## <a name="web"/>Web Application Security Enhancements:

### <a name="inp"/> 1.Input Validation
for login.php and LoginProcess.php
Client-Side Validation
Username Validation:
Implementation: The username field is validated to only allow alphanumeric characters (letters and numbers) using the regex /^[a-zA-Z0-9]+$/.

Password Validation:
Length Check: The password must be at least 8 characters long
Uppercase Check: The password must contain at least one uppercase letter, enforced using the regex /[A-Z]/.
Alphanumeric Check: The password must be alphanumeric, ensuring it contains only letters and numbers, using the regex /[a-zA-Z0-9]/.

Server-Side Validation
SQL Injection Prevention
Implementation: The username is sanitized using real_escape_string before it is used in the SQL query.
Password Verification
Implementation: The submitted password is checked against the hashed password stored in the database using password_verify
Session Fixation Prevention:
Implementation: session_regenerate_id(true) is called after a successful login.

for Signup.php and SignupProcess.php

Client-Side Validation:
HTML5 Validation: Uses the required attribute to ensure fields are not empty.
JavaScript Validation:
Username Validation:
The username is validated to ensure it contains only alphanumeric characters using the regex /^[a-zA-Z0-9]+$/.
Password Validation:
The password is validated to ensure it is at least 8 characters long.
It must contain at least one uppercase letter, validated using the regex /[A-Z]/.
It must be alphanumeric, validated using the regex /[a-zA-Z0-9]/.

Server-Side Validation:
Sanitization: Uses htmlspecialchars and trim to sanitize inputs, preventing XSS attacks.
Validation:
Username: Ensures it is alphanumeric.
Password: 
Check for uppercase letter:
preg_match('/[A-Z]/', $password): This checks if the password contains at least one uppercase letter (A-Z).
Check for alphanumeric:
preg_match('/[a-zA-Z0-9]/', $password): This ensures that the password contains only alphanumeric characters (a-z, A-Z, 0-9).
Password Hashing: Hashes the password using password_hash with the PASSWORD_BCRYPT algorithm.
Database Check: Checks if the username already exists in the database to prevent duplicates.

### <a name="authe"/> 2. Authentication


### <a name="autho"/> 3. Authorization
Regenerating Session IDs on Authentication
Explanation: This function regenerates the session ID upon successful login, which helps prevent session fixation attacks. By regenerating the session ID, you ensure that a new, unique session is created for each authenticated user session.

Enforcing Idle Session Timeout
Explanation: This code checks if the user has been inactive for a specified period (30 minutes). If the user is inactive for longer than this period, the session is destroyed, and the user is redirected to the login page. The $_SESSION['last_activity'] variable is updated with the current timestamp on each request to track the user's activity.

Enforcing Absolute Session Timeout
Explanation: This code enforces an absolute session timeout, where the session is terminated after a fixed duration (1 hour) regardless of user activity. The $_SESSION['created'] variable stores the session creation time, and if the session age exceeds the specified lifetime, the session is destroyed, and the user is redirected to the login page.

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

