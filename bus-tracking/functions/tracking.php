<?php
include '../inc/config.php';

$bus_id =1 ; # $_POST['bus_id'];
$lat = $_POST['lat'];
$long = $_POST['long'];

// Insert the location into the database
$query = "INSERT INTO bus_tracking (bus_id, latitude, longitude) VALUES (?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("idd", $bus_id, $lat, $long);
$stmt->execute();
$stmt->close();
$conn->close();
?>
