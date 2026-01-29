<?php
session_start(); // start session for all pages

$host = 'localhost';
$db   = 'pineapple_db'; // Change to your database name
$user = 'root';         // XAMPP default
$pass = '';             // XAMPP default
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die("DB error: " . $e->getMessage());
}
