<?php
    // Database connection
    require('../inc/config.php');

    // Limit to 10 most recent notifications
    $result = $conn->query("SELECT * FROM notifications ORDER BY created_at DESC LIMIT 10");
    $notifications = $result->fetch_all(MYSQLI_ASSOC);

    // Output notifications in JSON format
    echo json_encode($notifications);

?>
