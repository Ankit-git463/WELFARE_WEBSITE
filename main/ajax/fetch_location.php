<?php
include '../inc/config.php';

if (isset($_POST['bus_id'])) {
    $busId = $_POST['bus_id'];
    
    $stmt = $conn->prepare("SELECT latitude, longitude FROM curr_locations WHERE bus_id = ? ");
    $stmt->bind_param("i", $busId);
    $stmt->execute();
    $stmt->bind_result($lat, $lng);
    $stmt->fetch();
    
    echo json_encode(['bus_id' => $busId , 'lat' => $lat, 'lng' => $lng]);

    $stmt->close();
}
?>
