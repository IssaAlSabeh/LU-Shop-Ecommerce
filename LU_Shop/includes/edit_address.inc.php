<?php
    session_start();
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if(isset($_POST['submit'])){

        if(emptyInput($_POST)){
            header("Location: ../edit_address.php?error=emptyInput");
            exit();
        }

        $city = $_POST['city'];
        $area = $_POST['area'];
        $street = $_POST['street'];
        $building = $_POST['building'];
        $floor = $_POST['floor'];

        updateAddress($conn,$city,$area,$street,$building,$floor);
    }
    else{
        header("Location: ../index.php");
        exit();
    }