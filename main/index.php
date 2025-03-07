<?php
  session_start();
  require('inc/config.php'); // Include database connection

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SWB IITP HOME</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <?php require('inc/links.php')?> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />


    <!-- Css linked -->
    <link rel="stylesheet" href="css/common.css">
   
    <style>
      /* Noticeboard Card Styling */
      #noticeboard .card {
          border: none;
          border-radius: 10px;
          box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
          transition: transform 0.2s, box-shadow 0.2s;
      }

      /* Hover Effect */
      #noticeboard .card:hover {
          transform: translateY(-5px);
          box-shadow: 0px 6px 16px rgba(0, 0, 0, 0.15);
      }

      /* Card Header */
      #noticeboard .card-title {
          
          color: #007bff;
      }

      /* Card Body Styling */
      #noticeboard .card-text {
          color: #555;
          font-size: 0.95rem;
      }

      /* Timestamp Styling */
      #noticeboard .timestamp {
          font-size: 0.8rem;
          color: #999;
      }

      /* Spacing */
      .noticeboard-container {
          max-width: 800px;
          margin: 0 auto;
      }

      .availability-form{
        
        margin-top: -50px ; 
        z-index: 2 ; 
        position: relative;
      }

      @media screen and (max-width: 575px)   {
        .availability-form{
          margin-top : 25px ; 
          padding : 0 35px; 
      }
      }
    </style>
</head>
<body class="bg-light">

<?php require('inc/header.php')?> 


<!----------------------------Carousal  ------------------------------------>
  <div class="container-fluid px-lg-4 mt-4">
    <!-- Swiper -->
    <div class="swiper swiper-container">
      <div class="swiper-wrapper">
        
        <div class="swiper-slide">
          <img src="images\carousel\IMG2.jpg" class="w-100 d-block swipe-image "  />
        </div>
        <div class="swiper-slide">
          <img src="images\carousel\IMG1.jpg" class="w-100 d-block swipe-image" />
        </div>
        <div class="swiper-slide">
          <img src="images\carousel\IMG_55677.png" class="w-100 d-block swipe-image" />
        </div>
        <div class="swiper-slide">
          <img src="images\carousel\IMG_62045.png" class="w-100 d-block swipe-image" />
        </div>
        <div class="swiper-slide">
          <img src="images\carousel\IMG_93127.png" class="w-100 d-block swipe-image" />
        </div>
        <div class="swiper-slide">
          <img src="images\carousel\IMG_99736.png" class="w-100 d-block swipe-image" />
        </div>
      </div>
      
    </div>
  </div>

<!----------------------------Carousal Ends  ------------------------------------>


<!----------------- Check Availability Form  ------------------------------------->
  <div class="container availability-form">
    <div class="row">
      <div class="col-lg-12 bg-white shadow p-4 rounded">
        <h5 class="mb-4">Check BUS Availability</h5>
        <form>
          <div class="row align-items-end">
            <div class="col-lg-3 mb-3">
              <label  class="form-label" style="font-weight: 500 ; ">Date of Travel</label>
              <input type="date" class="form-control shadow-none" >

            </div>

            <div class="col-lg-3 mb-3">
              <label  class="form-label" style="font-weight: 500 ; ">Source</label>
              <input type="text" class="form-control shadow-none" >

            </div>

            <div class="col-lg-3 mb-3">
              <label  class="form-label" style="font-weight: 500 ; ">Destination</label>
              <input type="text" class="form-control shadow-none" >

            </div>
            

            <div class="col-lg-2 mb-3">
              <label  class="form-label" style="font-weight: 500 ; ">Passengers</label>
                <select class="form-select shadow-none" >
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
                </select>

            </div>

            
            <div class="col-lg-1 mb-lg-3 mt-2">
              <button type="submit" class="btn text-white shadow-none custom-bg">Submit</button>
            </div>


          </div>
        </form>
      </div>
    </div>
  </div>

<!------------------ Check Availability Form Ends Here  -------------------------->


<div class="container mt-4 ">
    <h3 class="text-center mb-4">Noticeboard</h3>
    <div id="noticeboard" class="row row-cols-1 row-cols-md-2 g-4"></div>
</div>



