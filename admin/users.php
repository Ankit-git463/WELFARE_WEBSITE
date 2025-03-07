<?php 
    require('inc/essentials.php');
    adminLogin();
    require('inc/config.php'); // Include your database connection file
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Users</title>
   <?php require('inc/links.php'); ?> 
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

   <style>
        /* Custom alert styles */
        #custom-alert {
            display: none;
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            border-radius: 5px;
            font-size: 16px;
            z-index: 1000000;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        #custom-alert.error {
            background-color: #f44336; /* Red for error */
        }

        #custom-alert.success {
            background-color: #4CAF50; /* Green for success */
        }
   </style>
</head>

<body class="bg-white">

    <?php require('inc/header.php'); ?> 

    <div id="custom-alert" class="success"></div>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-3 overflow-hidden">
                <h2>Registered Users</h2>
                
                <button class="btn btn-primary my-3" data-toggle="modal" data-target="#addUserModal">Add User</button>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Resident</th>
                            <th>Designation</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="user-table-body">
                        <?php 
                        $result = $conn->query("SELECT * FROM users");
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['firstname']}</td>
                                    <td>{$row['lastname']}</td>
                                    <td>{$row['email']}</td>
                                    <td>{$row['phone']}</td>
                                    <td>{$row['resident']}</td>
                                    <td>{$row['designation']}</td>
                                    <td>
                                        <button class='btn btn-warning' onclick='editUser({$row['id']})'>Edit</button>
                                        <button class='btn btn-danger' onclick='deleteUser({$row['id']})'>Delete</button>
                                    </td>
                                  </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add User Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addUserForm">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" name="first_name" required>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" name="last_name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="resident">Resident</label>
                            <input type="text" class="form-control" name="resident" required>
                        </div>
                        <div class="form-group">
                            <label for="designation">Designation</label>
                            <input type="text" class="form-control" name="designation" required>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="addUser()">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editUserForm">
                        <input type="hidden" name="id" id="editUserId">
                        <div class="form-group">
                            <label for="edit_first_name">First Name</label>
                            <input type="text" class="form-control" name="first_name" id="edit_first_name" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_last_name">Last Name</label>
                            <input type="text" class="form-control" name="last_name" id="edit_last_name" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_email">Email</label>
                            <input type="email" class="form-control" name="email" id="edit_email" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_phone">Phone</label>
                            <input type="text" class="form-control" name="phone" id="edit_phone" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_resident">Resident</label>
                            <input type="text" class="form-control" name="resident" id="edit_resident" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_designation">Designation</label>
                            <input type="text" class="form-control" name="designation" id="edit_designation" required>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="updateUser()">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php require('inc/scripts.php'); ?> 

    <script>
        // Function to show custom alerts
        function showCustomAlert(message, type) {
            const alertBox = $('#custom-alert');
            alertBox.text(message);
            alertBox.removeClass('success error').addClass(type);
            alertBox.fadeIn();
            setTimeout(() => alertBox.fadeOut(), 2000);
        }

        // Add User Logic
        function addUser() {
            $.ajax({
                type: "POST",
                url: "ajax/add_user.php",
                data: $("#addUserForm").serialize(),
                success: function(response) {
                    if (response.success) {
                        $('#addUserModal').modal('hide');
                        $('#user-table-body').append(`
                            <tr id="user_${response.data.id}">
                                <td>${response.data.firstname}</td>
                                <td>${response.data.lastname}</td>
                                <td>${response.data.email}</td>
                                <td>${response.data.phone}</td>
                                <td>${response.data.resident}</td>
                                <td>${response.data.designation}</td>
                                <td>
                                    <button class="btn btn-warning" onclick="editUser(${response.data.id})">Edit</button>
                                    <button class="btn btn-danger" onclick="deleteUser(${response.data.id})">Delete</button>
                                </td>
                            </tr>
                        `);
                        showCustomAlert('User added successfully!', 'success');
                        $("#addUserForm")[0].reset();
                    } else {
                        showCustomAlert(response.message, 'error');
                    }
                }
            });
        }

        // Fetch user details and open the edit modal
        function editUser(userId) {
            $.ajax({
                type: "GET",
                url: `ajax/get_user.php?id=${userId}`,
                success: function(response) {
                    if (response.success) {
                        const user = response.data;
                        $('#editUserId').val(user.id);
                        $('#edit_first_name').val(user.firstname);
                        $('#edit_last_name').val(user.lastname);
                        $('#edit_email').val(user.email);
                        $('#edit_phone').val(user.phone);
                        $('#edit_resident').val(user.resident);
                        $('#edit_designation').val(user.designation);

                        $('#editUserModal').modal('show');
                    } else {
                        showCustomAlert(response.message, 'error');
                    }
                }
            });
        }

        // Update user details
        function updateUser() {
            $.ajax({
                type: "POST",
                url: "ajax/edit_user.php",
                data: $("#editUserForm").serialize(),
                success: function(response) {
                    if (response.success) {
                        $('#editUserModal').modal('hide');

                        // Update the table row dynamically
                        $(`#user_${response.data.id}`).html(`
                            <td>${response.data.firstname}</td>
                            <td>${response.data.lastname}</td>
                            <td>${response.data.email}</td>
                            <td>${response.data.phone}</td>
                            <td>${response.data.resident}</td>
                            <td>${response.data.designation}</td>
                            <td>
                                <button class="btn btn-warning" onclick="editUser(${response.data.id})">Edit</button>
                                <button class="btn btn-danger" onclick="deleteUser(${response.data.id})">Delete</button>
                            </td>
                        `);

                        showCustomAlert('User updated successfully!', 'success');
                    } else {
                        showCustomAlert(response.message, 'error');
                    }
                }
            });
        }

        // Delete user
        function deleteUser(userId) {
            if (confirm('Are you sure you want to delete this user?')) {
                $.ajax({
                    type: "POST",
                    url: "ajax/delete_user.php",
                    data: { id: userId },
                    success: function(response) {
                        if (response.success) {
                            $(`#user_${userId}`).remove();
                            showCustomAlert('User deleted successfully!', 'success');
                        } else {
                            showCustomAlert(response.message, 'error');
                        }
                    }
                });
            }
        }

    </script>
</body>
</html>
