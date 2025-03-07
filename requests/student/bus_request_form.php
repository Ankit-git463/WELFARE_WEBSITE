<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Request Form</title>
    <?php require('../inc/links.php'); ?> <!-- Include your Bootstrap and CSS links -->
</head>
<body class="bg-light">

    <?php require('../inc/header.php'); ?> <!-- Include your navigation header -->

    <!-- Form Section -->
    <div class="container my-5 px-4">
        <h2 class="fw-bold h-font text-center">Bus Request Form</h2>
        <div class="h-line bg-dark"></div>

        <!-- Bus Request Form -->
        <div class="row justify-content-center mt-4">
            <div class="row align-items-center">
                <div class="col-lg-5  m-2 rounded shadow-sm alert alert-info ">
                
                    <h5 class="mb-3">How to Make a Bus Request</h5>
                    <p>To request a bus, please follow these steps:</p>
                    <ol>
                        <li>Select the desired date from the date picker.</li>
                        <li>Choose the time for your bus request.</li>
                        <li>Click the "Submit Request" button to send your request.</li>
                    </ol>
                    <p>You will receive a confirmation notification after your request has been processed.</p>
                

                    
                </div>
                
               
                <div class="col-lg-6 bg-white m-2 p-4 rounded shadow-sm ">
                   
                    <strong><p>To request a bus, please fill out the form below:</p></strong>
                    <form id="bus-request-form" action="handle_request.php" method="POST">
                        <!-- Date Field -->
                        <div class="form-group mb-3">
                            <label for="request_date" class="form-label">Select Date:</label>
                            <input type="date" class="form-control" id="request_date" name="request_date" required>
                        </div>
                        
                        <!-- Time Slot Field -->
                        <div class="form-group mb-3">
                            <label for="time_slot_start" class="form-label">Select Time Slot:</label>
                            <select class="form-control" id="time_slot_start" name="time_slot_start" required>
                                <option value="">Select Time Slot</option>
                                <option value="08:00:00">08:00 - 08:30</option>
                                <option value="08:30:00">08:30 - 09:00</option>
                                <option value="09:00:00">09:00 - 09:30</option>
                                <option value="09:30:00">09:30 - 10:00</option>
                                <option value="10:00:00">10:00 - 10:30</option>
                                <option value="10:30:00">10:30 - 11:00</option>
                                <!-- Add more time slots as needed -->
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary btn-block">Submit Request</button>
                    </form>
                </div>
            </div>
            
        </div>
    </div>

    <!-- Footer Section -->
    <?php require('../inc/footer.php'); ?> <!-- Include your footer -->

</body>
</html>
