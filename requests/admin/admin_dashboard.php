<?php
require('../functions/admin_functions.php'); // Include the admin functions
require('../inc/db_connection.php'); // Include your database connection

// Retrieve scheduled buses and pending requests
$scheduled_buses = getScheduledBuses();
$pending_requests = getPendingRequests();



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <?php require('../inc/links.php') ?>
</head>
<body class="bg-light">

    <?php require('../inc/header.php') ?>


    <div class="container col-lg-10 shadow">
        <div class="my-5 px-4 pt-5">
            <h2 class="fw-bold h-font text-center">Admin Dashboard</h2>
            <div class="h-line bg-dark"></div>

            <div class="my-4">
                <h4>Pending Bus Requests</h4>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Request ID</th>
                            <th>Student Name</th>
                            <th>Request Date</th>
                            <th>Time Slot Start</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($pending_requests)): ?>
                            <tr>
                                <td colspan="5" class="text-center">No pending requests</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($pending_requests as $request): ?>
                                <tr>
                                    <td><?= $request['request_id'] ?></td>
                                    <td><?= $request['name'] ?></td>
                                    <td><?= $request['request_date'] ?></td>
                                    <td><?= $request['time_slot_start'] ?></td>
                                    <td><?= $request['status'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            
            <br>

            <div class="my-4">
                <h4>Scheduled Buses</h4>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Bus ID</th>
                            <th>Time Slot Start</th>
                            <th>Date</th>
                            <th>Driver Info</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($scheduled_buses)): ?>
                            <tr>
                                <td colspan="4" class="text-center">No scheduled buses</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($scheduled_buses as $bus): ?>
                                <tr>
                                    <td><?= $bus['bus_id'] ?></td>
                                    <td><?= $bus['time_slot_start'] ?></td>
                                    <td><?= $bus['date'] ?></td>
                                    <td><?= $bus['driver_info'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <br>
        <br>

    </div>
    

    <?php require('../inc/footer.php') ?>

    <script>
        setTimeout(function() {
            $('.custom-alert').alert('close');
        }, 3000);

    </script>
</body>
</html>
