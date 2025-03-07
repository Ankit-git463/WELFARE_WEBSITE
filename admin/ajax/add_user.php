<?php
    
    include '../config.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = $_POST['first_name'];
    $lastname = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $resident = $_POST['resident'];
    $designation = $_POST['designation'];

    $sql = "INSERT INTO users (firstname, lastname, email, phone, resident, designation) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $firstname, $lastname, $email, $phone, $resident, $designation);

    if ($stmt->execute()) {
        $response = [
            'success' => true,
            'data' => [
                'id' => $conn->insert_id,
                'firstname' => $firstname,
                'lastname' => $lastname,
                'email' => $email,
                'phone' => $phone,
                'resident' => $resident,
                'designation' => $designation
            ]
        ];
    } else {
        $response = ['success' => false, 'message' => 'Failed to add user.'];
    }

    $stmt->close();
    echo json_encode($response);
}
?>
