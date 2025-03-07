<?php require('inc/config.php')?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emergency Contacts</title>
    <?php require('inc/links.php')?> 
    <style>
        /* Custom styles */
        .contacts-section {
            padding: 20px;
        }

        /* Flexbox for two-column layout */
        .contacts-wrapper {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .contact-card {
            background-color: #f8f9fa; /* Light background color */
            padding: 15px;
            margin: 10px 0;
            width: 48%; /* Set half width for each card */
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); /* Slight shadow effect */
            transition: background-color 0.3s ease, box-shadow 0.3s ease; /* Transition for hover */
            border-radius: 8px; /* Rounded corners */
        }

        /* Hover effect */
        .contact-card:hover {
            background-color: #e9ecef; /* Lighter shade on hover */
            box-shadow: 0px 6px 8px rgba(0, 0, 0, 0.2); /* More shadow on hover */
        }

        .contact-card h4 {
            margin-bottom: 10px;
            font-size: 1.1rem;
            color: #333;
        }

        .contact-card p {
            margin-bottom: 0;
            color: #555;
        }

        /* Category title */
        h3.category-title {
            margin-top: 2rem;
            margin-bottom: 1rem;
            font-size: 1.5rem;
            color: #007bff;
            text-align: center;
        }

        /* Page styling */
        .container {
            padding: 20px;
        }
    </style>
</head>
<body class="bg-light">
    <!-- Header -->
    <?php require('inc/header.php')?> 

    <!-- Title Section -->
    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">Emergency Contacts</h2>
        <div class="h-line bg-dark"></div>
    </div>

    <!-- Contacts Section -->
    <div class="container">
        <?php
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Query to get contacts ordered by category
        $query = "SELECT category, name, contact_number FROM contacts ORDER BY category";
        $result = mysqli_query($conn, $query);

        // Initialize the variable to track the current category
        $current_category = '';

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Check if the category has changed
                if ($current_category != $row['category']) {
                    // Close the previous list if it's not the first category
                    if ($current_category != '') {
                        echo "</div><br>";
                    }

                    // Display the new category title
                    $current_category = $row['category'];
                    echo "<h3 class='category-title'>$current_category</h3>";
                    echo "<div class='contacts-wrapper'>";
                }

                // Display the contact information in two-column layout
                echo "<div class='contact-card'>
                        <h4>{$row['name']}</h4>
                        <p>Contact: {$row['contact_number']}</p>
                    </div>";
            }

            // Close the last category's wrapper
            echo "</div>";
        } else {
            echo "<p>No contacts found</p>";
        }

        // Close the database connection
        mysqli_close($conn);
        ?>
    </div>

    <!-- Footer -->
    <?php require('inc/footer.php')?> 

</body>
</html>
