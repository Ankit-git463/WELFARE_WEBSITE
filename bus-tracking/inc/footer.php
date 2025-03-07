<!-------------------------------Footer ------------------------------------------>

  <div class="container-fluid border-top custom-light" id="footer" style="margin-top: 90px; padding-bottom:50px; padding-top:40px ;" >
    <div class="container mt-100 pt-50">
    
      <div class="row" style="font-weight: 400 ;">

        <div class="col-12 col-md-6 col-lg-4  center-block" style="font-weight: 400 ;" >
          <h3 style="font-weight: 800;" >QUICK Links</h3>
          <ul style="font-weight: 400;">
            <li><a href="#" id="quicks"><span class="fa fa-commenting"></span> DASHBOARD</a></li>
            <li><a href="emergency_contacts.php" id="quicks"><span class="fa fa-globe"></span> Emergency Contacts</a></li>
            <li><a href="#" id="quicks"><span class="fa fa-bookmark"></span> eAcademics</a></li>
            <li><a href="#" id="quicks"><span class="fa fa-envelope"></span> Webmail</a></li>
            <li><a href="#" id="quicks"><span class="fa fa-book"></span> Moodle</a></li>
            <li><a href="#" id="quicks"><span class="fa fa-paperclip"></span> NGU</a></li>
            <li><a href="#" id="quicks"><span class="fa fa-phone"></span> IITP Helpline</a></li>
          </ul>
        </div>
        
        <div class="col-12 col-md-6 col-lg-4 center-block">

          <h3 style="font-weight: 600;">Feedback</h3>
          <p>Please give us your suggestions and feedback.<br /> Constructive criticism is well appreciated.<br /><span class="fa fa-pencil"></span>  <a href="">Click here</a> for the feedback form.</p>
          <h3 style="font-weight: 600;">SWB Constitution</h3>
          <p><span class="fa fa-external-link"></span>  <a href="#">Read </a>Our constitution</p>

        </div>

        <div class="col-12 col-md-12 col-lg-4 center-block">
          <p>
            <strong>Follow SWB : </strong>
            <a href="#"><span class="fa fa-facebook-square fa-lg"></span></a>
            <a href="#"><span class="fa fa-instagram fa-lg mx-2">  </span></a>
            <a  href="#"><span id="elm" class="fa fa-envelope fa-lg">  </span></a>
          </p>

          <p style="z-index: 214748364799"><strong >Website Created and Maintained by:</strong><br />
            <span class="fa fa-code"></span><a href="https://www.linkedin.com/in/ankit-singh-42731b250/">Ankit Singh</a></br>
           
          </p>

          <h3>&copy; SWB 2024</h3>
          <p>All rights reserved.</p>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script>

      function alert(type, msg , position="body") {
        let bs_class = (type == 'success') ? 'alert-success' : 'alert-danger' ;
        let element = document. createElement('div');
        element. innerHTML =`
            <div class="alert ${bs_class} alert-dismissible fade show custom-alert" role="alert" >
                <strong class="me-3">${msg} </strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;

        document.body. append(element);

        if (position == 'body'){
            document.body.append(element);
            element.classList.add('customer-alert');
        }

        else{
            document.getElementById(position).appendChild(element); 
        }

        setTimeout(remAlert , 2000);
      }

      function remAlert(){
          document.getElementsByClassName('alert')[0].remove();
      }

      let register_form = document.getElementById('register_form');
      let alertBox = document.getElementById('alert-box');

      register_form.addEventListener('submit' , (e) =>{
        e.preventDefault();
        // prevents reload of  the page while submitting the page 
        // allows to handle form submission using JS

        let data  = new FormData();

        data.append('firstname' , register_form.elements['firstname'].value);
        data.append('lastname' , register_form.elements['lastname'].value);
        data.append('email' , register_form.elements['email'].value);
        data.append('phone' , register_form.elements['phone'].value);
        data.append('resident' , register_form.elements['resident'].value);
        data.append('designation' , register_form.elements['designation'].value);
        data.append('dob' , register_form.elements['dob'].value);
        data.append('pass' , register_form.elements['pass'].value);
        data.append('cpass' , register_form.elements['cpass'].value);
        data.append('idcard' , register_form.elements['idcard'].files[0]);
        data.append('register', '');

        var myModal = document.getElementById('registermodal');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        let xhr = new XMLHttpRequest();
        xhr.open("POST" , "ajax/register.php");
        console.log("DATA POSTED");


        xhr.onload = function(){
          
          let response = this.responseText.trim(); // Clean up the response text
          if (response === 'success') {
              alertBox.innerHTML = `
                  <div class="alert alert-success custom-alert alert-dismissible fade show" role="alert">
                      Registration successful! 
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>`;
              register_form.reset(); // Reset the form after successful registration
          } else if (response === 'pass_mismatch') {
              alertBox.innerHTML = `
                  <div class="alert alert-warning custom-alert alert-dismissible fade show" role="alert">
                      Password mismatch! Please make sure both passwords match.
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>`;
          } else if (response === 'email_or_phone_exists') {
              alertBox.innerHTML = `
                  <div class="alert alert-warning custom-alert alert-dismissible fade show" role="alert">
                      Email or phone number already exists.
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>`;
          } else if (response === 'insert_failed') {
              alertBox.innerHTML = `
                  <div class="alert alert-danger custom-alert alert-dismissible fade show" role="alert">
                      Registration failed! Please try again later.
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>`;
          } else {
              alertBox.innerHTML = `
                  <div class="alert alert-danger custom-alert alert-dismissible fade show" role="alert">
                      Error: ${response}
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>`;
          }
        }
        xhr.send(data);
        
        
        
      })


      let login_form = document.getElementById('login_form');
      
      login_form.addEventListener('submit' , (e) =>{
        e.preventDefault();

        let data  = new FormData();
        data.append('email' , login_form.elements['email'].value);
        data.append('pass' , login_form.elements['pass'].value);
        data.append('login', '');

        var myModal = document.getElementById('loginmodal');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        let xhr = new XMLHttpRequest();
        xhr.open("POST" , "ajax/login.php");
        console.log("DATA POSTED");


        xhr.onload = function(){
          
          let response = this.responseText.trim(); // Clean up the response text
          console.log(response);
          if (response === 'success') {
              alertBox.innerHTML = `
                  <div class="alert alert-success custom-alert alert-dismissible fade show" role="alert">
                      Welcome !!! 
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>`;
              register_form.reset(); // Reset the form after successful registration
          } else if (response === 'invalid_pass') {
              alertBox.innerHTML = `
                  <div class="alert alert-warning custom-alert alert-dismissible fade show" role="alert">
                      Password mismatch! Please make sure both passwords match.
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>`;
          } else if (response === 'invalid_credentials') {
              alertBox.innerHTML = `
                  <div class="alert alert-danger custom-alert alert-dismissible fade show" role="alert">
                      Either email or password is wrong.
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>`;
          } else if (response === 'login_failed') {
              alertBox.innerHTML = `
                  <div class="alert alert-danger custom-alert alert-dismissible fade show" role="alert">
                      Login failed! Please try again later.
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>`;
          } else {
              alertBox.innerHTML = `
                  <div class="alert alert-danger custom-alert alert-dismissible fade show" role="alert">
                      Error: ${response}
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>`;
          }
        }
        xhr.send(data);
        
        
        
      })


    </script>
<!-------------------------------Footer ends-------------------------------------->