<?php 
    require('inc/essentials.php');
    adminLogin();
    
?> 

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Settings</title>
   <?php require('inc/links.php'); ?> 
</head>
<body class="bg-white">


    <?php require('inc/header.php'); ?> 
    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                
                <h3 class="mb-4">SETTINGS</h3>
                <!-- General settings section -->
                <div class="card border-0 shadow-sm mb-4">
                   <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">General Settings</h5>
                            
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#general-s">
                                <i class= "bi bi-pencil-square"></i> Edit
                            </button>


                        </div>
                        
                        <h6 class="card-subtitle mb-1 fw-bold">Site Title</h6>
                        <p class="card-text" id="site_title">Content</p>
                        <h6 class="card-subtitle mb-1 fw-bold" >About us </h6>
                        <p class="card-text" id="site_about"  >Content </p>
                    </div>
                </div>

                <!------------- Modal ------------->
                <div class="modal fade" id="general-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form >
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" >General Setting</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                
                                <div class="modal-body">
                                    <div class=" mb-3">
                                        <label  class="form-label">Site Title</label>
                                        <input id="site_title_inp"  type="text" name= "site_title" class="form-control shadow-none" >

                                    </div>

                                    <div class=" mb-3">
                                        <label  class="form-label">About</label>
 
                                        <textarea id="site_about_inp"  class="form-control" name="site_about" id="exampleFormControlTextarea1" rows="6"></textarea>

                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <button type="button" onclick ="site_title.value = general_data.site_title , site_about.value = general_data.site_about" class="btn btn-secondary" data-bs-dismiss="modal">CANCEL</button>
                                    <button type="button" onclick= "upd_general(site_title.value , site_about.value)" class="btn custom-bg text-white shadow-none ">SUBMIT</button>
                                </div>
                            </div>
                        </form>
                            
                    </div>
                </div>

                <!------------- Shutdown ----------->
                <div class="card">
                   <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">General Settings</h5>
                            
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#general-s">
                                <i class= "bi bi-pencil-square"></i> Edit
                            </button>


                        </div>
                        <p class="card-text" > </p>
                    </div>
                </div>
            </div>

        </div>

    </div>
    

    <?php require('inc/scripts.php'); ?> 

    <script>
        let general_data;

        function get_general(){
            let site_about = document.getElementById('site_about');
            let site_title=  document.getElementById('site_title');
            let site_about_inp = document.getElementById('site_about_inp');
            let site_title_inp=  document.getElementById('site_title_inp');



            let xhr = new XMLHttpRequest();
            xhr.open("POST","ajax/settings_crud.php", true);
            xhr. setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function(){            
                try {
                    general_data= JSON.parse(xhr.responseText);
                } 
                
                catch (e) {
                    console.error("Error parsing JSON: ", e);
                    console.error("Response was: ", xhr.responseText);
                }
                site_title.innerText = general_data.site_title;
                site_about.innerText = general_data.site_about;
        
                site_title_inp.value = general_data.site_title;
                site_about_inp.value = general_data.site_about;
            }

            xhr.send('get_general');
        }
        
        function upd_general(site_title_val, site_about_val ){
            let xhr = new XMLHttpRequest();
            xhr.open("POST","ajax/settings_crud.php", true);
            xhr. setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function(){

                var myModal = document. getElementById('general-s');
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide(); 
                console.log(this.responseText);

                if(this.responseText == 1 ){
                    alert('success' , 'Changes Saved!'); 
                    console.log('data updated');
                    get_general();
                }
                else {
                    alert('error' , 'No changes saved!'); 
                    console.log('No changes Made');
                }

            }

            xhr.send('site_title='+site_title_val +'&site_about='+site_about_val+'&upd_general' );
            
        }

        window.onload = function(){
            get_general();
        }
    </script>
    
   
</body>
</html>