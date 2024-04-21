<!DOCTYPE html>
<html>
<head>
    <style>
        /* login.css */

body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    margin: 0;
    padding: 0;
}

.form {
    width: 300px;
    margin: 0 auto;
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.login-title {
    margin-bottom: 20px;
    text-align: center;
}

.login-input {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

.login-button {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    border: none;
    border-radius: 5px;
    color: #fff;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.login-button:hover {
    background-color: #0056b3;
}

.link {
    text-align: center;
}

.link a {
    color: #007bff;
}

.link a:hover {
    text-decoration: none;
    color: #0056b3;
}

.img {
    width: 100px;
    height: 100px;
    display: block;
    margin: 0 auto;
    margin-bottom: 20px;
    border-radius: 50%;
}

hr {
    margin-top: 20px;
    margin-bottom: 20px;
    border: 0;
    border-top: 1px solid #ccc;
}

    <meta charset="utf-8"/>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>Hands From Heaven | Login Form</title>
    <link rel="stylesheet" href="../assets/css/login.css"/>
   
    </style>
</head>
<body>
<?php
// Start session and include database connection
session_start();
require('config.php');

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// When form submitted, check and create user session.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = stripslashes($_POST['email']);
    $password = stripslashes($_POST['password']);

    // Check user in NGO table
    $query = "SELECT * FROM ngo WHERE email='$email'";
    $result = pg_query($con, $query);

    if (!$result) {
        die('Query error: ' . pg_last_error());
    }

    $row = pg_fetch_assoc($result);

    if ($row) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $email;
            // Redirect to user dashboard page
            header("Location: index.php");
            exit;
        }
    }

    // Check user in Company table if not found in NGO table
    $query = "SELECT * FROM company WHERE email='$email'";
    $result = pg_query($con, $query);

    if (!$result) {
        die('Query error: ' . pg_last_error());
    }

    $row = pg_fetch_assoc($result);

    if ($row) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $email;
            // Redirect to user dashboard page
            header("Location: index.php");
            exit;
        }
    }

    // Display error message if not found in both tables or incorrect password
    echo "<div class='form'>
                <h3>Incorrect Email/Password.</h3><br/>
                <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                </div>";
}
?>


<form class="form" method="post" name="login">
    
    <hr />
    <h1 class="login-title">Login</h1>
    <input type="text" class="login-input" name="email" placeholder="Email" autofocus="true"/>
    <input type="password" class="login-input" name="password" placeholder="Password"/>
    <input type="submit" value="Login" name="submit" class="login-button"/>
    <p class="link">Don't have an account? <a href="register.php">Register here!</a></p>
    <hr />

    
    <div class="g_id_signin"
         data-type="standard"
         data-shape="rectangular"
         data-theme="outline"
         data-text="signin_with"
         data-size="large"
         data-logo_alignment="center"
         data-callback="onSignIn">
    </div>
</form>

<script src="js/script.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</body>
</html>
