<?php
include '../inc/config.php';

$query = "SELECT bus_id, latitude, longitude FROM curr_locations";
$result = $conn->query($query);

$buses = [];
while ($row = $result->fetch_assoc()) {
    $buses[] = $row;
}

echo json_encode($buses);

?>
