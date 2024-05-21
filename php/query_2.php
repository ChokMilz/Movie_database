<?php
// Include the database connection file
include 'db.php';

header('Content-Type: text/html; charset=utf-8'); // Ensure proper content type is set for HTML

try {
    // Establish  database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    // SQL Query to select all movies' titles, genres, and years
    $query = "SELECT title, genre, year FROM Movie";

    // Execute the query
    $result = $conn->query($query);

    // Check if any rows are returned
    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "Title: " . $row["title"] . " - Genre: " . $row["genre"] . " - Year: " . $row["year"] . "<br>";
        }
    } else {
        echo "0 results";
    }
} catch (Exception $e) {
    // Handle exceptions
    echo "Error: " . $e->getMessage();
} finally {
    // Close the database connection
    if (isset($conn)) {
        $conn->close();
    }
}
?>
