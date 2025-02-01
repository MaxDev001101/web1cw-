<?php
// Database connection settings
$servername = "localhost";
$username = "root"; // default for XAMPP
$password = ""; // default for XAMPP
$dbname = "login"; // database name
$port ="3307"; // default for XAMPP
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Enable error reporting to help with debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

