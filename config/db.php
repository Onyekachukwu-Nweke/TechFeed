<?php
    ob_start(); //Turns on output buffering
    session_start(); // This acts as a buffer
    
    $timezone = date_default_timezone_set("Africa/Lagos");

    $con = mysqli_connect("localhost", "root", "", "social");

    if(mysqli_connect_errno()){
        echo "Connection Failed" . mysqli_error($con);
    }
?>