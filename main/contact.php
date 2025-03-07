<?php
require('inc/config.php');  // Database connection

$success = "";
$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Fetch and sanitize form data
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = isset($_POST['phone']) ? trim($_POST['phone']) : null;
    $subject = trim($_POST['subject']);
    $message_text = trim($_POST['message']);
    $category = trim($_POST['category']);

    // Validate required fields
    if (!empty($name) && !empty($email) && !empty($subject) && !empty($message_text)) {
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO queries (name, email, phone, subject, message, category) VALUES (?, ?, ?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("ssssss", $name, $email, $phone, $subject, $message_text, $category);

            if ($stmt->execute()) {
                $success = "Your query has been submitted successfully!";
            } else {
                $error = "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            $error = "Error preparing the statement: " . $conn->error;
        }
    } else {
        $error = "Please fill in all required fields.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SWB - Contact Us</title>
    <?php require('inc/links.php')?> 

    <style>
        .query-form {
            width: 60%;
            margin: 0 auto;
        }

        @media screen and (max-width: 575px) {
            .query-form {
                width: 80%;
            }
        }

        @media screen and (min-width: 576px) and (max-width: 992px) {
            .query-form {
                width: 90%;
            }
        }

        .quick-links ul {
            list-style: none;
            padding-left: 0;
        }

        .quick-links ul li {
            padding: 5px 0;
        }

        .quick-links ul li a {
            text-decoration: none;
            color: #007bff;
        }

        .quick-links ul li a:hover {
            text-decoration: underline;
        }

        /* Positioning the alert */
        .alert-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050; /* Above other elements */
        }
    </style>
</head>
<body class="bg-light">

    <?php require('inc/header.php')?> 

    <!-- Alert Messages -->
    <div class="alert-container">
        <?php if (!empty($success)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo htmlspecialchars($success); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo htmlspecialchars($error); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
    </div>

    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">CONTACT US</h2>
        
        <div class="h-line bg-dark"></div>
        <p class="text-center mt-3">
            Fill out the form below if you have any questions or queries. We’ll respond as soon as possible.
        </p>
    </div>

    <div class="container border shadow query-form rounded bg-white pt-5 mb-5">
        <h4 class="fw-bold h-font text-center">QUERY FORM</h4>
        <div class="hw-line bg-dark"></div>

        <!-- Query Form -->
        <form class="row g-3 py-4 px-4" action="" method="POST">
            <div class="col-md-6">
                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="col-md-6">
                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="col-md-6">
                <label for="phone" class="form-label">Phone (Optional)</label>
                <input type="tel" class="form-control" id="phone" name="phone" pattern="[0-9]{10}" placeholder="10-digit number">
            </div>

            <div class="col-md-6">
                <label for="category" class="form-label">Query Category <span class="text-danger">*</span></label>
                <select class="form-select" id="category" name="category" required>
                    <option value="" disabled selected>Choose...</option>
                    <option value="General">General</option>
                    <option value="Technical">Technical</option>
                    <option value="Billing">Billing</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <div class="col-12">
                <label for="subject" class="form-label">Subject <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="subject" name="subject" required>
            </div>

            <div class="col-12">
                <label for="message" class="form-label">Your Query/Message <span class="text-danger">*</span></label>
                <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">Submit Query</button>
            </div>

            <span class="bg-white text-dark mb-3">
                ** We will get back to you as soon as possible.
            </span>
        </form>
    </div>

    

    <br><br><br>
    
    <?php require('inc/footer.php')?> 

    <!-- Bootstrap JS (required for alerts) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
