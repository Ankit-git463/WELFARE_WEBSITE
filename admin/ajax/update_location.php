<?php
session_start();
require_once('../inc/config.php');

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

// if (isset($_SESSION['driverId']) && isset($data['lat']) && isset($data['lng'])) {
if (isset($data['lat']) && isset($data['lng'])) {
    //$driverId = $_SESSION['driverId'];
    $driverId = 1 ; 
    $latitude = $data['lat'];
    $longitude = $data['lng'];

    // Fetch the bus assigned to the driver
    $busQuery = "SELECT bus_id FROM bus_info WHERE driver_id = ?";
    $stmt = $conn->prepare($busQuery);
    $stmt->bind_param('i', $driverId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $bus = $result->fetch_assoc();
        $busId = $bus['bus_id'];

        // Update the location of the assigned bus
        $updateQuery = "UPDATE curr_locations SET latitude = ?, longitude = ? WHERE bus_id = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param('ddi', $latitude, $longitude, $busId);

        if ($stmt->execute()) {
            echo json_encode(['message' => 'Location updated successfully']);
        } else {
            echo json_encode(['message' => 'Failed to update location']);
        }
    } else {
        echo json_encode(['message' => 'No bus assigned to this driver']);
    }
} else {
    echo json_encode(['message' => 'Invalid session or missing location data']);
}
?>
