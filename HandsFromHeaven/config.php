<?php
$host = 'localhost';
$user = 'postgres';
$password = 'Aaditya@1399';
$dbname = 'NGO_Fund_Management';

try {
    $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
