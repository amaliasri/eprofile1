<?php
// Database configuration
$host = 'localhost';      // Database host
$username = 'root';       // Database username
$password = '';           // Database password
$database = 'student_db'; // Database name

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
?>