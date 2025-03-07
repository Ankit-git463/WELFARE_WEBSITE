<?php
require('../inc/config.php');  // Include database connection

if (isset($_GET['bus_id'])) {
   
    $bus_id = $_GET['bus_id'];

    // Query to fetch bus schedules based on bus_id
    $sql = "SELECT * FROM daily_schedule WHERE bus_id = ? ORDER BY departure_time ASC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $bus_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo '<table class="table table-bordered">';
        echo '<thead>';
        echo '<tr><th>Departure Time</th><th>Source</th><th>Destination</th><th>Actions</th></tr>';
        echo '</thead>';
        echo '<tbody>';

        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . date('h:i A', strtotime($row['departure_time'])) . '</td>';
            echo '<td>' . $row['node'] . '</td>';
            echo '<td>' . $row['destination'] . '</td>';
            echo '<td>';
            echo '<button class="btn btn-warning btn-sm edit-btn" ';
            echo 'data-schedule_id="' . $row['schedule_id'] . '" ';
            echo 'data-time="' . $row['departure_time'] . '" ';
            echo 'data-source="' . $row['node'] . '" ';
            echo 'data-destination="' . $row['destination'] . '">Edit</button> ';
            echo '<button class="btn btn-danger btn-sm delete-btn" ';
            echo 'data-schedule_id="' . $row['schedule_id'] . '">Delete</button>';
            echo '</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
    } else {
        echo '<p class="text-center">No schedules found for the selected bus.</p>';
    }

    $stmt->close();
} else {
    echo 'Bus ID not provided.';
}

$conn->close();
?>
