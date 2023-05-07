<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "testing";

// Get the item from the POST request
if(isset($_POST['item'])){
    $item = $_POST["item"];
    echo "Received item: " . $item;
}

// Create a connection to the database
$conn = new mysqli($host, $user, $pass, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Construct the SQL query to insert the item into the database
$sql = "INSERT INTO items (item) VALUES ('$item')";

// Execute the query
if ($conn->query($sql) === TRUE) {
    // If the query was successful, output a success message
    echo "Item saved successfully";
    echo "Received item: " . $item;
} else {
    // If the query was unsuccessful, output an error message
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
