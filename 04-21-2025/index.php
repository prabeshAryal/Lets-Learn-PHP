<?php
// index.php

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Autoload classes
spl_autoload_register(function ($class_name) {
    include 'classes/' . $class_name . '.php';
});

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "demo_database";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully to the database.<br>";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Entry point
echo "Welcome to the PHP application!";
?>