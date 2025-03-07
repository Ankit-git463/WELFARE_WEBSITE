<!--------------------------------- Navigation bar --------------------------->
<nav class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">

<div class="container-fluid">

  <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="index.php">SWB IITP</a>

  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon shadow-none"></span>
  </button>

  
  <div class="collapse navbar-collapse" id="navbarSupportedContent">

    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

      <li class="nav-item">
        <a class="nav-link active me-2" aria-current="page" href="index.php">Home</a>
      </li>

      <li class="nav-item">
        <a class="nav-link me-2" href="schedule.php">SCHEDULE</a>
      </li>
      <li class="nav-item">
        <a class="nav-link me-2" href="filterpage.php">Filter</a>
      </li>
      <li class="nav-item">
        <a class="nav-link me-2" href="contact.php">Contact US </a>
      </li>
      <li class="nav-item">
        <a class="nav-link me-2" href="about.php  ">About</a>
      </li>
    

    </ul>

    <form class="d-flex">
      <!-- <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Search</button> -->

      <!-- Button trigger modal -->
      <button type="button" class="btn btn-outline-dark shadow me-lg-3 me-2" data-bs-toggle="modal" data-bs-target="#loginmodal">
      Login 
      </button>

      <button type="button" class="btn btn-outline-dark shadow me-lg-3 me-2" data-bs-toggle="modal" data-bs-target="#registermodal">
      Register 
      </button>


    </form>

  </div>

</div>
</nav>
<!--------------------------- Navigation Bar ends --------------------------->

<!----------------------------LOGIN Modal ------------------------------>
<div class="modal fade" id="loginmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
    <form action="">
      <div class="modal-header">
          
          <h5 class="modal-title d-flex align-items-center" >
              <i class="bi bi-person-circle fs-3 me-2"></i>
              User Login
          </h5>
          <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>


      <div class="modal-body">
        <div class="mb-3">
            <label  class="form-label">Email address</label>
            <input type="email" class="form-control shadow-none" >

        </div>
        <div class="mb-3">
            <label  class="form-label">Password</label>
            <input type="password" class="form-control shadow-none" >

        </div>

        <div class="d-flex align-items-center justify-content-between mb-2 ">

            <button type="submit" class="btn btn-dark shadow-none">LOGIN</button>
            <a href="javascript: void(0)" class="text-secondary text-decoration-none"> Forgot Password?</a>
        </div>
      </div>
      
    </form>
  </div>
</div>
</div>
<!-----------------------------Login Modal ENDS -------------------------------->

<!--------------------------- Register Modal  --------------------------------->
<div class="modal fade" id="registermodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog modal-lg">
    <div class="modal-content">
      <form action="">
        <div class="modal-header">
            
            <h5 class="modal-title d-flex align-items-center" >
                <i class="bi bi-person-circle fs-3 me-2"></i>
                Register User 
            </h5>
            <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>


        <div class="modal-body">
        

          <span class="badge bg-light text-dark  mb-3 text-wrap lh-base">
            Note : Details filled here must match with Id card (For College Student).
          </span>

          <div class="container-fluid">
            <div class="row ">
                <div class="col-md-6 ps-0 mb-3">
                  <label  class="form-label">First Name</label>
                  <input name ="firstname" type="text" class="form-control shadow-none" required>

                </div>

                <div class="col-md-6 ps-0 mb-3">
                  <label  class="form-label">Last Name</label>
                  <input name ="lastname" type="text" class="form-control shadow-none"  >

                </div>

                <div class="col-md-6 ps-0 mb-3">
                  <label  class="form-label">Email</label>
                  <input name ="email" type="email" class="form-control shadow-none" required >
                </div>

                <div class="col-md-6 ps-0 mb-3">
                  <label  class="form-label">Phone Number</label>
                  <input name ="phone" type="number" class="form-control shadow-none" required>

                </div>

                <div class="col-md-6 ps-0 mb-3">
                  <label class="form-label">Are you a campus resident?</label>
                  <select name="resident" class="form-control shadow-none" required>
                      <option value="" disabled selected>Select an option</option>
                      <option value="yes">Yes</option>
                      <option value="no">No</option>
                  </select>
                </div>

                <div class="col-md-6 ps-0 mb-3">
                  <label class="form-label">Select One</label>
                  <select name="designation" class="form-control shadow-none" required>
                      <option value="" disabled selected>Select an option</option>
                      <option value="student">Student</option>
                      <option value="staff">Staff</option>
                      <option value="professor">Professor</option>
                      <option value="visitor">Visitor</option>
                      <option value="employee">Employee</option>
                      <option value="other">Others</option>
                  </select>
                </div>

                <div class="col-md-6 ps-0 mb-3">
                  <label  class="form-label">( If Student ) Upload ID Card</label>
                  <input name ="idcard" type="file" class="form-control shadow-none" >
                </div>


                <div class="col-md-6 ps-0 mb-3">
                  <label  class="form-label">Date Of Birth</label>
                  <input name ="dob" type="date" class="form-control shadow-none" required>
                </div>

                <div class="col-md-6 ps-0 mb-3">
                  <label  class="form-label">Password</label>
                  <input name ="pass" type="password" class="form-control shadow-none" required>
                </div>

                <div class="col-md-6 ps-0 mb-3">
                  <label  class="form-label">Confirm Password</label>
                  <input name ="cpass" type="password" class="form-control shadow-none" required>
                </div>
                

                <div class="text-center">
                  <button type="submit" class="btn btn-dark shadow-none">REGISTER</button>
                  
                </div>

                

            </div>
          </div>
        </div>


        
      </form>
    </div>
  </div>

</div>
<!---------------------- Register Modal Ends ---------------------------->