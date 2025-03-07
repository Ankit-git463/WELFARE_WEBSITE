<?php
require('../inc/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $busNumber = $_POST['bus_number'];
    $driverName = $_POST['driver_name'];
    $contact = $_POST['contact'];

    $stmt = $conn->prepare("INSERT INTO bus_info (bus_number, driver_name, contact) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $busNumber, $driverName, $contact);
    
    if ($stmt->execute()) {
        echo json_encode(["message" => "Bus added successfully !", "status" => "success"]);
    } else {
        echo json_encode(["message" => "Error adding bus !", "status" => "error"]);
    }
    
    $stmt->close();
    $conn->close();
}
?>
