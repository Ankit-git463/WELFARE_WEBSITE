<?php
require('../inc/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $queryId = $_POST['queryId'];
    $reply = $_POST['reply'];

    // Update query status to 'resolved' and save the reply
    $stmt = $conn->prepare("UPDATE queries SET status = 'resolved', reply = ? WHERE id = ?");
    $stmt->bind_param('si', $reply, $queryId);

    if ($stmt->execute()) {
        $response = ['success' => true, 'message' => 'Query resolved successfully!'];
    } else {
        $response = ['success' => false, 'message' => 'Failed to resolve query.'];
    }

    echo json_encode($response);
    $stmt->close();
}
?>
