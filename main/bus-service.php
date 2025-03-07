<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BUS-SERVICE</title>
    <?php require('inc/links.php')?> 

</head>
<body class="bg-light">

    <?php require('inc/header.php')?> 

    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">SCHEDULE</h2>
        <div class="h-line bg-dark"></div>
       
    </div>


    <div class="container ">
        <div class="row">
            <div class="col-lg-3 mb-4">
                <nav class="navbar navbar-expand-lg navbar-light bg-white rounded shadow">
                    <div class="container-fluid flex-lg-column align-items-stretch">
                        <h4 class="mt-4">FILTERS</h4>
                        
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>


                        <div class="collapse navbar-collapse flex-column mt-3 px-2" id="navbarNav">

                        
                            <div class="border bg-light p-3 rounded mb-3 ">
                                <h5 class="mb-3" style="font-size: 18px;">CHECK AVAILABILITY</h5>
                                <label class="form-label">Date</label>
                                <input type="date" class="form-control shadow-none mb-3">
                                <label class="form-label">TIME</label>
                                <input type="time" class="form-control shadow-none mb-3">


                                <label class="form-label">Source</label>
                                <input type="text" class="form-control shadow-none mb-3">
                                <label class="form-label">Destination</label>
                                <input type="text" class="form-control shadow-none">



                                <h5 class="mb-3 mt-3" style="font-size: 18px;">BUS TYPE</h5>
                                
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Institute Bus" id="instituteBus">
                                    <label class="form-check-label" for="instituteBus">
                                        Institute Bus
                                    </label>
                                </div>
                                
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="IITP Bus" id="iipBus">
                                    <label class="form-check-label" for="iipBus">
                                        IITP Bus
                                    </label>
                                </div>
                                
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Girls Bus" id="girlsBus">
                                    <label class="form-check-label" for="girlsBus">
                                        Girls Bus
                                    </label>
                                </div>
                                
                            </div>



                            <button type="button" class="btn btn-primary mt-3 mb-5">Apply Filters</button>



                           

                        
                        </div>

                    </div>
                        
                </nav>
            </div>




            <div class="col-lg-9">
                <div class="row">
                    <!-- First Card -->
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="images/buses/BUS1.jpg" class="card-img-top img-fluid custom-img-size" alt="Bus Schedule 1">
                            <div class="card-body position-relative">
                                <h5 class="card-title position-absolute top-50 start-50 translate-middle text-black ">
                                    Bus Schedule 1
                                </h5>
                            </div>
                        </div>
                    </div>
                    <!-- Second Card -->
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="images/buses/BUS2.jpg" class="card-img-top img-fluid custom-img-size" alt="Bus Schedule 2">
                            <div class="card-body position-relative">
                                <h5 class="card-title position-absolute top-50 start-50 translate-middle text-black ">
                                    Bus Schedule 2
                                </h5>
                            </div>
                        </div>
                    </div>
                    <!-- Third Card -->
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="images/buses/BUS4.jpg" class="card-img-top img-fluid custom-img-size" alt="Bus Schedule 3">
                            <div class="card-body position-relative">
                                <h5 class="card-title position-absolute top-50 start-50 translate-middle text-black ">
                                    Bus Schedule 3
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <style>
                .custom-img-size {
                    height: 200px; /* Adjust the height to your preference */
                    object-fit: cover; /* Ensures images maintain aspect ratio and are properly sized */
                }
            </style>


                
        </div>
    </div>

    <br><br><br>
    <br><br><br>
    
    <?php require('inc/footer.php')?> 


</body>
</html>