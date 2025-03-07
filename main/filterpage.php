<?php
// Assuming you have a connection to the database
require('inc/config.php');

// Initialize empty filter variables
$date = '';
$source = '';
$destination = '';
$bus_types = [];

// Get today's and tomorrow's dates
$today = date('Y-m-d');
$tomorrow = date('Y-m-d', strtotime('tomorrow'));

// Fetch filtered values if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Get selected date, with special handling for "Today" and "Tomorrow"
    if (isset($_POST['date_option'])) {
        if ($_POST['date_option'] == 'today') {
            $date = $today;
        } elseif ($_POST['date_option'] == 'tomorrow') {
            $date = $tomorrow;
        } else {
            $date = $_POST['date'] ?? '';
        }
    }
    
    $time = $_POST['time'] ?? '';
    $source = $_POST['source'] ?? '';
    $destination = $_POST['destination'] ?? '';
    $bus_types = $_POST['bus_type'] ?? [];
    
    // Build SQL query based on filters
    $sql = "SELECT * FROM buses WHERE 1=1";
    
    if (!empty($date)) {
        $sql .= " AND departure_date = '$date'";
    }

    if (!empty($source)) {
        $sql .= " AND source LIKE '%$source%'";
    }
    if (!empty($destination)) {
        $sql .= " AND destination LIKE '%$destination%'";
    }
    if (!empty($bus_types)) {
        $types_in = implode("','", $bus_types); // Safely implode the array
        $sql .= " AND bus_type IN ('$types_in')";
    }
    
    $result = mysqli_query($conn, $sql);
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BUS-SERVICE</title>
    <?php require('inc/links.php')?> 

    <style>
        .fw-600 {
            font-weight: 600;
        }
    </style>

</head>

