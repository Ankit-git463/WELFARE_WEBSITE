<?php 
    $hname = 'localhost';
    $uname = 'root' ; 
    $pass = 'iitpatna' ; 

    $db = 'swb'; 

    $conn= mysqli_connect($hname , $uname ,$pass , $db ,3307) ; 


    if (!$conn ){
        die("Cannot connect to the database".mysqli_connect_error()) ; 
    }
?>