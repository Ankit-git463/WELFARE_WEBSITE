<?php
require('../inc/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $busId = $_POST['id'];
    $busNumber = $_POST['bus_number'];
    $driverName = $_POST['driver_name'];
    $contact = $_POST['contact'];

    $stmt = $conn->prepare("UPDATE bus_info SET bus_number = ?, driver_name = ?, contact = ? WHERE bus_id = ?");
    $stmt->bind_param("sssi", $busNumber, $driverName, $contact, $busId);
    
    if ($stmt->execute()) {
        echo json_encode(["message" => "Bus updated successfully!", "status" => "success"]);
    } else {
        echo json_encode(["message" => "Error updating bus!", "status" => "error"]);
    }
    
    $stmt->close();
    $conn->close();
}
?>