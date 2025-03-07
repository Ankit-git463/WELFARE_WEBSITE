<?php
// Include the database connection file
require_once('../inc/config.php');

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate incoming data
    $name = isset($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : '';
    $email = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : '';
    $phone = isset($_POST['phone']) ? htmlspecialchars(trim($_POST['phone'])) : '';
    $license_number = isset($_POST['license_number']) ? htmlspecialchars(trim($_POST['license_number'])) : '';

    // Validate the input (basic validation, can be extended)
    if (empty($name) || empty($email) || empty($phone) || empty($license_number)) {
        echo json_encode(['message' => 'All fields are required.']);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['message' => 'Invalid email format.']);
        exit;
    }

    // Assuming you have a session started and the driver's ID is stored in session
    session_start();

    // change this for  session
    if (isset($_SESSION['driver_id'])) {
        echo json_encode(['message' => 'Driver not logged in.']);
        exit;
    }

    // $driver_id = $_SESSION['driver_id'];
    $driver_id = 1;

    // Prepare the SQL statement to update the profile
    $sql = "UPDATE drivers SET name = ?, email = ?, phone = ?, license_number = ? WHERE id = ?";

    // Initialize the prepared statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind the parameters
        $stmt->bind_param("ssssi", $name, $email, $phone, $license_number, $driver_id);

        // Execute the query
        if ($stmt->execute()) {
            // Return success message
            echo json_encode(['message' => 'Profile updated successfully!']);
        } else {
            // Return error message if update fails
            echo json_encode(['message' => 'Error updating profile. Please try again.']);
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        echo json_encode(['message' => 'Error preparing the statement.']);
    }

    // Close the database connection
    $conn->close();
} else {
    echo json_encode(['message' => 'Invalid request method.']);
}
?>
