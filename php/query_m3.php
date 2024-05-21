<?php
// Include the Composer autoloader
require '../vendor/autoload.php';

try {
    // Connect to MongoDB
    $client = new MongoDB\Client("mongodb://localhost:27017");

    // Select the database and collection
    $database = $client->selectDatabase("movies_database");
    $collection = $database->selectCollection("movie");

    // Execute Aggregation Query (Example: Count movies by producer)
    $pipeline = [
        [
            '$group' => [
                '_id' => '$producer.producerId',
                'totalMovies' => ['$sum' => 1],
                'producerName' => ['$first' => ['$concat' => ['$producer.name', ' ', '$producer.surname']]]
            ]
        ],
        [
            '$sort' => ['totalMovies' => -1] // Sort by total movies in descending order
        ]
    ];
    $result = $collection->aggregate($pipeline);

    // Check if we got any documents
    $documents = iterator_to_array($result);

    if (empty($documents)) {
        echo "<h2>Connection to MongoDB was successful but no producers were found.</h2>";
    } else {
        // Format results as HTML (Example: List documents)
        $html = "<h2>Connection to MongoDB was successful!</h2>";
        $html .= "<ul>";
        foreach ($documents as $document) {
            $html .= "<li>Producer ID: " . $document['_id'] . " - Name: " . $document['producerName'] . " - Total Movies: " . $document['totalMovies'] . "</li>";
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
