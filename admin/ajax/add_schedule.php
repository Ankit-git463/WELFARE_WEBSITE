<?php
require('../inc/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bus_id = $_POST['bus_id'];
    $departure_time = $_POST['departure_time'];
    $source = $_POST['source'];
    $destination = $_POST['destination'];

    // Insert query
    $sql_add = "INSERT INTO bus_schedule (bus_id, departure_time, source, destination) 
                VALUES ('$bus_id', '$departure_time', '$source', '$destination')";

    if (mysqli_query($conn, $sql_add)) {
        echo "Schedule added successfully!";
    } else {
        echo "Error adding schedule: " . mysqli_error($conn);
    }
}
?>
