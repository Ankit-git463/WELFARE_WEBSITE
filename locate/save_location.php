<?php
include '../inc/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $lat = $_POST['latitude'];
    $lng = $_POST['longitude'];

    $stmt = $conn->prepare("INSERT INTO curr_locations (latitude, longitude, updated_at) VALUES (?, ?, NOW())");
    $stmt->bind_param("dd", $lat, $lng);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Database update failed']);
    }

    $stmt->close();
    $conn->close();
}
?>
