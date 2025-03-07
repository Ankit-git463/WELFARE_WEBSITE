<?php
require('../inc/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $busId = $_POST['id'];

    $stmt = $conn->prepare("DELETE FROM bus_info WHERE bus_id = ?");
    $stmt->bind_param("i", $busId);
 
    if ($stmt->execute()) {
        echo json_encode(["message" => "Bus deleted successfully !", "status" => "success"]);
    } else {
        echo json_encode(["message" => "Error deleting bus !", "status" => "error"]);
    }
    
    $stmt->close();
    $conn->close();
}
?>
