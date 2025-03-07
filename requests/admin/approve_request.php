<?php
require('../functions/admin_functions.php'); // Include the admin functions
require('../inc/db_connection.php'); // Include your database connection

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $request_id = $_POST['request_id'];
    $action = $_POST['action'];

    if ($action == 'approve') {
        // Approve the request
        if (!adminApproveRequest($request_id)) {
            echo   '<div class="alert alert-success alert-dismissible" id="custom-alert" role="alert">
                        <strong>Request Approved !! </strong>
                    </div>';
        } else {
            echo   '<div class="alert alert-danger alert-dismissible" id="custom-alert" role="alert">
                        <strong>Some Error Occured !! </strong>
                    </div>';
        }
    } elseif ($action == 'reject') {
        // Reject the request
        if (adminRejectRequest($request_id)) {
            echo   '<div class="alert alert-success alert-dismissible" id="custom-alert" role="alert">
                        <strong>Request Rejected !! </strong>
                    </div>';
        } else {
            echo   '<div class="alert alert-danger alert-dismissible" id="custom-alert" role="alert">
                        <strong>Some Error occured !! </strong>
                    </div>';
        }
    }
}

// Retrieve pending requests
$pending_requests = getPendingRequests();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approve Bus Requests</title>
    <?php require('../inc/links.php') ?>

    <style>
       #custom-alert {
        position: fixed;
        top: 80px;
        right: 20px;
        width: 250px;  /* Adjust this to your desired width */
        padding: 15px 20px; /* Add more padding for better spacing */
        z-index: 1050;  /* Ensure it's above other elements */
        border-radius: 8px;  /* Rounded corners for a modern look */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);  /* Subtle shadow for depth */
        font-size: 16px;  /* Adjust font size for readability */
        border: 1px solid ;  /* Slight border to define the alert */
        animation: slide-in 0.5s ease-in-out;  /* Smooth slide-in effect */
    }

    /* Animation for slide-in effect */
    @keyframes slide-in {
        from {
            right: -300px;
        }
        to {
            right: 20px;
        }
    }

    /* Fade-out effect for smooth disappearance */
    .fade {
        opacity: 0;
        transition: opacity 0.15s linear;
    }

    </style>
</head>
<body class="bg-light">

    <?php require('../inc/header.php') ?>
    <div class="col-lg-6 container shadow my-4 py-3">
        <div class=" my-5 px-4 center">
            <h2 class="fw-bold h-font text-center">Approve Bus Requests</h2>
            <div class="h-line bg-dark"></div>

            <form method="POST" class="my-4">
                <div class="form-group">
                    <label for="request_id">Select Request</label>
                    <select name="request_id" id="request_id" class="form-control" required>
                        <option value="">Select a request</option>
                        <?php foreach ($pending_requests as $request): ?>
                            <option value="<?= $request['request_id'] ?>">
                                <?= $request['name'] ?> - <?= $request['request_date'] ?> - <?= $request['time_slot_start'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group mt-3">
                    <label for="action">Action</label>
                    <select name="action" id="action" class="form-control" required>
                        <option value="approve">Approve</option>
                        <option value="reject">Reject</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </form>
        </div>
    </div>
        

    <?php require('../inc/footer.php') ?>

    <script>
        setTimeout(function() {
            let cusalert = document.getElementById('custom-alert');
            if (cusalert) {
                cusalert.classList.remove('show');
                cusalert.classList.add('fade'); // Add fade class to smoothly remove it
                setTimeout(() => cusalert.remove(), 150); // Remove from DOM after fade out
            }
        }, 2000);


    </script>
</body>
</html>
