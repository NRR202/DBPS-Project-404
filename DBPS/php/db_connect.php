<?php
// Database configuration
$dbHost = 'localhost'; // MySQL host
$dbUsername = 'root'; // MySQL username
$dbPassword = ''; // MySQL password
$dbName = 'dbps_database'; // MySQL database name

// Create database connection
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
