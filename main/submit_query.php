<?php
require('inc/config.php');  // Database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Fetch form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = isset($_POST['phone']) ? $_POST['phone'] : null;
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $category = $_POST['category'];

    // Insert the data into the queries table
    $stmt = $conn->prepare("INSERT INTO queries (name, email, phone, subject, message, category) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $name, $email, $phone, $subject, $message, $category);

    if ($stmt->execute()) {
        // Redirect to a thank you page or show a success message
        echo "<script> window.location.href='contact.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
