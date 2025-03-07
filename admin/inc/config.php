<?php 
    $hname = 'localhost';
    $uname = 'root' ; 
    $pass = 'iitpatna' ; 

    $db = 'swb'; 

    $conn = mysqli_connect($hname , $uname ,$pass , $db ,3307) ; 


    if (!$conn ){
        die("Cannot connect to the database".mysqli_connect_error()) ; 
    }


    // data filteration
    function filteration($data){
        foreach($data as $key => $value){
            $data[$key] = trim($value);
            $data[$key] = stripcslashes($value);
            $data[$key] = htmlspecialchars($value);
            $data[$key] = strip_tags($value);
        }

        return $data ;
    }
    function select($sql, $values, $datatypes){
        
        $conn = $GLOBALS['conn'];
        if($stmt = mysqli_prepare($conn, $sql)){
        
            mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
            if(mysqli_stmt_execute($stmt)){
                $res = mysqli_stmt_get_result($stmt);
                mysqli_stmt_close($stmt);
                return $res;
            }
        
            else{
                mysqli_stmt_close($stmt);
                die("Query cannot be executed - Select");
            }
        }
        else {
            die("Query cannot be prepared - Select");
        }
    } 
    function update($sql, $values, $datatypes){
        
        $conn = $GLOBALS['conn'];
        if($stmt = mysqli_prepare($conn, $sql)){
        
            mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
            if(mysqli_stmt_execute($stmt)){
                $res = mysqli_stmt_affected_rows($stmt);
                mysqli_stmt_close($stmt);
                return $res; // count of rows affected
            }
        
            else{
                mysqli_stmt_close($stmt);
                die("Query cannot be executed - Update");
            }
        }
        else {
            die("Query cannot be prepared - Update");
        }
    } 

    function uploadImage($image){
        $valid_mime = ['image/jpeg' , 'image/png' , 'image/webp'];
        $image_mime = $image['type'];
        
        if (!in_array($image_mime , $valid_mime)){
            return 'inv_img';
        }

        else{
            $ext = pathinfo($image['name'] , PATHINFO_EXTENSION);
            $rname = 'IMG_'.random_int(11111,99999).".jpeg" ; 

            $img_path= UPLOAD_IMAGE_PATH.USERS_FOLDER.$rname; 

            if ($ext == 'png' || $ext=='PNG'){
                $img = imagecreatefrompng($image['temp_name']);
            }
            else if ($ext == 'webp' || $ext=='WEBP'){
                $img = imagecreatefromwebp($image['temp_name']);
            }
            else {
                $img = imagecreatefromjpeg($image['temp_name']);
            }


            if(imagejpeg($img ,$img_path , 75 )){
                return $rname;
            }

            else {
                return 'upd_failed';
            }
        }
    }

 
?> 