<!------------------------------Our BUSES Section--------------------------------->
  <h2 class="mt-5 pt-4 mb-4 fw-bold text-center h-font">BUSES</h2>

  <div class="container">
    <div class="row">
      <div class="col-lg-4 md-6 my-3">
        <div class="card border-0 shadow" style="max-width: 350px; margin:auto ;">
          <img src="images\buses\BUS3.jpg" class="card-img-top" >
          
          <div class="card-body">
            <h5 >BUS 1 </h5> 
            <h6 class="mb-4 ">IITP --> Bihar Museum </h6>

            <div class="timings mb-4 ">
              <h6 class="mb-1">Timings</h6>
                <span class="badge rounded-pill bg-light text-dark text-wrap">
                  Morning 11:00 am 
                </span>
                <span class="badge rounded-pill bg-light text-dark text-wrap">
                  Evening 3:00 pm  
                </span>
                

            </div>

            <div class="rating mb-4">
              <h6 class="mb-1">Rating</h6>
              <span class="badge rounded-pill bg-light">
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
              </span>
            </div>
            
            <div class="d-flex justify-content-evenly mb-2">
              <a href="#" class="btn btn-sm text-white custom-bg shadow-none">Book Tickets</a>
              <a href="#" class="btn btn-sm btn-outline-dark shadow-none">More details</a>
            </div>


          </div>
        </div>

      </div>

      <div class="col-lg-4 md-6 my-3">
        <div class="card border-0 shadow" style="max-width: 350px; margin:auto ;">
          <img src="images\buses\BUS2.jpg" class="card-img-top" >
          
          <div class="card-body">
            <h5 >BUS 2 </h5> 
            <h6 class="mb-4 ">IITP --> Bihar Museum </h6>

            <div class="timings mb-4 ">
              <h6 class="mb-1">Timings</h6>
                <span class="badge rounded-pill bg-light text-dark text-wrap">
                  Morning 11:00 am 
                </span>
                <span class="badge rounded-pill bg-light text-dark text-wrap">
                  Evening 3:00 pm  
                </span>
                

            </div>

            <div class="rating mb-4">
              <h6 class="mb-1">Rating</h6>
              <span class="badge rounded-pill bg-light">
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
              </span>
            </div>
            
            <div class="d-flex justify-content-evenly mb-2">
              <a href="#" class="btn btn-sm text-white custom-bg shadow-none">Book Tickets</a>
              <a href="#" class="btn btn-sm btn-outline-dark shadow-none">More details</a>
            </div>


          </div>
        </div>

      </div>

      <div class="col-lg-4 md-6 my-3">
        <div class="card border-0 shadow" style="max-width: 350px; margin:auto ;">
          <img src="images\buses\BUS3.jpg" class="card-img-top" >
          
          <div class="card-body">
            <h5 >BUS 3 </h5> 
            <h6 class="mb-4 ">IITP --> Bihar Museum </h6>

            <div class="timings mb-4 ">
              <h6 class="mb-1">Timings</h6>
                <span class="badge rounded-pill bg-light text-dark text-wrap">
                  Morning 11:00 am 
                </span>
                <span class="badge rounded-pill bg-light text-dark text-wrap">
                  Evening 3:00 pm  
                </span>
                

            </div>

            <div class="rating mb-4">
              <h6 class="mb-1">Rating</h6>
              <span class="badge rounded-pill bg-light">
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
              </span>
            </div>
            
            <div class="d-flex justify-content-evenly mb-2">
              <a href="#" class="btn btn-sm text-white custom-bg shadow-none">Book Tickets</a>
              <a href="#" class="btn btn-sm btn-outline-dark shadow-none">More details</a>
            </div>


          </div>
        </div>

      </div>

      

      
    </div>


    <div class="col-lg-12 text-center mt-5 text-center"> 
      <a href="#" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none "> More Buses>>>   </a>
    </div>
  </div>



<!------------------------------Our BUSES Ends------------------------------------>


<br><br><br>
<br><br><br>

<!----------------------------- Testimonials ----------------------------------->
  <div class="container">
    <div class="swiper swiper-testimonials">
      <div class="swiper-wrapper mb-5">
        <div class="swiper-slide bg-white mb-3">
          <div class="profile d-flex align-items-center mb-3">
            <img src="images/features/user.png" width="30px">
            <h6 class="m-0 ms-2">Random user1</h6>
          </div>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Id nemo excepturi, incidunt qui libero at omnis iure
            magni tempora ea.
          </p>
          <div class="rating">
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
          </div>
        </div>

        <div class="swiper-slide bg-white mb-3">
          <div class="profile d-flex align-items-center mb-3">
            <img src="images/features/user.png" width="30px">
            <h6 class="m-0 ms-2">Random user1</h6>
          </div>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Id nemo excepturi, incidunt qui libero at omnis iure
            magni tempora ea.
          </p>
          <div class="rating">
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
          </div>
        </div>

        <div class="swiper-slide bg-white mb-3">
          <div class="profile d-flex align-items-center mb-3">
            <img src="images/features/user.png" width="30px">
            <h6 class="m-0 ms-2">Random user1</h6>
          </div>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Id nemo excepturi, incidunt qui libero at omnis iure
            magni tempora ea.
          </p>
          <div class="rating">
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
          </div>
        </div>

        <div class="swiper-slide bg-white mb-3">
          <div class="profile d-flex align-items-center mb-3">
            <img src="images/features/user.png" width="30px">
            <h6 class="m-0 ms-2">Random user1</h6>
          </div>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Id nemo excepturi, incidunt qui libero at omnis iure
            magni tempora ea.
          </p>
          <div class="rating mb-3 ">
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
          </div>
        </div>

        
        
      </div>
      
      <div class="swiper-pagination"></div>
    </div>
  </div>

