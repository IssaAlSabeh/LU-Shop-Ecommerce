<?php
    $dbservername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbdatabase = "mydb";
    
    $conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbdatabase);
    $conn->set_charset("utf8");
    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }