<?php
    if(isset($_POST['submit'])){
        $city = $_POST['city'];
        $area = $_POST['area'];
        $street = $_POST['street'];
        $building = $_POST['building'];
        $floor = $_POST['floor'];

        require_once 'dbh.inc.php';
        require_once 'functions.inc.php';

        if(emptyInputDelivery($city,$area,$street,$building,$floor) !== false){
            header("Location: ../checkout.php?error=emptyinput");
            exit();
        }
        else if(validCreditCard($cardNb) != false){
            $var = validCreditCard($cardNb);
            header("Location: ../checkout.php?error=InvalidCreditCard?dtls=$var");
            exit();
        }
        else if(validDate($expiryDate) !== false){
            header("Location: ../checkout.php?error=InvalidDate");
            exit();
        }


        loginUser($conn,$username,$pwd);
    }
    else{
        header("Location: ../login.php");
        exit();
    }