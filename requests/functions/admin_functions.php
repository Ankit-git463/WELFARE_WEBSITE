<?php
require('../inc/db_connection.php'); // Include your database connection
require('../inc/links.php'); // Include your database connection

// Function to retrieve pending bus requests
function getPendingRequests() {
    global $conn;

    $sql = "SELECT r.request_id, r.student_id, r.request_date, r.time_slot_start, r.time_slot_end, r.status, s.name 
            FROM requests r 
            JOIN students s ON r.student_id = s.student_id 
            WHERE r.status = 'Pending'";

    $result = $conn->query($sql);
    $pending_requests = [];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $pending_requests[] = $row;
        }
    }

    return $pending_requests; // Return array of pending requests
}

// Function to approve a bus scheduling request
function adminApproveRequest($request_id) {
    global $conn;

    $sql = "UPDATE requests SET status = 'Approved' WHERE request_id = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters
        $stmt->bind_param("i", $request_id);

        // Execute the statement
        if ($stmt->execute()) {
            return true; // Successfully approved
        } else {
            return false; // Error occurred
        }
    } else {
        return false; // SQL preparation error
    }

    // Close the statement
    $stmt->close();
}

// Function to reject a bus scheduling request
function adminRejectRequest($request_id) {
    global $conn;

    $sql = "UPDATE requests SET status = 'Rejected' WHERE request_id = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters
        $stmt->bind_param("i", $request_id);

        // Execute the statement
        if ($stmt->execute()) {
            return true; // Successfully rejected
        } else {
            return false; // Error occurred
        }
    } else {
        return false; // SQL preparation error
    }

    // Close the statement
    $stmt->close();
}

// Function to schedule a bus after approval
function scheduleBus($request_id, $bus_id, $driver_info) {
    global $conn;

    // First, get the request details to extract the time slot
    $sql = "SELECT time_slot_start, request_date FROM requests WHERE request_id = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters
        $stmt->bind_param("i", $request_id);

        // Execute the statement
        $stmt->execute();
        $stmt->bind_result($time_slot_start, $request_date);
        $stmt->fetch();

        // Now, insert into the bus schedule
        $sql_schedule = "INSERT INTO bus_schedule (bus_id, time_slot_start, date, driver_info) VALUES (?, ?, ?, ?)";
        
        if ($schedule_stmt = $conn->prepare($sql_schedule)) {
            // Bind parameters
            $schedule_stmt->bind_param("isss", $bus_id, $time_slot_start, $request_date, $driver_info);

            // Execute the statement
            if ($schedule_stmt->execute()) {
                return true; // Bus scheduled successfully
            } else {
                return false; // Error during scheduling
            }
        }

        // Close the scheduling statement
        $schedule_stmt->close();
    } else {
        return false; // SQL preparation error
    }

    // Close the statement
    $stmt->close();
}

// Function to retrieve all scheduled buses
function getScheduledBuses() {
    global $conn;

    $sql = "SELECT bs.bus_id, bs.time_slot_start, bs.date, bs.driver_info, r.student_id, s.name 
            FROM bus_schedule bs 
            JOIN requests r ON bs.time_slot_start = r.time_slot_start AND bs.date = r.request_date 
            JOIN students s ON r.student_id = s.student_id";

    $result = $conn->query($sql);
    $scheduled_buses = [];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $scheduled_buses[] = $row;
        }
    }

    return $scheduled_buses; // Return array of scheduled buses
}
?>
