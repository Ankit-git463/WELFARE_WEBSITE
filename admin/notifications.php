<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Notifications</title>
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
                <h3 class="text-center mb-4">Noticeboard</h3>
                <!-- Notification Form -->
                <form id="notification-form" class="bg-light p-4 rounded shadow-sm mb-4">
                    <input type="hidden" name="id" id="notification-id" value=""> <!-- Hidden field for ID -->
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" id="title" class="form-control" placeholder="Enter title" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="4" placeholder="Enter description" required></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Save Notification</button>
                    </div>
                </form>

                <!-- Notifications Table -->
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="notifications-table">
                        <!-- Notifications will be dynamically loaded here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php require('inc/scripts.php'); ?> 

<script>
    $(document).ready(function() {
        // Function to show custom notification alert
        function showNotification(message, type = 'success') {
            let alertBox = $('#notification-alert');
            alertBox.text(message); // Set message
            alertBox.css('background-color', type === 'success' ? '#28a745' : '#dc3545'); // Set color based on type
            alertBox.fadeIn();

            setTimeout(function() {
                alertBox.fadeOut();
            }, 3000); // Auto-hide after 3 seconds
        }

        // Function to load notifications
        function loadNotifications() {
            $.ajax({
                url: 'ajax/get_notification.php',
                type: 'GET',
                dataType: 'json',
                success: function(notifications) {
                    let tableContent = '';
                    notifications.forEach(notification => {
                        tableContent += `
                            <tr data-id="${notification.id}">
                                <td>${notification.title}</td>
                                <td>${notification.description}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning edit-btn">Edit</button>
                                    <button class="btn btn-sm btn-danger delete-btn">Delete</button>
                                </td>
                            </tr>
                        `;
                    });
                    $('#notifications-table').html(tableContent);
                }
            });
        }

        // Initial load of notifications
        loadNotifications();

        // Add or Edit Notification
        $('#notification-form').submit(function(e) {
            e.preventDefault();
            let id = $('#notification-id').val();  // Get ID if it exists
            let url = id ? 'ajax/edit_notification.php' : 'ajax/add_notification.php'; // Determine URL

            $.ajax({
                url: url,
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json', // Expect JSON response from PHP scripts
                success: function(response) {
                    showNotification(response.message, response.status); // Show notification based on status
                    $('#notification-form')[0].reset(); // Reset the form
                    $('#notification-id').val('');  // Clear hidden ID field
                    loadNotifications(); // Reload notifications
                },
                error: function() {
                    showNotification('An error occurred. Please try again.', 'error');
                }
            });
        });

        // Edit Button Click
        $(document).on('click', '.edit-btn', function() {
            let row = $(this).closest('tr');
            let id = row.data('id');
            let title = row.find('td:eq(0)').text();
            let description = row.find('td:eq(1)').text();

            // Populate form with notification data
            $('#notification-id').val(id);  // Set hidden input with ID
            $('#title').val(title);
            $('#description').val(description);
        });

        // Delete Button Click
        $(document).on('click', '.delete-btn', function() {
            let row = $(this).closest('tr');
            let id = row.data('id');

            if (confirm("Are you sure you want to delete this notification?")) {
                $.ajax({
                    url: 'ajax/delete_notification.php',
                    type: 'POST',
                    data: { id: id },
                    dataType: 'json', // Expect JSON response from PHP script
                    success: function(response) {
                        showNotification(response.message, response.status); // Show notification based on status
                        loadNotifications(); // Reload notifications
                    },
                    error: function() {
                        showNotification('Failed to delete notification.', 'error');
                    }
                });
            }
        });
    });
</script>

</body>
</html>
