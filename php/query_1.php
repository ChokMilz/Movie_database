<?php
// Include the database connection file
include 'db.php';

header('Content-Type: text/html; charset=utf-8'); // to ensure proper content type is set for HTML

// Set the year threshold to 2000
$year = 2000;

// Try to establish a database connection
try {
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    // SQL Query using Prepared Statement to avoid SQL Injection
    $stmt = $conn->prepare("SELECT title, genre FROM Movie WHERE year > ?");
    if ($stmt === false) {
        throw new Exception("Failed to prepare statement: " . $conn->error);
    }

    $stmt->bind_param("i", $year); // 'i' specifies the variable type is integer
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "Title: " . $row["title"] . " - Genre: " . $row["genre"] . "<br>";
        }
    } else {
        echo "0 results";
    }
    $stmt->close();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
} finally {
    if (isset($conn)) { // Check if $conn is set before calling close
        $conn->close();
    }
}
?>
