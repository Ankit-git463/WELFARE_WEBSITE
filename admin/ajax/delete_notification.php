<?php
require('../inc/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    $stmt = $conn->prepare("DELETE FROM notifications WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Notification deleted successfully!", "status" => "success"]);
    } else {
        echo json_encode(["message" => "Failed to delete notification.", "status" => "error"]);
    }

    $stmt->close();
    $conn->close();
}
?>
