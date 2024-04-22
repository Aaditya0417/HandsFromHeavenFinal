<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>Hands From Heaven | Login Form</title>
    <link href="assets/css/login.css" rel="stylesheet">
    <!-- Add Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <!-- Custom styles for this template -->
    <style>
        /* Position the carousel behind the form */
        #home-carousel {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1; /* Ensure the carousel stays behind the form */
        }

        /* Style adjustments for the form */
        .form {
            position: relative;
            z-index: 1; /* Ensure the form stays above the carousel */
            max-width: 400px; /* Adjust form width as needed */
            margin: 0 auto; /* Center the form horizontally */
            padding: 20px;
            background: #fff; /* Set form background color */
            border-radius: 8px; /* Add border radius to the form */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add shadow to the form */
        }

        /* Ensure the carousel images fill the container */
        .swiper-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>
<body>

<?php
session_start();
require('config.php');

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
            $_SESSION['user_type'] = 'ngo'; // Set user type as NGO
            header("Location: profile.php?username=" . urlencode($_SESSION['username']) . "&user_type=" . urlencode($_SESSION['user_type']));
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
            $_SESSION['user_type'] = 'company'; // Set user type as company
            header("Location: profile.php?username=" . urlencode($_SESSION['username']) . "&user_type=" . urlencode($_SESSION['user_type']));
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


<!-- Login Form -->
<form class="form" method="post" name="login">
<div class="form-container">
    <h1 class="login-title">Login</h1>
    <input type="text" class="login-input" name="email" placeholder="Email" autofocus="true"/><br/>
    <input type="password" class="login-input" name="password" placeholder="Password"/><br/>
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
<!-- Add Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper('.swiper-container', {
        pagination: {
            el: '.swiper-pagination',
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
    
</script>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>Hands From Heaven | Login Form</title>
    <link href="assets/css/login.css" rel="stylesheet">
    <!-- Add Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <!-- Custom styles for this template -->
    <style>
        /* Position the carousel behind the form */
        #home-carousel {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1; /* Ensure the carousel stays behind the form */
        }

        /* Style adjustments for the form */
        .form {
            position: relative;
            z-index: 1; /* Ensure the form stays above the carousel */
            max-width: 400px; /* Adjust form width as needed */
            margin: 0 auto; /* Center the form horizontally */
            padding: 20px;
            background: #fff; /* Set form background color */
            border-radius: 8px; /* Add border radius to the form */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add shadow to the form */
        }

        /* Ensure the carousel images fill the container */
        .swiper-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>
<body>

<?php
session_start();
require('config.php');

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
            $_SESSION['user_type'] = 'ngo'; // Set user type as NGO
            header("Location: profile.php?username=" . urlencode($_SESSION['username']) . "&user_type=" . urlencode($_SESSION['user_type']));
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
            $_SESSION['user_type'] = 'company'; // Set user type as company
            header("Location: profile.php?username=" . urlencode($_SESSION['username']) . "&user_type=" . urlencode($_SESSION['user_type']));
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


<!-- Login Form -->
<form class="form" method="post" name="login">
<div class="form-container">
    <h1 class="login-title">Login</h1>
    <input type="text" class="login-input" name="email" placeholder="Email" autofocus="true"/><br/>
    <input type="password" class="login-input" name="password" placeholder="Password"/><br/>
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
<!-- Add Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper('.swiper-container', {
        pagination: {
            el: '.swiper-pagination',
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
    
</script>
</body>
</html>
