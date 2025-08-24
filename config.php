<?php
// config.php
$host = 'localhost';
$db   = 'clock_app';
$user = 'root';
$pass = ''; // default XAMPP MySQL password is empty. If you set one, put it here.

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}

session_start();
