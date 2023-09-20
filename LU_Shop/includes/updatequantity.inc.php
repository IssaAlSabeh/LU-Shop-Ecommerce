<?php
    session_start();
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if(isset($_POST['submit'])){
        $product_id = $_POST['productid'];
        if($_POST['submit'] == 'update'){    
            $quantity = $_POST['quantity'];
            if(empty($quantity)){
                header('Location: ../cart.php?error=emptyQuantity');
                exit();
            }elseif($quantity <= 0){
                header('Location: ../cart.php?error=negativeQuantity');
                exit();
            }
            updatequantity($conn,$product_id,$quantity);
        }
        else{
            removeFromCart($conn,$product_id);
        }

    }
    else{
        header('Location: ../cart.php');
    }