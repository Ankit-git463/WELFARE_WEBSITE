<?php
require('inc/config.php');  // Database connection

// Fetch unresolved and resolved queries
$unresolved_queries = $conn->query("SELECT * FROM queries WHERE status = 'unresolved' ORDER BY created_at DESC");
$resolved_queries = $conn->query("SELECT * FROM queries WHERE status = 'resolved' ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Queries</title>
    <?php require('inc/links.php')?>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .query-section {
            margin-top: 30px;
        }
        .fw-600{
            font-weight: 600 ; 
        }
    </style>
</head>
<body>

<?php require('inc/header.php')?> 

<div class="container mt-5 ">
    <h2 class="fw-600 text-center">Query Management</h2>

    <!-- Unresolved Queries Section -->
    <div class="query-section col-lg-10 ms-auto p-3 overflow-hiddden">
        <h3>Unresolved Queries</h3>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $unresolved_queries->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['subject']; ?></td>
                            <td><?php echo $row['message']; ?></td>
                            <td>
                                <button class="btn btn-primary btn-sm m-2" data-bs-toggle="modal" data-bs-target="#resolveModal" 
                                    data-id="<?php echo $row['id']; ?>" data-email="<?php echo $row['email']; ?>">
                                    Resolve
                                </button>
                                <button class="btn btn-danger btn-sm delete-query m-2" data-id="<?php echo $row['id']; ?>">Delete</button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Resolved Queries Section -->
    <div class="query-section col-lg-10 ms-auto p-3 overflow-hiddden">
        <h3>Resolved Queries</h3>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Reply</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $resolved_queries->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['subject']; ?></td>
                            <td><?php echo $row['message']; ?></td>
                            <td><?php echo $row['reply']; ?></td>
                            <td>
                                <button class="btn btn-danger btn-sm delete-query m-2" data-id="<?php echo $row['id']; ?>">Delete</button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Resolve Query Modal -->
<div class="modal fade" id="resolveModal" tabindex="-1" aria-labelledby="resolveModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="resolveForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="resolveModalLabel">Resolve Query</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="queryId" name="queryId">
                    <div class="mb-3">
                        <label for="reply" class="form-label">Reply to the Query</label>
                        <textarea class="form-control" id="reply" name="reply" rows="4" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Send reply to</label>
                        <input type="email" class="form-control" id="email" name="email" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Mark as Resolved & Send</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap and jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Handle Resolve Modal opening
    $('#resolveModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var queryId = button.data('id');
        var email = button.data('email');

        var modal = $(this);
        modal.find('#queryId').val(queryId);
        modal.find('#email').val(email);
    });

    // Handle query resolution and marking as resolved
    $('#resolveForm').on('submit', function (e) {
        e.preventDefault();

        var formData = $(this).serialize();

        $.post('ajax/resolve_query.php', formData, function (response) {
           
            if (response.success) {
                location.reload();
            }
        }, 'json');
    });

    // Handle deleting a query
    $('.delete-query').on('click', function () {
        var queryId = $(this).data('id');

        if (confirm('Are you sure you want to delete this query?')) {
            $.post('ajax/delete_query.php', { queryId: queryId }, function (response) {
               
                if (response.success) {
                    location.reload();
                }
            }, 'json');
        }
    });
</script>

</body>
</html>
