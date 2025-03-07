<?php
    $servername = "localhost"; // Change as needed
    $username = "root"; // Change as needed
    $password = "iitpatna"; // Change as needed
    $dbname = "requests"; // Change as needed

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname, 3307);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>
