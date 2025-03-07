<?php
    session_start();

    // Check if user is logged in by verifying session data
    $response = [
        'logged_in' => isset($_SESSION['user_id']), // Change 'user_id' to the actual session key you use for logged-in users
    ];

    // Set content type to JSON and output the response
    header('Content-Type: application/json');
    echo json_encode($response);


?>