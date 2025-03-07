<?php
require('../inc/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("INSERT INTO notifications (title, description) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $description);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Notification added successfully!", "status" => "success"]);
    } else {
        echo json_encode(["message" => "Failed to add notification.", "status" => "error"]);
    }

    $stmt->close();
    $conn->close();
}
?>
