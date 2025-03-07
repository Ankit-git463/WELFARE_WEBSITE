<?php
// Assuming you have a connection to the database
require('inc/config.php');

// Fetch all buses from the bus_info table
$sql_buses = "SELECT * FROM bus_info";
$result_buses = mysqli_query($conn, $sql_buses);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SWB IITP Bus Schedule</title>
    <?php require('inc/links.php')?>

    <!-- Custom CSS for the layout -->
    <style>
        

        .bus-select {
            max-width: 400px; /* Limiting the width of the dropdown */
            margin: 0 auto; /* Centering the dropdown */
        }

        .schedule-container {
            background-color: #f8f9fa; /* Light background for contrast */
            padding: 20px; /* Increased padding */
            border: 1px solid #dee2e6; /* Subtle border */
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Shadow for depth */
        }

        .fw-bold {
            font-weight: 700; /* Bold text */
        }

        .schedule-container {
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .bus-timings {
            display: flex;
            justify-content: space-between;
        }

        .timing-column {
            width: 48%;
            display: flex;
            flex-direction: column; /* Stack elements vertically */
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .bus-timings {
                flex-direction: column;
            }

            .timing-column {
                width: 100%;
                margin-bottom: 20px;
            }
        }

        @media (max-width: 768px) {
            .bus-select {
                width: 100%; /* Full width on smaller screens */
            }
        }

        
    </style>
</head>
<body class="bg-light">

    <?php require('inc/header.php')?>


    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">SCHEDULE</h2>
        <div class="h-line bg-dark"></div>
    </div>

    <div class="container mt-5">
        <div class="text-center mb-4">
            <h2 class="fw-bold">Select Your Bus</h2>
            <p class="text-muted">Choose a bus to view its schedule</p>
        </div>

        <div class="bus-select mb-4">
            <label for="bus" class="form-label">Choose a Bus:</label>
            <select id="bus" class="form-select" onchange="loadBusSchedule()">
                <?php
                // Populate the select dropdown with buses

                print_r($result_buses);
                if (mysqli_num_rows($result_buses) > 0) {
                    while ($bus = mysqli_fetch_assoc($result_buses)) {
                        echo "<option value='{$bus['bus_id']}'>{$bus['bus_number']}</option>";
                    }
                }
                ?>
            </select>
        </div>

        <div id="schedule-container" class="schedule-container p-4 border rounded shadow-sm">
            <!-- Bus schedule will be loaded here dynamically -->
            <div class="text-center">
                <h3 class="fw-bold">Daily Bus Schedule</h3>
                <p class="text-muted">Select a bus to see its schedule</p>
            </div>
        </div>
    </div>



    <script>
        // Function to fetch and load the schedule for the selected bus
        function loadBusSchedule() {
            const busId = document.getElementById('bus').value;

            // Send an AJAX request to fetch the bus schedule
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'fetch_bus_schedule.php?bus_id=' + busId, true);
            // console.log(busId);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    console.log(xhr.responseText);
                    document.getElementById('schedule-container').innerHTML = xhr.responseText;
                    console.log("REQ made");
                }
            };
            xhr.send();
        }

        // Load the schedule for the first bus on page load
        window.onload = function() {
            loadBusSchedule();
        };
    </script>

    <?php require('inc/footer.php')?>

</body>
</html>
