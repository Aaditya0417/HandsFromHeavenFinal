<?php

$db_host = 'localhost';
$db_username = 'postgres';
$db_password = 'Aaditya@1399';
$db_name = 'NGO_Fund_Management';

$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$username = $_POST['username'];
$password = $_POST['password'];


$query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 1) {

    session_start();
    $_SESSION['username'] = $username;

    $user = mysqli_fetch_assoc($result);
    if ($user['role'] == 'admin') {
      
        header("Location: admin_panel.php");
    } else {
      
        header("Location: user_dashboard.php");
    }
} else {
   
    echo "Invalid username or password";
}

mysqli_close($conn);
?>
