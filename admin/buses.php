<?php 
    require('inc/essentials.php');
    adminLogin();
    require('inc/config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Bus Management</title>
   <?php require('inc/links.php'); ?> 
   <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
   <style>
       /* Custom CSS for the top-right alert notification */
        #notification-alert {
            position: fixed;
            top: 20px;
            right: 20px;
            display: none;
            z-index: 9999;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border-radius: 5px;
        }
   </style>
</head>
<body class="bg-white">
    <?php require('inc/header.php'); ?> 

    <!-- Custom Alert Box for notifications -->
    <div id="notification-alert"></div>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-3 overflow-hidden">
                <h2>Available Buses</h2>
                <button class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#addBusModal">Add Bus</button>
                
                <!-- Notification Alert -->
                <div id="notification-alert" style="display: none; padding: 10px; color: #fff; margin-bottom: 10px;"></div>
                
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Bus ID</th>
                            <th>Bus Number</th>
                            <th>Driver Name</th>
                            <th>Contact</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="buses-table">
                        <!-- Rows will be loaded here by AJAX -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php require('inc/scripts.php'); ?> 

    <!-- Add Bus Modal -->
    <div class="modal fade" id="addBusModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="add-bus-form">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Bus</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="bus_number" class="form-control mb-2" placeholder="Bus Number" required>
                        <input type="text" name="driver_name" class="form-control mb-2" placeholder="Driver Name" required>
                        <input type="text" name="contact" class="form-control mb-2" placeholder="Contact" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add Bus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Bus Modal -->
    <div class="modal fade" id="editBusModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="edit-bus-form">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Bus</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="edit-bus-id">
                        <input type="text" name="bus_number" id="edit-bus-number" class="form-control mb-2" required>
                        <input type="text" name="driver_name" id="edit-driver-name" class="form-control mb-2" required>
                        <input type="text" name="contact" id="edit-contact" class="form-control mb-2" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            function showNotification(message, type = 'success') {
                let alertBox = $('#notification-alert');
                alertBox.text(message); // Set message
                alertBox.css('background-color', type === 'success' ? '#28a745' : '#dc3545'); // Set color based on type
                alertBox.fadeIn();

                setTimeout(function() {
                    alertBox.fadeOut();
                }, 3000); // Auto-hide after 3 seconds
            }

            function loadBuses() {
                $.ajax({
                    url: 'ajax/get_bus.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function(buses) {
                        let tableContent = '';
                        buses.forEach(bus => {
                            tableContent += `
                                <tr data-id="${bus.bus_id}">
                                    <td>${bus.bus_id}</td>
                                    <td>${bus.bus_number}</td>
                                    <td>${bus.driver_name}</td>
                                    <td>${bus.contact}</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning" onclick="openEditModal(${bus.bus_id}, '${bus.bus_number}', '${bus.driver_name}', '${bus.contact}')">Edit</button>
                                        <button class="btn btn-sm btn-danger" onclick="deleteBus(${bus.bus_id})">Delete</button>
                                    </td>
                                </tr>
                            `;
                        });
                        $('#buses-table').html(tableContent);
                    }
                });
            }

            loadBuses();

            $('#add-bus-form').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'ajax/add_bus.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        showNotification(response.message, response.status); // Show notification based on status
                        $('#addBusModal').modal('hide');
                        loadBuses();
                    }
                });
            });

            $('#edit-bus-form').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'ajax/edit_bus.php',
                    type: 'POST',
                    data: $(this).serialize(), // Send form data
                    dataType: 'json',
                    success: function(response) {
                        showNotification(response.message, response.status); // Show notification based on status
                        $('#editBusModal').modal('hide');
                        loadBuses();
                    }
                });
            });


            window.openEditModal = function(id, busNumber, driverName, contact) {
                $('#edit-bus-id').val(id);
                $('#edit-bus-number').val(busNumber);
                $('#edit-driver-name').val(driverName);
                $('#edit-contact').val(contact);
                $('#editBusModal').modal('show');
            }

            window.deleteBus = function(id) {
                if (confirm("Are you sure you want to delete this bus?")) {
                    $.ajax({
                        url: 'ajax/delete_bus.php',
                        type: 'POST',
                        data: { id: id },
                        dataType: 'json',
                        success: function(response) {
                            showNotification(response.message, response.status); // Show notification based on status
                            loadBuses();
                        }
                    });
                }
            }
        });
    </script>
</body>
</html>