<!----------------------------- Swiper Testimonials ------------------------------->

<br><br><br>

<!------------------------------ Reach us ---------------------------------------->

  <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font"> REACH US </h2>

  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-8 p-4 mb-lg-0 mb-3 bg-white rounded">
        <iframe class="w-100 rounded" height="320" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4522.494442641463!2d84.84814439710114!3d25.535684464217653!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39ed577f6954a4ab%3A0x6ce8f1b9fc2aa02a!2sIndian%20Institute%20of%20Technology%2C%20Patna!5e0!3m2!1sen!2sin!4v1725796231525!5m2!1sen!2sin" height="450" loading="lazy" ></iframe>
      </div>
      <div class="col-lg-4 col-md-4">
        <div class="bg-white p-4 rounded mb-4">
          <h5>Call us</h5>
            <a href="tel: +917778889991" class="d-inline-block mb-2 text-decoration-none text-dark">
              <i class="bi bi-telephone-fill"></i> +917778889991
            </a>
            
            <br>
            <a href="tel: +917778889991" class="d-inline-block text-decoration-none text-dark">
              <i class="bi bi-telephone-fill"></i> +917778889991
            </a>

        </div>

        <div class="bg-white p-4 rounded mb-4 align-bottom">
          
          <h5>Follow us</h5>
          <a href="#" class="d-inline-block mb-3 ">
          
            <span class="badge bg-light text-dark fs-6 p-2">
              <i class="bi bi-twitter me-1"></i> Twitter
            </span>
            
          </a>
          <br>

          <a href="#" class="d-inline-block mb-3">
            <span class="badge bg-light text-dark fs-6 p-2">
              <i class="bi bi-facebook me-1"></i> Facebook

            </span>
          </a>
          
          <br>

          <a href="#" class="d-inline-block">
            <span class="badge bg-light text-dark fs-6 p-2">
              <i class="bi bi-instagram me-1" ></i> Instagram
            </span>
          </a>

            
        </div>

        
      </div>

      </div>
    </div>
  </div>


<!------------------------------ Reach us ---------------------------------------->

<?php require('inc/footer.php')?> 

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>


<!--------------Swiper script-------------->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


  <script>
    function fetchNotifications() {
      $.ajax({
          url: 'ajax/fetch_notifications.php',
          method: 'GET',
          success: function (data) {
              let notifications = JSON.parse(data);
              let noticeboard = $('#noticeboard');
              noticeboard.empty(); // Clear previous notifications

              notifications.forEach(notification => {
                  noticeboard.append(`
                        <div class="col">
                          <div class="card h-100">
                              <div class="card-body">
                                  <h5 class="card-title">${notification.title}</h5>
                                  <p class="card-text">${notification.description}</p>
                              </div>
                              <div class="card-footer">
                                  <small class="timestamp">${new Date(notification.created_at).toLocaleString()}</small>
                              </div>
                          </div>
                        </div>
                      `);
                  });
            }
        });
    }

    // Initial fetch when the page loads
    fetchNotifications();

    // Set interval to refresh notifications every 30 seconds (30000 milliseconds)
    setInterval(fetchNotifications, 30000);


    // ---------------------------------------------------



    // -----------------------------------------------------

    var swiper = new Swiper(".swiper-container", {
      spaceBetween: 30,
      effect: "fade",
      loop: true,
    
      
    });

    document.querySelectorAll('.swipe-image').forEach(function(image) {
      image.addEventListener('click', function() {
        swiper.slideNext();
      });
    });

    var swiper = new Swiper(".swiper-testimonials", {
      effect: "coverflow",
      grabCursor: true,
      centeredSlides: true,
      slidesPerView: "auto",
      slidesPerView: "3",
      loop: true, 
      coverflowEffect: {
        rotate: 50,
        stretch: 0,
        depth: 100,
        modifier: 1,
        slideShadows: false ,
      },

    
      pagination: {
        el: ".swiper-pagination",
      },

      breakpoints: {
        320 : {
          slidesPerView : 1, 
        },
        640 : {
          slidesPerView : 1, 
        },
        768 : {
          slidesPerView : 2, 
        },
        1024 : {
          slidesPerView : 3, 
        },

      }
    });

    
  </script>
<!--------------Swiper script ends-------------->

</body>
</html>