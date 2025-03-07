<?php 
    require('inc/config.php'); 
    require('inc/essentials.php'); 


    session_start();
    session_regenerate_id(true);
    
    if (isset($_SESSION['driverLogin']) && $_SESSION['driverLogin'] == true){
        redirect('driverdash.php');
    }
?>  


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver Login</title>
    <?php require('inc/links.php'); ?>
    
    <style>
        div.login-form {
            position: absolute;
            top: 50%;
            left: 50%; 
            transform: translate(-50%, -50%);
            width: 400px;
        }
        
        .alert {
            display: none; /* Initially hidden */
        }
    </style>

</head>
<body class="bg-light">

    <!-- Alert Message -->
    <div id="alert-message" class="alert alert-danger text-center">
        Login Failed - Invalid Credentials
    </div>

    <div class="login-form text-center rounded bg-white shadow overflow-hidden">
        <form method="POST">
            <h4 class="bg-dark text-white py-3">DRIVER LOGIN</h4>

            <div class="p-4">
                <div class="mb-3">
                    <label class="form-label">Driver Name</label>
                    <input name="driver_name" required type="text" class="form-control shadow-none text-center" placeholder="Name">
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input name="driver_pass" required type="password" class="form-control shadow-none text-center" placeholder="Password">
                </div>

                <button name="login" type="submit" class="btn text-white custom-bg shadow-none">LOGIN</button>
            </div>
        </form>
    </div>

    

    <?php 
        if (isset($_POST['login'])){

            $frm_data = filteration($_POST);

            $query = "SELECT * FROM driver_cred WHERE driver_name=? AND driver_pass=?";

            $values = [$frm_data["driver_name"], $frm_data["driver_pass"]];
            $res = select($query, $values, "ss");

            if ($res->num_rows == 1) {
                echo "USER PRESENT";
                $row = mysqli_fetch_assoc($res);

                $_SESSION['driverLogin'] = true; 
                $_SESSION['driverId'] = $row['sr_no'];

                redirect('driverdash.php');
            } else {
                // Add JavaScript to display the alert message
                echo '<script>
                        document.getElementById("alert-message").style.display = "block"; 
                        setTimeout(function(){
                            document.getElementById("alert-message").style.display = "none";
                        }, 3000); // Hide the alert after 3 seconds
                    </script>';
            }
        }
    ?>

</body>
</html>
