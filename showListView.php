<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "testing";
$conn = new mysqli($host, $user, $pass, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Construct the SQL query to fetch the items from the database
$sql = "SELECT * FROM items";

// Execute the query and get the result
$result = $conn->query($sql);

// Check if any items were found
if ($result->num_rows > 0) {
    // Output each item as a separate line
    while($row = $result->fetch_assoc()) {
        echo $row["item"] . "\n";
    }
}

// Close the database connection
$conn->close();
?>
