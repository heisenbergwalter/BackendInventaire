<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Retrieve the email, password, full name, and phone from the POST request body
    $data = file_get_contents('php://input');
    $params = json_decode($data);

    $email = $params->email;
    $password = $params->password;
    $full_name = $params->full_name;
    $phone = $params->phone;

    // Connect to the database
    $servername = "localhost";
    $username = "root";
    $passwordsql = "";
    $dbname = "testing";

    $conn = mysqli_connect($servername, $username, $passwordsql, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare and execute the SQL query to insert the new user into the database
    $stmt = $conn->prepare("INSERT INTO sign_up (email, password, full_name, phone) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $email, $password, $full_name, $phone);
    $user_created = $stmt->execute();

    // Close the database connection
    mysqli_close($conn);

    if ($user_created) {
        // Return a success response
        $response = array('success' => true);
        echo json_encode($response);
    } else {
        // Return an error response
        $response = array('success' => false, 'message' => 'Unable to create user account');
        echo json_encode($response);
    }

} else {
    // Return an error response for unsupported request method
    $response = array('success' => false, 'message' => 'Invalid request method');
    echo json_encode($response);
}
