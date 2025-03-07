<?php
require('../inc/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("UPDATE notifications SET title = ?, description = ? WHERE id = ?");
    $stmt->bind_param("ssi", $title, $description, $id);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Notification updated successfully!", "status" => "success"]);
    } else {
        echo json_encode(["message" => "Failed to update notification.", "status" => "error"]);
    }

    $stmt->close();
    $conn->close();
}
?>
