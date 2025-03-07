<?php
include '../db/db.php';

// Delete tracking data older than 7 days
$query = "DELETE FROM bus_tracking WHERE timestamp < NOW() - INTERVAL 7 DAY";
$conn->query($query);
$conn->close();
?>
