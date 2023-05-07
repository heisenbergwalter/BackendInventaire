<?php
// check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // retrieve the email and password from the POST request
    $email = $_POST['email'];
    $passwordacc = $_POST['password'];

    // connect to the database
    $pdo = new PDO('mysql:host=localhost;dbname=testing', 'root','');

    // prepare the query
    $stmt = $pdo->prepare('SELECT * FROM sign_up WHERE email = :email AND password = :password');

    // bind the parameters
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $passwordacc);

    // execute the query
    $stmt->execute();

    // fetch the result
    $user = $stmt->fetch();

    // check if the user exists
    if ($user) {
        echo json_encode(array('success' => true));
    } else {
        http_response_code(403);
        echo json_encode(array('success' => false, 'error' => 'Invalid email or password'));
        
    }

}