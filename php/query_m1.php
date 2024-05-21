<?php
// Include the Composer autoloader
require '../vendor/autoload.php';

try {
    // Connect to MongoDB
    $client = new MongoDB\Client("mongodb://localhost:27017");

    // Select the database and collection
    $database = $client->selectDatabase("movies_database");
    $collection = $database->selectCollection("movie");

    // Execute Query 1 (Example: Find all documents)
    $result = $collection->find();

    // Check if we got any documents
    $documents = iterator_to_array($result);

    if (empty($documents)) {
        echo "<h2>Connection to MongoDB was successful but no documents were found.</h2>";
    } else {
        // Format results as HTML (Example: List documents)
        $html = "<h2>Connection to MongoDB was successful!</h2>";
        $html .= "<ul>";
        foreach ($documents as $document) {
            $html .= "<li>" . json_encode($document) . "</li>";
        }
        $html .= "</ul>";

        // Return HTML response
        echo $html;
    }
} catch (MongoDB\Driver\Exception\Exception $e) {
    // Handle connection errors
    $errorMessage = "Failed to connect to MongoDB: " . $e->getMessage();
    echo "<h2>$errorMessage</h2>";
}
?>
