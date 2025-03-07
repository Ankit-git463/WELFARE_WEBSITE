<?php
// Include database connection file
require('../connection/db_connect.php'); // Adjust the path as necessary
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the student ID from session (assuming the student is logged in)
    $student_id = 1; // Make sure to set this during login
    $request_date = $_POST['request_date'];
    $time_slot_start = $_POST['time_slot_start'];
    // Define the time slot end, assuming each slot is 30 minutes
    $time_slot_end = date("H:i:s", strtotime($time_slot_start) + 1800); 

    // Validate input
    if (empty($request_date) || empty($time_slot_start)) {
        echo "All fields are required.";
        exit;
    }

    // Prepare SQL to insert request into the database
    $sql = "INSERT INTO requests (student_id, request_date, time_slot_start, time_slot_end, status) VALUES (?, ?, ?, ?, 'Pending')";

    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters
        $stmt->bind_param("isss", $student_id, $request_date, $time_slot_start, $time_slot_end);

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            // Success message
            echo "<div class='alert alert-success'>Your request has been submitted successfully!</div>";
        } else {
            // Error message
            echo "<div class='alert alert-danger'>Error: Could not execute the query. Please try again later.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Error: Could not prepare the SQL statement.</div>";
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();

// Redirect back to the request form (optional)
header("Location: bus_request_form.php");
exit;
?>
