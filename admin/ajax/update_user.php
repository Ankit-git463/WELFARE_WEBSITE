<?php
require('../inc/config.php'); // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $resident = $_POST['resident'];
    $designation = $_POST['designation'];

    $stmt = $conn->prepare("UPDATE users SET firstname = ?, lastname = ?, email = ?, phone = ?, resident = ?, designation = ? WHERE id = ?");
    $stmt->bind_param("ssssssi", $first_name, $last_name, $email, $phone, $resident, $designation, $id);

    if ($stmt->execute()) {
        // Fetch the updated user details
        $stmt = $conn->prepare("SELECT id, firstname, lastname, email, phone, resident, designation FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        echo json_encode(['success' => true, 'user' => $user]);
    } else {
        echo json_encode(['success' => false]);
    }
    $stmt->close();
}
?>