<?php
header("Content-Type: application/json");

// Get the QR data from the POST request
$input = json_decode(file_get_contents("php://input"), true);
$qrData = $input['qr_data'] ?? '';

if ($qrData) {
    // Connect to the database
    $conn = new mysqli("localhost", "username", "password", "database");

    if ($conn->connect_error) {
        die(json_encode(["message" => "Database connection failed"]));
    }

    // Look up the QR data in the database
    $stmt = $conn->prepare("SELECT * FROM users WHERE qr_code = ?");
    $stmt->bind_param("s", $qrData);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // If data matches, return verification success
        echo json_encode(["message" => "Verification Successful"]);
    } else {
        echo json_encode(["message" => "Verification Failed"]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["message" => "Invalid QR data"]);
}
?>
