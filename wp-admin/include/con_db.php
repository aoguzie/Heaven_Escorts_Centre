<?php

    //DEV
    $conn = mysqli_connect("localhost","root","","escort");
    
    //Live
    //$conn = mysqli_connect("localhost","thaigery_escorts","YOchtyeI9fKk3xFy","thaigery_escorts");

    // Check connection
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }

    @mysqli_query($conn,"SET NAMES UTF8");
?>