<?php
    require('inc/config.php');

    function get_daily_schedule($bus_id, $conn){

        // Fetch the schedule for the selected bus, ordered by departure time
        $sql_schedule = "SELECT * FROM daily_schedule WHERE bus_id = $bus_id ORDER BY departure_time ASC";
        $result_schedule = mysqli_query($conn, $sql_schedule);

        if (mysqli_num_rows($result_schedule) > 0) {
            // Get all schedules into an array
            $schedules = [];
            while ($schedule = mysqli_fetch_assoc($result_schedule)) {
                $schedules[] = $schedule;
            }

            // Calculate mid-point to split the schedule into two columns
            $total_count = count($schedules);
            $mid_point = ceil($total_count / 2);

            // Split into two columns
            $left_column = array_slice($schedules, 0, $mid_point);
            $right_column = array_slice($schedules, $mid_point);

            // Display the bus schedule
            echo "<h3 class='text-center fw-bold '>Weekday Schedule</h3>";
            echo "<div class='bus-timings mt-3'>";

            // Left column
            echo "<div class='timing-column'>";
            echo "<table>";
            echo "<thead><tr><th>Departure Time</th><th>From</th><th>To</th></tr></thead>";
            echo "<tbody>";
            foreach ($left_column as $row) {
                echo "<tr><td>" . date('h:i A', strtotime($row['departure_time'])) . "</td><td>{$row['node']}</td><td>{$row['destination']}</td></tr>";
            }
            echo "</tbody>";
            echo "</table>";
            echo "</div>";

            // Right column
            echo "<div class='timing-column'>";
            echo "<table>";
            echo "<thead><tr><th>Departure Time</th><th>From</th><th>To</th></tr></thead>";
            echo "<tbody>";
            foreach ($right_column as $row) {
                echo "<tr><td>" . date('h:i A', strtotime($row['departure_time'])) . "</td><td>{$row['node']}</td><td>{$row['destination']}</td></tr>";
            }
            echo "</tbody>";
            echo "</table>";
            echo "</div>";

            echo "</div>"; // End of bus-timings div
        } else {
            echo "<br> <br> <p class='no-schedule'>No weekday schedule available for this bus.</p>";
        }
        
    }

    function get_weekend_schedule($bus_id, $conn){

        // Fetch the schedule for the selected bus, ordered by departure time
        $sql_schedule = "SELECT * FROM weekend_schedule WHERE bus_id = $bus_id ORDER BY departure_time ASC";
        $result_schedule = mysqli_query($conn, $sql_schedule);

        if (mysqli_num_rows($result_schedule) > 0) {
            // Get all schedules into an array
            $schedules = [];
            while ($schedule = mysqli_fetch_assoc($result_schedule)) {
                $schedules[] = $schedule;
            }

            // Calculate mid-point to split the schedule into two columns
            $total_count = count($schedules);
            $mid_point = ceil($total_count / 2);

            // Split into two columns
            $left_column = array_slice($schedules, 0, $mid_point);
            $right_column = array_slice($schedules, $mid_point);

            // Display the bus schedule
            echo "<br>";
            echo "<h3 class='text-center fw-bold'>Weekend Bus Schedule</h3><hr>";
            echo "<div class='bus-timings mt-5'>";

            // Left column
            echo "<div class='timing-column'>";
            echo "<table>";
            echo "<thead><tr><th>Departure Time</th><th>From</th><th>To</th></tr></thead>";
            echo "<tbody>";
            foreach ($left_column as $row) {
                echo "<tr><td>" . date('h:i A', strtotime($row['departure_time'])) . "</td><td>{$row['source']}</td><td>{$row['destination']}</td></tr>";
            }
            echo "</tbody>";
            echo "</table>";
            echo "</div>";

            // Right column
            echo "<div class='timing-column'>";
            echo "<table>";
            echo "<thead><tr><th>Departure Time</th><th>From</th><th>To</th></tr></thead>";
            echo "<tbody>";
            foreach ($right_column as $row) {
                echo "<tr><td>" . date('h:i A', strtotime($row['departure_time'])) . "</td><td>{$row['source']}</td><td>{$row['destination']}</td></tr>";
            }
            echo "</tbody>";
            echo "</table>";
            echo "</div>";

            echo "</div>"; // End of bus-timings div
        } else {
            echo "<br> <br> <p class='no-schedule'>No weekend schedule available for this bus.</p>";
        }
        
    }

    if (isset($_GET['bus_id'])) {
        $bus_id = $_GET['bus_id'];

        get_daily_schedule($bus_id , $conn);   

        get_weekend_schedule($bus_id , $conn);
    }

    else{
        echo "<p class='text-center text-danger' style='font-size: 1.5rem; '>OOPS !!! Error Something went wrong......</p>";
    }
?>
