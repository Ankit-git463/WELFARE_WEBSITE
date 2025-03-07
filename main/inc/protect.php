<?php
    include '../inc/functions.php';

    // Redirect if not logged in
    if (!isUserLoggedIn()) {
        header("Location: login.php"); // Redirect to login page
        exit;
    }
?>
