<?php
require('../inc/config.php');

$busesQuery = "SELECT * FROM bus_info";
$busesResult = $conn->query($busesQuery);

$buses = [];
while ($row = $busesResult->fetch_assoc()) {
    $buses[] = $row;
}

echo json_encode($buses);

$conn->close();
?>
