<?php
session_start();
require('inc/config.php'); // Include database connection

// Redirect to login if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Fetch user data
$user_id =$_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();


// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];
    $postcode = $_POST['postcode'];
    $state = $_POST['state'];
    $country = $_POST['country'];

    // Update user data
    $update_query = "UPDATE users SET firstname = ?, lastname = ?, email = ?, phone = ?, 
                     address_line1 = ?, address_line2 = ?, postcode = ?, state = ?, country = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("sssssssssi", $firstname, $lastname, $email, $phone, $address1, $address2, $postcode, $state, $country, $user_id);
    
    if ($update_stmt->execute()) {
        $_SESSION['message'] = "Profile updated successfully!";
        header('Location: profile.php');
        exit;
    } else {
        $_SESSION['error'] = "Failed to update profile. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <?php require('inc/links.php'); ?>
    <style>
        /* Add your CSS styles here */
    </style>
</head>



<body class='bg-white'>
    <?php require('inc/header.php'); ?>

    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <img class="rounded-circle mt-5" width="150px" 
                        src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                    <span class="font-weight-bold"><?php echo htmlspecialchars($user['firstname'] . ' ' . $user['lastname']); ?></span>
                    <span class="text-black-50"><?php echo htmlspecialchars($user['email']); ?></span>
                </div>
            </div>

            <div class="col-md-7 border-right">
                <div class="p-3 py-5">
                    <h4 class="text-right">Profile Settings</h4>
                    <?php
                    if (isset($_SESSION['message'])) {
                        echo "<div class='alert alert-success'>" . $_SESSION['message'] . "</div>";
                        unset($_SESSION['message']);
                    }
                    if (isset($_SESSION['error'])) {
                        echo "<div class='alert alert-danger'>" . $_SESSION['error'] . "</div>";
                        unset($_SESSION['error']);
                    }
                    ?>
                    <form method="POST" action="">
                        <div class="row mt-2">
                            <div class="col-md-6 my-2">
                                <label>Name</label>
                                <input type="text" class="form-control shadow-none" name="firstname" value="<?php echo htmlspecialchars($user['firstname']); ?>">
                            </div>
                            <div class="col-md-6 my-2">
                                <label>Surname</label>
                                <input type="text" class="form-control shadow-none" name="lastname" value="<?php echo htmlspecialchars($user['lastname']); ?>">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12 my-2">
                                <label>Mobile Number</label>
                                <input type="text" class="form-control shadow-none" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>">
                            </div>

                            <div class="col-md-12 my-2">
                                <label>Email</label>
                                <input type="text" class="form-control shadow-none" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" readonly>
                            </div>

                            <div class="col-md-12 my-2">
                                <label>Address Line 1</label>
                                <input type="text" class="form-control shadow-none" name="address1" value="<?php echo htmlspecialchars($user['address_line1']); ?>">
                            </div>
                            <div class="col-md-12 my-2">
                                <label>Address Line 2</label>
                                <input type="text" class="form-control shadow-none" name="address2" value="<?php echo htmlspecialchars($user['address_line2']); ?>">
                            </div>
                            <div class="col-md-12 my-2">
                                <label>Postcode</label>
                                <input type="text" class="form-control shadow-none" name="postcode" value="<?php echo htmlspecialchars($user['postcode']); ?>">
                            </div>
                            <div class="col-md-12 my-2">
                                <label>State</label>
                                <input type="text" class="form-control shadow-none" name="state" value="<?php echo htmlspecialchars($user['state']); ?>">
                            </div>
                            <div class="col-md-12 my-2">
                                <label>Country</label>
                                <input type="text" class="form-control shadow-none" name="country" value="<?php echo htmlspecialchars($user['country']); ?>">
                            </div>
                        </div>

                        <div class="mt-5 text-center">
                            <button class="btn btn-primary profile-button" type="submit">Save Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php require('inc/footer.php'); ?>
</body>
</html>
