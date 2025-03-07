<?php
include '../inc/config.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);

    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $response = ['success' => true];
    } else {
        $response = ['success' => false, 'message' => 'Failed to delete user.'];
    }

    $stmt->close();
    echo json_encode($response);
}
?>
