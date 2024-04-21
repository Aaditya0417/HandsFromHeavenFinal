<?php
// Database configuration
$host = "localhost";
$port = "5432";
$dbname = "NGO_Fund_Management";
$user = "postgres";
$password = "aaditya";

// Attempt to establish a database connection
$con = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

// Check if the connection was successful
if (!$con) {
    // If connection failed, handle the error
    die("Connection failed: " . pg_last_error());
}
?>
