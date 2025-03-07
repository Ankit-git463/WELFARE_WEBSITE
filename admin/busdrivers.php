<?php 
    require('inc/essentials.php');
    adminLogin();
    require('inc/config.php'); // Include your database connection file

    // Fetch drivers
    $driversQuery = "SELECT * FROM drivers";
    $driversResult = $conn->query($driversQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Drivers</title>
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

    <!-- Notification Alert -->
    <div id="notification-alert"></div>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-3 overflow-hidden">
                <h2>Available Drivers</h2>
                <button class="btn btn-primary mb-3" onclick="openAddDriverModal()">Add Driver</button>
                
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>License Number</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="drivers-table">
                        <?php while($driver = $driversResult->fetch_assoc()): ?>
                        <tr data-id="<?php echo $driver['id']; ?>">
                            <td><?php echo $driver['id']; ?></td>
                            <td><?php echo $driver['name']; ?></td>
                            <td><?php echo $driver['email']; ?></td>
                            <td><?php echo $driver['phone']; ?></td>
                            <td><?php echo $driver['license_number']; ?></td>
                            <td>
                                <button class="btn btn-warning btn-sm" onclick="openEditDriverModal(<?php echo $driver['id']; ?>, '<?php echo $driver['name']; ?>', '<?php echo $driver['email']; ?>', '<?php echo $driver['phone']; ?>', '<?php echo $driver['license_number']; ?>')">Edit</button>
                                <button class="btn btn-danger btn-sm" onclick="deleteDriver(<?php echo $driver['id']; ?>)">Delete</button>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>

    <?php require('inc/scripts.php'); ?> 

    <!-- Add Driver Modal -->
    <div class="modal fade" id="addDriverModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="add-driver-form">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Driver</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="name" class="form-control mb-2" placeholder="Name" required>
                        <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
                        <input type="text" name="phone" class="form-control mb-2" placeholder="Phone" required>
                        <input type="text" name="license_number" class="form-control mb-2" placeholder="License Number" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add Driver</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Driver Modal -->
    <div class="modal fade" id="editDriverModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="edit-driver-form">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Driver</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="edit-driver-id">
                        <input type="text" name="name" id="edit-driver-name" class="form-control mb-2" required>
                        <input type="email" name="email" id="edit-driver-email" class="form-control mb-2" required>
                        <input type="text" name="phone" id="edit-driver-phone" class="form-control mb-2" required>
                        <input type="text" name="license_number" id="edit-driver-license" class="form-control mb-2" required>
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
                alertBox.text(message);
                alertBox.css('background-color', type === 'success' ? '#28a745' : '#dc3545');
                alertBox.fadeIn();

                setTimeout(function() {
                    alertBox.fadeOut();
                }, 3000); // Auto-hide after 3 seconds
            }

            function loadDrivers() {
                $.ajax({
                    url: 'ajax/get_drivers.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function(drivers) {
                        let tableContent = '';
                        drivers.forEach(driver => {
                            tableContent += `
                                <tr data-id="${driver.id}">
                                    <td>${driver.id}</td>
                                    <td>${driver.name}</td>
                                    <td>${driver.email}</td>
                                    <td>${driver.phone}</td>
                                    <td>${driver.license_number}</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning" onclick="openEditDriverModal(${driver.id}, '${driver.name}', '${driver.email}', '${driver.phone}', '${driver.license_number}')">Edit</button>
                                        <button class="btn btn-sm btn-danger" onclick="deleteDriver(${driver.id})">Delete</button>
                                    </td>
                                </tr>
                            `;
                        });
                        $('#drivers-table').html(tableContent);
                    }
                });
            }

            loadDrivers();

            $('#add-driver-form').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'ajax/add_driver.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        showNotification(response.message, response.status);
                        $('#addDriverModal').modal('hide');
                        loadDrivers();
                    }
                });
            });

            $('#edit-driver-form').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'ajax/edit_driver.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        showNotification(response.message, response.status);
                        $('#editDriverModal').modal('hide');
                        loadDrivers();
                    }
                });
            });

            window.openEditDriverModal = function(id, name, email, phone, license) {
                $('#edit-driver-id').val(id);
                $('#edit-driver-name').val(name);
                $('#edit-driver-email').val(email);
                $('#edit-driver-phone').val(phone);
                $('#edit-driver-license').val(license);
                $('#editDriverModal').modal('show');
            }

            window.deleteDriver = function(id) {
                if (confirm("Are you sure you want to delete this driver?")) {
                    $.ajax({
                        url: 'ajax/delete_driver.php',
                        type: 'POST',
                        data: { id: id },
                        dataType: 'json',
                        success: function(response) {
                            showNotification(response.message, response.status);
                            loadDrivers();
                        }
                    });
                }
            }

            window.openAddDriverModal = function() {
                $('#addDriverModal').modal('show');
            }
        });
    </script>
</body>
</html>
