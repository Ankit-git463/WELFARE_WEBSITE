<?php
require('inc/config.php');

// Fetch all buses for dropdown
$sql_buses = "SELECT * FROM bus_info";
$result_buses = mysqli_query($conn, $sql_buses);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedules</title>
    <?php require('inc/links.php')?>
</head>
<body class="bg-light">

<?php require('inc/header.php')?>

<div class="container mt-3">
    <h2 class="fw-bold text-center">Manage Bus Schedule</h2>
    <div class="h-line bg-dark"></div>
    
    <div class="row">
        <div class="col-lg-10 ms-auto p-3 overflow-hidden">

            <!-- Bus selection dropdown -->
            <div class="row mt-4">
                <div class="col-md-6 mx-auto">
                    <label for="bus_select" class="form-label">Select Bus</label>
                    <select id="bus_select" class="form-select">
                        <option value="">-- Select Bus --</option>
                        <?php
                        if (mysqli_num_rows($result_buses) > 0) {
                            while ($bus = mysqli_fetch_assoc($result_buses)) {
                                echo "<option value='{$bus['bus_id']}'>{$bus['bus_number']}</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>

            <!-- Schedule table for the selected bus -->
            <div class="table-container mt-4">
                <h4 class="fw-bold">Current Bus Schedules</h4>
                <div id="schedule_table">
                    <!-- Schedule table will be loaded here by AJAX -->
                </div>
            </div>

            <!-- Button to open Add Schedule modal -->
            <div class="text-center mt-3">
                <button class="btn btn-primary" id="add_schedule_btn" style="display:none;" data-bs-toggle="modal" data-bs-target="#addScheduleModal">Add Schedule</button>
            </div>

            <!-- Add Schedule Modal -->
            <div class="modal fade" id="addScheduleModal" tabindex="-1" aria-labelledby="addScheduleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addScheduleModalLabel">Add New Bus Schedule</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="add_schedule_form">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="departure_time" class="form-label">Departure Time</label>
                                    <input type="time" name="departure_time" id="add_departure_time" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="source" class="form-label">Source</label>
                                    <input type="text" name="source" id="add_source" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="destination" class="form-label">Destination</label>
                                    <input type="text" name="destination" id="add_destination" class="form-control" required>
                                </div>
                                <input type="hidden" name="bus_id" id="add_bus_id">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save Schedule</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Edit Schedule Modal -->
            <div class="modal fade" id="editScheduleModal" tabindex="-1" aria-labelledby="editScheduleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editScheduleModalLabel">Edit Bus Schedule</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="edit_schedule_form">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="edit_departure_time" class="form-label">Departure Time</label>
                                    <input type="time" name="departure_time" id="edit_departure_time" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_source" class="form-label">Source</label>
                                    <input type="text" name="source" id="edit_source" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_destination" class="form-label">Destination</label>
                                    <input type="text" name="destination" id="edit_destination" class="form-control" required>
                                </div>
                                <input type="hidden" name="schedule_id" id="edit_schedule_id">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update Schedule</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Delete Schedule Modal -->
            <div class="modal fade" id="deleteScheduleModal" tabindex="-1" aria-labelledby="deleteScheduleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteScheduleModalLabel">Delete Bus Schedule</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete this schedule?
                            <input type="hidden" id="delete_schedule_id">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-danger" id="delete_schedule_confirm">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        // Add schedule via AJAX
        $('#add_schedule_form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: 'add_schedule.php',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    $('#addScheduleModal').modal('hide');
                    $('#bus_select').trigger('change');  // Reload the schedule table
                    alert(response);  // Show success message
                },
                error: function(xhr, status, error) {
                    alert('Error: ' + error);  // Show error message
                }
            });
        });

        // Update schedule via AJAX
        $('#edit_schedule_form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: 'edit_schedule.php',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    $('#editScheduleModal').modal('hide');
                    $('#bus_select').trigger('change');  // Reload the schedule table
                    alert(response);  // Show success message
                },
                error: function(xhr, status, error) {
                    alert('Error: ' + error);  // Show error message
                }
            });
        });

        // Delete schedule via AJAX
        $('#delete_schedule_confirm').click(function() {
            var schedule_id = $('#delete_schedule_id').val();
            $.ajax({
                url: 'delete_schedule.php',
                type: 'POST',
                data: { schedule_id: schedule_id },
                success: function(response) {
                    $('#deleteScheduleModal').modal('hide');
                    $('#bus_select').trigger('change');  // Reload the schedule table
                    alert(response);  // Show success message
                },
                error: function(xhr, status, error) {
                    alert('Error: ' + error);  // Show error message
                }
            });
        });

        // Load schedule when a bus is selected
        $('#bus_select').change(function() {
            var bus_id = $(this).val();
            $('#add_bus_id').val(bus_id);  // Set bus ID for add form
            if (bus_id) {
                $.ajax({
                    url: 'ajax/fetch_bus_schedule.php',
                    type: 'GET',
                    data: { bus_id: bus_id },
                    success: function(data) {
                        $('#schedule_table').html(data);  // Load schedule into the table
                        $('#add_schedule_btn').show();  // Show Add Schedule button
                    },
                    error: function(xhr, status, error) {
                        alert('Error: ' + error);
                    }
                });
            } else {
                $('#schedule_table').html('');
                $('#add_schedule_btn').hide();
            }
        });
    });

    // Handle edit schedule button click
    $(document).on('click', '.edit_schedule', function() {
        var schedule_id = $(this).data('id');
        $.ajax({
            url: 'ajax/get_schedule_details.php',
            type: 'GET',
            data: { schedule_id: schedule_id },
            success: function(data) {
                var schedule = JSON.parse(data);
                $('#edit_schedule_id').val(schedule.schedule_id);
                $('#edit_departure_time').val(schedule.departure_time);
                $('#edit_source').val(schedule.source);
                $('#edit_destination').val(schedule.destination);
                $('#editScheduleModal').modal('show');
            }
        });
    });

    // Handle delete schedule button click
    $(document).on('click', '.delete_schedule', function() {
        var schedule_id = $(this).data('id');
        $('#delete_schedule_id').val(schedule_id);
        $('#deleteScheduleModal').modal('show');
    });
</script>

</body>
</html>
