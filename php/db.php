<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = ""; // No password
$dbname = "movies_database"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Select the database
$conn->select_db($dbname);

// Optionally, you can check if the database selection was successful
if ($conn->error) {
    die("Database selection failed: " . $conn->error);
}

// script reaches this point => database is successfully selected
?>
