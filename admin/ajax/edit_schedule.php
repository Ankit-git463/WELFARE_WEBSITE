<?php
require('../inc/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $schedule_id = $_POST['schedule_id'];
    $departure_time = $_POST['departure_time'];
    $source = $_POST['source'];
    $destination = $_POST['destination'];

    // Update query
    $sql_edit = "UPDATE bus_schedule SET 
                departure_time = '$departure_time', 
                source = '$source', 
                destination = '$destination' 
                WHERE schedule_id = '$schedule_id'";

    if (mysqli_query($conn, $sql_edit)) {
        echo "Schedule updated successfully!";
    } else {
        echo "Error updating schedule: " . mysqli_error($conn);
    }
}
?>
