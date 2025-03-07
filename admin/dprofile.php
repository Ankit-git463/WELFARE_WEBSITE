<?php
    // Include the database connection file
    require('inc/config.php'); 
    require('inc/essentials.php'); 
    session_start();

    // Check if driver is logged in
    if (isset($_SESSION['driver_id'])) {
        header('Location: login.php'); // Redirect to login page if not logged in
        exit();
    }

    // Fetch driver details from the database
    // $driver_id = $_SESSION['driver_id'];
    $driver_id = 1 ;
    $sql = "SELECT name, email, phone, license_number FROM drivers WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $driver_id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($name, $email, $phone, $license_number);
    $stmt->fetch();
    $stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver Profile Page</title>
    
    <?php require('inc/links.php'); ?>
    <link rel="stylesheet" href="https://js.api.here.com/v3/3.1/mapsjs-ui.css" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>


    <style>
        #customAlert {
            display: none;
            position: fixed;
            top: 10%;
            right: 2%;
            background-color: #007bff; /* Blue background */
            color: white;
            padding: 20px;
            border-radius: 5px;
            z-index: 1000;
            font-weight: bold;
        }
    </style>
</head>
<body class="bg-light">

    <?php require('inc/dheader.php'); ?> 

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-3 overflow-hidden">
                <h2 class="text-center mt-4 mb-4">Driver Profile</h2>

                <!-- Profile Display and Update Form -->
                <div class="card mx-auto" style="max-width: 1000px;">
                    <div class="card-body">
                        <form id="driverProfileForm">
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>">
                            </div>
                            <div class="form-group mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
                            </div>
                            <div class="form-group mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
                            </div>
                            <div class="form-group mb-3">
                                <label for="license_number" class="form-label">License Number</label>
                                <input type="text" class="form-control" id="license_number" name="license_number" value="<?php echo htmlspecialchars($license_number); ?>">
                            </div>
                            <button type="button" class="btn btn-primary shadow-none w-100" onclick="updateDriverProfile()">Update Profile</button>
                        </form>
                    </div>
                </div>

                <!-- Alert Box for Update Status -->
                <div id="customAlert">Profile updated successfully!</div>
            </div>
        </div>
    </div>

    <?php require('inc/scripts.php'); ?> 

    <script>
        function updateDriverProfile() {
            // Get form data
            const formData = {
                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                phone: document.getElementById('phone').value,
                license_number: document.getElementById('license_number').value
            };

            // Send AJAX request to update profile
            $.ajax({
                url: 'ajax/update_dprofile.php', // PHP script to handle update
                method: 'POST',
                data: formData,
                success: function(response) {
                    $('#customAlert').text(response.message).fadeIn();
                    setTimeout(() => $('#customAlert').fadeOut(), 3000); // Hide alert after 3 seconds
                },
                error: function() {
                    $('#customAlert').text('Failed to update profile. Please try again.').fadeIn();
                    setTimeout(() => $('#customAlert').fadeOut(), 3000); // Hide alert after 3 seconds
                }
            });
        }
    </script>
</body>
</html>
