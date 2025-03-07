<?php
// functions.php

// Function to check if a user is logged in
    function isUserLoggedIn() {
        // Start the session if it hasn't started yet
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Check if user ID session variable is set
        return isset($_SESSION['user_id']);
    }

    function checkuser(){
        echo "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Access Denied</title>
            <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css' rel='stylesheet'>
            <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js'></script>
            <link rel='icon' href='inc/favicon.png' type='image/x-icon'>
            <style>
                .modal-backdrop {
                    background-color: rgba(0, 0, 0, 0.8);
                }
            </style>
        </head>
        <body>
            <!-- Bootstrap Modal -->
            <div class='modal show' tabindex='-1' style='display: block;'>
                <div class='modal-dialog modal-dialog-centered'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h5 class='modal-title text-danger' style='font-size: 1.75rem;'>Access Denied</h5>

                        </div>
                        <div class='modal-body'>
                            <p class='text-primary'  style='font-size: 1.5rem;'>
                                You must be logged in to access this page.
                            </p>

                        </div>
                        <div class='modal-footer'>
                            <button type='button' class='btn btn-primary' disabled>Redirecting...</button>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                setTimeout(function() {
                    window.location.href = 'index.php';
                }, 3000); // Redirect after 3 seconds
            </script>
        </body>
        </html>";

    }
?>
