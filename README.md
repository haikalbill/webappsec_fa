# Final Assessment

## Group Name
Wazer

## Group Members
1. Nik Raeidi Bin Nik Salimi (2013837)
2. Muhammad Haikal Bin Azhari (2014711)

## Table of Contents
1. [Introduction](#int)
2. [Objective](#obj)
3. [Web Application Security Enhancements](#web)
    1. [Input Validation](#inp)
    2. [Authentication](#authe)
    3. [Authorization](#autho)
    4. [XSS and CSRF Prevention](#xss)
    5. [Database Security Principles](#data)
    6. [File Security Principles](#fil)

## Tittle
Hotel Booking

## <a name="int"/> Introduction
<br>
In our Web Application Security group project, we are tasked with enhancing our previous web application, developed during the Web Technologies course (INFO 2302), by incorporating comprehensive security measures. This involves applying all the security elements and components we've learned in class to ensure the web application is fortified against potential vulnerabilities. Our enhanced web application will demonstrate robust security practices, addressing the most critical aspects of web security. The culmination of this project will be a presentation of the secured web application during the examination week, showcasing our efforts in making the application resilient and secure.

## <a name="obj"/>Objective
<br>
The objective of this Web Application Security group project is to enhance the previously developed web application from the Web Technologies course (INFO 2302) by integrating comprehensive security measures. This involves implementing key security elements such as input validation, authentication, authorization, XSS and CSRF prevention, and enforcing database and file security. The goal is to ensure that the web application provides a secure service to its users, is resilient against common vulnerabilities, and remains available when needed. The project aims to demonstrate our ability to apply learned security principles and techniques to create a robust and secure web application

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


### <a name="xss"/> 4. XSS and CSRF Prevention


### <a name="data"/> 5. Database Security Principles


### <a name="fil"/> 6. File Security Principles


#### Reference:

  
## Weekly Progress Report
