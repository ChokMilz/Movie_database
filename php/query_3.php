<?php
// Include the database connection file
include 'db.php';

 // Ensure proper content type is set for HTML output
header('Content-Type: text/html; charset=utf-8');

try {
    // Establish database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    // SQL Query to drop the existing view if it exists
    $dropViewQuery = "DROP VIEW IF EXISTS MoviesWithActors";

    // Execute query to DROP VIEW
    $conn->query($dropViewQuery);

    // SQL Query to create a view - CREATE VIEW MoviesWithActors
    $createViewQuery = "CREATE VIEW MoviesWithActors AS 
                        SELECT m.title AS MovieTitle, m.year AS ReleaseYear, m.genre AS Genre, 
                               a.surname AS ActorSurname, a.name AS ActorName, a.DOB AS ActorDOB
                        FROM Movie m
                        JOIN Role r ON m.movieId = r.movieId
                        JOIN Artist a ON r.actorId = a.artistId";

    // Execute query to CREATE VIEW
    $conn->query($createViewQuery);

    echo "View 'MoviesWithActors' created successfully.<br>";

    // SQL Query to select data from the view
    $selectViewQuery = "SELECT * FROM MoviesWithActors";

    // Execute query to select data from the view
    $result = $conn->query($selectViewQuery);

    if ($result->num_rows > 0) {
        // Output data of each row
        echo "<h2>Results from 'MoviesWithActors' View:</h2>";
        while ($row = $result->fetch_assoc()) {
            echo "Movie Title: " . $row["MovieTitle"] . " - Genre: " . $row["Genre"] . " - Release Year: " . $row["ReleaseYear"] . "<br>";
        }
    } else {
        echo "0 results";
    }

} catch (Exception $e) {
    // Handle exceptions
    echo "Error: " . $e->getMessage();
} finally {
    // Close database connection
    if (isset($conn)) {
        $conn->close();
    }
}
?>
