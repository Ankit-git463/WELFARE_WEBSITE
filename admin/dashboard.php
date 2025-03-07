<?php 
    require('inc/essentials.php');
    adminLogin();
    require('inc/config.php'); // Include your database connection file

    // Queries Table: Resolved and Unresolved Count
    $resolvedQuery = "SELECT COUNT(*) as count FROM queries WHERE status = 'Resolved'";
    $resolvedResult = $conn->query($resolvedQuery);
    $resolvedCount = $resolvedResult->fetch_assoc()['count'];

    $unresolvedQuery = "SELECT COUNT(*) as count FROM queries WHERE status = 'Unresolved'";
    $unresolvedResult = $conn->query($unresolvedQuery);
    $unresolvedCount = $unresolvedResult->fetch_assoc()['count'];

    // Drivers and Buses Count
    $driversQuery = "SELECT COUNT(*) as count FROM drivers";
    $driversResult = $conn->query($driversQuery);
    $driversCount = $driversResult->fetch_assoc()['count'];

    $busesQuery = "SELECT COUNT(*) as count FROM bus_info";
    $busesResult = $conn->query($busesQuery);
    $busesCount = $busesResult->fetch_assoc()['count'];


    // Fetch total user count
    $totalUsersQuery = "SELECT COUNT(*) as count FROM users";
    $totalUsersResult = $conn->query($totalUsersQuery);
    $totalUsersCount = $totalUsersResult->fetch_assoc()['count'];

    // Fetch count of users by resident
    $residentQuery = "SELECT resident, COUNT(*) as count FROM users GROUP BY resident";
    $residentResult = $conn->query($residentQuery);
    $residents = [];
    $residentCounts = [];
    while ($row = $residentResult->fetch_assoc()) {
        $residents[] = $row['resident'];
        $residentCounts[] = $row['count'];
    }

    // Fetch count of users by designation
    $designationQuery = "SELECT designation, COUNT(*) as count FROM users GROUP BY designation";
    $designationResult = $conn->query($designationQuery);
    $designations = [];
    $designationCounts = [];
    while ($row = $designationResult->fetch_assoc()) {
        $designations[] = $row['designation'];
        $designationCounts[] = $row['count'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>User Dashboard</title>
   <?php require('inc/links.php'); ?> 
   <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Include Chart.js -->
   <style>
        .chart-container {
            width: 45%;   /* Limit the width of the charts */
            height: 300px; /* Fixed height for the charts */
            margin: 20px;  /* Add margin around the charts */
            padding: 10px;  /* Padding inside the chart containers */
            box-sizing: border-box;
        }

        .row {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .col {
            flex: 1;
            min-width: 300px;
            padding: 20px;
            box-sizing: border-box;
        }

        canvas {
            width: 100% !important;   /* Ensure canvas fills the container's width */
            height: 100% !important;  /* Ensure canvas fills the container's height */
            object-fit: contain; /* Prevent stretching */
        }
    </style>


</head>
<body class="bg-white">
    <?php require('inc/header.php'); ?> 
    
    <div class="container-fluid" id="main-content">
        <br>
        <div class="row">
            

            <div class="col-lg-10 ms-auto p-4 overflow-hidden mb-3">
                <h2 class="text-center mb-4">Statistics</h2>
                <br>
                
                <div class="row">
                    <div class="col-lg-3 ms-auto mx-1 mb-3">
                        <h4>Total User Count</h4>
                        <p><?php echo $totalUsersCount; ?> users</p>
                    </div>
                    <div class="col-lg-3 ms-auto mx-1 mb-3">
                        <h4>Total Buses Running</h4>
                        <p><?php echo $busesCount; ?> buses</p>
                    </div>
                    <div class="col-lg-3 ms-auto mx-1 mb-3">
                        <h4>Total Drivers</h4>
                        <p><?php echo $driversCount; ?> drivers</p>
                    </div>
                </div>

                <div class="row p-3 my-4">
                    <!-- Resident Count Chart -->
                    <div class="col chart-container">
                        <h4 class="text-center">Resident Count</h4>
                        <canvas id="residentChart"></canvas>
                    </div>

                    <!-- Designation Count Chart -->
                    <div class="col chart-container">
                        <h4 class="text-center" >Designation Count</h4>
                        <canvas id="designationChart"></canvas>
                    </div>

                </div>

                
                <div class="row p-3">
                    <!-- Resolved vs Unresolved Queries Chart -->
                    <div class="col chart-container">
                        <h4 class="text-center">Resolved vs Unresolved Queries</h4>
                        <canvas id="queriesChart"></canvas>
                    </div>

                    <!-- Drivers and Buses Count Chart -->
                    <div class="col chart-container">
                        <h4 class="text-center">Drivers and Buses Count</h4>
                        <canvas id="driversBusesChart"></canvas>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php require('inc/scripts.php'); ?> 

    <script>
        // Resident Chart
        const residentCtx = document.getElementById('residentChart').getContext('2d');
        const residentChart = new Chart(residentCtx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($residents); ?>,
                datasets: [{
                    label: 'Count',
                    data: <?php echo json_encode($residentCounts); ?>,
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(54, 162, 235, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(54, 162, 235, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + ' users';
                            }
                        }
                    }
                }
            }
        });

        // Designation Chart
        const designationCtx = document.getElementById('designationChart').getContext('2d');
        const designationChart = new Chart(designationCtx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($designations); ?>,
                datasets: [{
                    label: 'Count',
                    data: <?php echo json_encode($designationCounts); ?>,
                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Data for Queries
    const resolvedCount = <?php echo $resolvedCount; ?>;
    const unresolvedCount = <?php echo $unresolvedCount; ?>;

    // Data for Drivers and Buses
    const driversCount = <?php echo $driversCount; ?>;
    const busesCount = <?php echo $busesCount; ?>;

    // Queries Chart
    const queriesCtx = document.getElementById('queriesChart').getContext('2d');
    new Chart(queriesCtx, {
        type: 'pie', // Pie chart for resolved vs unresolved
        data: {
            labels: ['Resolved', 'Unresolved'],
            datasets: [{
                label: 'Queries Status',
                data: [resolvedCount, unresolvedCount],
                backgroundColor: ['rgba(75, 192, 192, 0.5)', 'rgba(255, 99, 132, 0.5)'],
                borderColor: ['rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top'
                }
            }
        }
    });

    // Drivers and Buses Chart
    const driversBusesCtx = document.getElementById('driversBusesChart').getContext('2d');
        new Chart(driversBusesCtx, {
            type: 'bar', // Bar chart for drivers and buses count
            data: {
                labels: ['Drivers', 'Buses'],
                datasets: [{
                    label: 'Count',
                    data: [driversCount, busesCount],
                    backgroundColor: ['rgba(153, 102, 255, 0.5)', 'rgba(255, 159, 64, 0.5)'],
                    borderColor: ['rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
