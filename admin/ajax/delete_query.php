<?php
require('../inc/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $queryId = $_POST['queryId'];

    // Delete the query from the database
    $stmt = $conn->prepare("DELETE FROM queries WHERE id = ?");
    $stmt->bind_param('i', $queryId);

    if ($stmt->execute()) {
        $response = ['success' => true, 'message' => 'Query deleted successfully!'];
    } else {
        $response = ['success' => false, 'message' => 'Failed to delete query.'];
    }

    echo json_encode($response);
    $stmt->close();
}
?>
