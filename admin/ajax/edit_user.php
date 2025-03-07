<?php
include '../inc/config.php';// Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['user_id']);
    $firstname = $_POST['edit_first_name'];
    $lastname = $_POST['edit_last_name'];
    $email = $_POST['edit_email'];
    $phone = $_POST['edit_phone'];
    $resident = $_POST['edit_resident'];
    $designation = $_POST['edit_designation'];

    $sql = "UPDATE users SET firstname = ?, lastname = ?, email = ?, phone = ?, resident = ?, designation = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $firstname, $lastname, $email, $phone, $resident, $designation, $id);

    if ($stmt->execute()) {
        $response = [
            'success' => true,
            'data' => [
                'id' => $id,
                'firstname' => $firstname,
                'lastname' => $lastname,
                'email' => $email,
                'phone' => $phone,
                'resident' => $resident,
                'designation' => $designation
            ]
        ];
    } else {
        $response = ['success' => false, 'message' => 'Failed to update user.'];
    }

    $stmt->close();
    echo json_encode($response);
}
?>
