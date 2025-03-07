<?php
require('../inc/config.php');

$result = $conn->query("SELECT id, title, description FROM notifications ORDER BY created_at DESC");

$notifications = [];
while ($row = $result->fetch_assoc()) {
    $notifications[] = $row;
}

echo json_encode($notifications);

$conn->close();
?>
