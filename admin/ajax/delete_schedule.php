<?php
require('../inc/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $schedule_id = $_POST['schedule_id'];

    // Delete query
    $sql_delete = "DELETE FROM bus_schedule WHERE schedule_id = '$schedule_id'";

    if (mysqli_query($conn, $sql_delete)) {
        echo "Schedule deleted successfully!";
    } else {
        echo "Error deleting schedule: " . mysqli_error($conn);
    }
}
?>
