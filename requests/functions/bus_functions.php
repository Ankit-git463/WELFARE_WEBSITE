<?php
require('../inc/db_connection.php'); // Include your database connection
require('../inc/links.php'); // Include your database connection

// Function to handle student requests and store them in the database
function handleStudentRequest($student_id, $request_date, $time_slot_start) {
    global $conn;

    // Calculate the end time of the time slot (30 minutes later)
    $time_slot_end = date("H:i:s", strtotime($time_slot_start) + 1800);

    // Prepare SQL to insert request into the database
    $sql = "INSERT INTO requests (student_id, request_date, time_slot_start, time_slot_end, status) VALUES (?, ?, ?, ?, 'Pending')";

    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters
        $stmt->bind_param("isss", $student_id, $request_date, $time_slot_start, $time_slot_end);

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            return true; // Request successfully stored
        } else {
            return false; // Error occurred
        }
    } else {
        return false; // SQL preparation error
    }

    // Close the statement
    $stmt->close();
}

// Function to aggregate requests by time slot
function aggregateRequestsBySlot($request_date) {
    global $conn;

    // Prepare SQL to aggregate requests by time slot
    $sql = "SELECT time_slot_start, COUNT(*) AS request_count FROM requests WHERE request_date = ? GROUP BY time_slot_start";
    
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters
        $stmt->bind_param("s", $request_date);

        // Execute the statement
        $stmt->execute();
        $result = $stmt->get_result();

        $aggregated_data = [];
        while ($row = $result->fetch_assoc()) {
            $aggregated_data[$row['time_slot_start']] = $row['request_count'];
        }

        // Return aggregated data
        return $aggregated_data;
    } else {
        return false; // SQL preparation error
    }

    // Close the statement
    $stmt->close();
}

// Function to check if the number of requests meets the threshold for scheduling a bus
function checkThreshold($request_date, $threshold) {
    global $conn;

    // Prepare SQL to count requests in each time slot
    $sql = "SELECT time_slot_start, COUNT(*) AS request_count FROM requests WHERE request_date = ? GROUP BY time_slot_start HAVING request_count >= ?";
    
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters
        $stmt->bind_param("si", $request_date, $threshold);

        // Execute the statement
        $stmt->execute();
        $result = $stmt->get_result();

        $time_slots_meeting_threshold = [];
        while ($row = $result->fetch_assoc()) {
            $time_slots_meeting_threshold[] = $row['time_slot_start']; // Collect time slots that meet the threshold
        }

        // Return the time slots that meet the threshold
        return $time_slots_meeting_threshold;
    } else {
        return false; // SQL preparation error
    }

    // Close the statement
    $stmt->close();
}
?>