<body class="bg-light">

    <?php require('inc/header.php')?> 

    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">SCHEDULE</h2>
        <div class="h-line bg-dark"></div>
    </div>

    

    <div class="container">
        <div class="row">
            <!-- Filters Section -->
            <div class="col-lg-3 mb-4">
                <form method="POST"  class="navbar navbar-expand-lg navbar-light bg-white rounded shadow">
                    <div class="container-fluid flex-lg-column align-items-stretch">
                        <h4 class="mt-4">FILTERS</h4>

                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse flex-column mt-3 px-2" id="navbarNav">
                            <div class="border bg-light p-3 rounded mb-3">
                                
                                <h5 class="mb-3" style="font-size: 18px;">Bus Type</h5>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="bus_type[]" value="Institute Bus" id="instituteBus" <?php echo in_array('Institute Bus', $bus_types) ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="instituteBus">Institute Bus</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="bus_type[]" value="IITP Bus" id="iitpBus" <?php echo in_array('IITP Bus', $bus_types) ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="iitpBus">IITP Bus</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="bus_type[]" value="Girls Bus" id="girlsBus" <?php echo in_array('Girls Bus', $bus_types) ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="girlsBus">Girls Bus</label>
                                </div>

                                <h5 class="mb-3 mt-3" style="font-size: 18px;">CHECK AVAILABILITY</h5>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="date_option" id="todayOption" value="today" onclick="setToday()">
                                    <label class="form-check-label" for="todayOption">Today</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="date_option" id="tomorrowOption" value="tomorrow" onclick="setTomorrow()">
                                    <label class="form-check-label" for="tomorrowOption">Tomorrow</label>
                                </div>

                                <label class="form-label mt-3">Date</label>
                                <input type="date" id="datePicker" name="date" value="<?php echo $date; ?>" class="form-control shadow-none mb-3">

                                <label class="form-label">Source</label>
                                <input type="text" name="source" value="<?php echo $source; ?>" class="form-control shadow-none mb-3">

                                <label class="form-label">Destination</label>
                                <input type="text" name="destination" value="<?php echo $destination; ?>" class="form-control shadow-none mb-3">
                            </div>

                            <button type="submit" class="btn btn-primary mt-3 mb-5">Apply Filters</button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Bus List Section -->
            <div class="col-lg-9">
                
                <div class="row">
                    <?php
                    if (isset($result) && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <div class="col-md-12 mb-4">
                                <div class="card p-3 shadow border-0">
                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <h5 class="text-primary"><?php echo $row['bus_type']; ?> - <?php echo $row['route']; ?></h5>
                                        </div>
                                        <div class="col-md-6">
                                            <p><strong>Date:</strong> <?php echo date('F d, Y', strtotime($row['departure_date'])); ?></p>
                                            <p><strong>Time:</strong> <?php echo date('h:i A', strtotime($row['departure_time'])); ?></p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><strong>Source:</strong> <?php echo $row['source']; ?></p>
                                            <p><strong>Destination:</strong> <?php echo $row['destination']; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    } 
                    
                    else {
                        echo "
                        <div class='col-md-12'>
                            <p class='text-center text-danger' style='font-size: 1.3rem;' >No buses available based on the selected filters.</p>
                            <div class='alert alert-info mt-4'>
                                <h6 class='fw-bold'>How to use the filter:</h6>
                                <hr style='border-top: 1px solid rgba(0, 0, 0, 0.1); margin: 20px 0;'>
                                <ul class='mb-0'>
                                    <li>Select the <strong>Date</strong> on which you want to check bus availability.</li>
                                    <li>Pick a <strong>Time</strong> that fits your schedule. Buses departing after the selected time will be shown.</li>
                                    <li>Enter the <strong>Source</strong> and <strong>Destination</strong> locations to narrow down the search.</li>
                                    <li>Choose the type of bus (e.g., <strong>Institute Bus</strong>, <strong>IITP Bus</strong>, or <strong>Girls Bus</strong>) to match your preference.</li>
                                    <li>Click on <strong>Apply Filters</strong> to see the list of buses matching your criteria.</li>
                                </ul>
                            </div>
                        </div>";


                        echo " <div class='col-md-12'>
                                    <div class='alert alert-info mt-4 shadow-sm'>
                                        <div class=' text-center'>
                                            <h2 class='fw-600'>Bus Service Guidelines</h2>
                                        </div>
                                        <hr style='border-top: 1px solid rgba(0, 0, 0, 0.1); margin: 20px 0;'>
                                        <div class=''>
                                            <ul class='mb-0'>
                                                <li >Please arrive at the bus stop at least five minutes before departure. SWB will not be responsible if you arrive at the last minute and miss your bus.</li>
                                                <li >When boarding the bus outside campus, keep your ID card handy or you will not be allowed on board.</li>
                                                <li >Please send an email to <a href='mailto:swb@iitp.ac.in'>swb@iitp.ac.in</a> if you have any questions or concerns regarding bus services.</li>
                                                <li >Immediately inform us if the bus staff intentionally allowed outsiders on board, and provide us with a photo of the same.</li>
                                                <li >You may be banned from using bus services for up to 6 months if you make the bus wait at a stoppage for any reason.</li>
                                                <li >Boarding buses elsewhere than at bus stops on campus is prohibited. We will take strict action against defaulters.</li>
                                                <li >Please avoid standing on the doors as it may lead to an accident.</li>
                                            </ul>
                                        </div>
                                        <hr style='border-top: 1px solid rgba(0, 0, 0, 0.1); margin: 20px 0;'>
                                    </div>

                                    
                                </div>";
                    }
                    ?>
                </div>
            </div>

        </div>
    </div>

   

    <?php require('inc/footer.php')?> 

    <script>
        // Function to set today's date in the date picker
        function setToday() {
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('datePicker').value = today;
        }

        // Function to set tomorrow's date in the date picker
        function setTomorrow() {
            const tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1);
            document.getElementById('datePicker').value = tomorrow.toISOString().split('T')[0];
        }
    </script>

</body>
</html>
