<?php
// Start the session
session_start();

// Database connection
include '../inc/config.php';
include '../inc/functions.php'; // Include the functions file

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get email and password from the form
    $email = $_POST['email'];
    $password = $_POST['pass'];

    // Prepare and execute SQL statement to fetch user data
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Check if the user exists
    if ($stmt->num_rows > 0) {
        // Bind the result
        $stmt->bind_result($userId, $hashedPassword);
        $stmt->fetch();

        // Verify password
        if (password_verify($password, $hashedPassword)) {
            // Password is correct; set session variables
            $_SESSION['user_id'] = $userId;
            $_SESSION['email'] = $email;
            $_SESSION['logged_in'] = true; // Custom flag to check if the user is logged in

            echo "success";
        } else {
            echo "invalid_pass";
        }
    } else {
        echo "invalid_credential";
    }

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
} else {
    echo "error";
}
?>
