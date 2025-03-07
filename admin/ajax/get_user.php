<?php
include '../inc/config.php'; // Include your database connection file

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $response = ['success' => true, 'data' => $result->fetch_assoc()];
        } else {
            $response = ['success' => false, 'message' => 'User not found.'];
        }
    } else {
        $response = ['success' => false, 'message' => 'Failed to fetch user details.'];
    }

    $stmt->close();
    echo json_encode($response);
}
?>
