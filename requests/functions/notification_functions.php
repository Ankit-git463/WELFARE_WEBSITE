<?php
require('../inc/db_connection.php'); // Include your database connection
require '../vendor/autoload.php'; // Include the Composer autoloader for email sending (if using PHPMailer)

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Function to send notification to students about their confirmed bus schedule
function notifyStudents($student_id, $time_slot_start, $request_date) {
    global $conn;

    // Get the student's email from the database
    $sql = "SELECT email FROM students WHERE student_id = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters
        $stmt->bind_param("i", $student_id);

        // Execute the statement
        $stmt->execute();
        $stmt->bind_result($email);
        $stmt->fetch();

        // Send email
        if (!empty($email)) {
            $mail = new PHPMailer(true);
            try {
                //Server settings
                $mail->isSMTP(); // Send using SMTP
                $mail->Host = 'smtp.example.com'; // Set the SMTP server to send through
                $mail->SMTPAuth = true; // Enable SMTP authentication
                $mail->Username = 'your-email@example.com'; // SMTP username
                $mail->Password = 'your-email-password'; // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
                $mail->Port = 587; // TCP port to connect to

                // Recipients
                $mail->setFrom('no-reply@example.com', 'Bus Scheduling System');
                $mail->addAddress($email); // Add a recipient

                // Content
                $mail->isHTML(true); // Set email format to HTML
                $mail->Subject = 'Bus Schedule Confirmation';
                $mail->Body = "Dear Student,<br>Your bus has been scheduled successfully for <strong>$time_slot_start</strong> on <strong>$request_date</strong>.<br>Thank you!";

                // Send the email
                $mail->send();
                return true; // Email sent successfully
            } catch (Exception $e) {
                return false; // Email could not be sent
            }
        }
    }
    return false; // Student email not found
}

// Function to notify admin when a request crosses the threshold
function notifyAdminForApproval($time_slot_start, $request_date) {
    global $conn;

    // Get the admin email from the database (assuming there's a table for admins)
    $sql = "SELECT email FROM admins WHERE role = 'SuperAdmin' LIMIT 1"; // Modify as needed
    
    if ($stmt = $conn->prepare($sql)) {
        // Execute the statement
        $stmt->execute();
        $stmt->bind_result($admin_email);
        $stmt->fetch();

        // Send email
        if (!empty($admin_email)) {
            $mail = new PHPMailer(true);
            try {
                //Server settings
                $mail->isSMTP(); // Send using SMTP
                $mail->Host = 'smtp.example.com'; // Set the SMTP server to send through
                $mail->SMTPAuth = true; // Enable SMTP authentication
                $mail->Username = 'your-email@example.com'; // SMTP username
                $mail->Password = 'your-email-password'; // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
                $mail->Port = 587; // TCP port to connect to

                // Recipients
                $mail->setFrom('no-reply@example.com', 'Bus Scheduling System');
                $mail->addAddress($admin_email); // Add admin email

                // Content
                $mail->isHTML(true); // Set email format to HTML
                $mail->Subject = 'Bus Scheduling Request Needs Approval';
                $mail->Body = "Dear Admin,<br>A bus scheduling request for the time slot <strong>$time_slot_start</strong> on <strong>$request_date</strong> has crossed the threshold and requires your approval.";

                // Send the email
                $mail->send();
                return true; // Email sent successfully
            } catch (Exception $e) {
                return false; // Email could not be sent
            }
        }
    }
    return false; // Admin email not found
}
?>
