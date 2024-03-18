<?php
$host = 'localhost'; // Database server address
$dbName = 'educational_center'; // Database name
$user = 'root'; // Database user's username
$password = 'root'; // Database user's password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $user, $password);
    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Failed to connect to the database: " . $e->getMessage());
}
?>
