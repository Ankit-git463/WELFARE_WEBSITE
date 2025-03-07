<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Database connection
    include '../inc/config.php';  // Database connection file

    // Collect form data
    $firstname   = $_POST['firstname'];
    $lastname    = $_POST['lastname'];
    $email       = $_POST['email'];
    $phone       = $_POST['phone'];
    $resident    = $_POST['resident'];
    $designation = $_POST['designation'];
    $dob         = $_POST['dob'];
    $pass        = password_hash($_POST['pass'], PASSWORD_BCRYPT); // Hash the password
    $cpass       = password_hash($_POST['cpass'], PASSWORD_BCRYPT);

    // Token for email verification
    $token = bin2hex(random_bytes(16)); // Generate a random token
    $token_expire = date('Y-m-d H:i:s', strtotime('+1 day')); // Token expires in 24 hours

    // Handle file upload (ID card)
    $idcard = null; // Initialize to null if no file uploaded
    if (isset($_FILES['idcard']) && $_FILES['idcard']['error'] == 0) {
        $target_dir = "../uploads/";
        $unique_file_name = uniqid() . '-' . basename($_FILES['idcard']['name']);
        $target_file = $target_dir . $unique_file_name;
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Only allow certain file formats (jpg, png, webp)
        if (in_array($file_type, ['jpg', 'png', 'webp'])) {
            if (move_uploaded_file($_FILES['idcard']['tmp_name'], $target_file)) {
                $idcard = $unique_file_name; // Store unique filename in the database
            } else {
                echo "Error uploading ID card.";
                exit;
            }
        } else {
            echo "Invalid file type for ID card. Only JPG, PNG, and WEBP are allowed.";
            exit;
        }
    }

    // Check if passwords match
    if ($_POST['pass'] !== $_POST['cpass']) {
        echo "pass_mismatch";
        exit;
    }

    // Check if email or phone already exists
    $sql = "SELECT * FROM users WHERE email = ? OR phone = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $email, $phone);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo "email_or_phone_exists";
        exit;
    }

    // Insert data into the users table
    $created_at = date('Y-m-d H:i:s'); // Current timestamp
    $sql = "INSERT INTO users (firstname, lastname, email, phone, resident, designation, idcard, dob, password, is_verified, token, token_expire, status, created_at) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $is_verified = 0; // Initially not verified
    $status = 1;      // Active status
    
    $stmt->bind_param('ssssssssssssss', $firstname, $lastname, $email, $phone, $resident, $designation, $idcard, $dob, $pass, $is_verified, $token, $token_expire, $status, $created_at);

    if ($stmt->execute()) {
        echo "success";
        // Consider sending a verification email here using the token
    } else {
        echo "insert_failed";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
