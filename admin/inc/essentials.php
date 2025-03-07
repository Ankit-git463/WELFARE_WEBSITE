<?php 

    function adminLogin(){
        session_start();
        if (!(isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] == true)){
            echo"<script>
                window.location.href='index.php' ; 
            </script>";
        }
        session_regenerate_id(true);
    }

    function driverLogin(){
        session_start();
        if (!(isset($_SESSION['driverLogin']) && $_SESSION['driverLogin'] == true)){
            echo"<script>
                window.location.href='driverlogin.php' ; 
            </script>";
        }
        session_regenerate_id(true);
    }

    function redirect($url){
        echo"<script>
            window.location.href='$url' ; 
        </script>";

    }
    function alert($type , $msg ){
        $bs_class = ($type == "success") ? "alert-success" : "alert-danger" ; 
        echo <<<alert
        <div class="alert $bs_class alert-dismissible fade show custom-alert" role="alert">
            <strong class="me-3">$msg</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">LOG OUT</button>
        </div>
        alert;
    }

    function uploadUserImage($image){

        $valid_mime = ['image/jpeg','image/png','image/webp'];
        $img_mime = $image['type'];

        if(!in_array($img_mime,$valid_mime)){
            return 'inv_img'; //invalid image mime or format
        }
        else{
            $ext = pathinfo($image['name'],PATHINFO_EXTENSION);
            $rname = 'IMG_'.random_int(11111,99999).".jpeg";

            $img_path = UPLOAD_IMAGE_PATH.USERS_FOLDER.$rname;

            if($ext == 'png' || $ext =='PNG'){
                $img = imagecreatefrompng($image['tmp_name']);
            }

            else if ($ext == 'webp' || $ext == 'webp'){
                $img = imagecreatefromwebp($image['tmp_name']);
            }

            else {
                $img = imagecreatefromjpeg($image['tmp_name']);

            }

            if(imagejpeg($img , $img_path , 75  )){
                return $rname;
            }
            else{
                return 'upd_failed';
            }
        }
    }





?> 