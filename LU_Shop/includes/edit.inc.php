<?php
    require_once 'dbh.inc.php';

    if(isset($_POST['productid'])){
        $id = $_POST['productid'];
        $name = $_POST['productname'];
        $price = $_POST['productprice'];
        $details = $_POST['productdetails'];

        $sql = "UPDATE products SET product_name = ?, product_price = ?, product_details = ? WHERE product_id = ?;";
        $stmt = mysqli_stmt_init($conn);
        
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ../edit.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt,"sisi",$name,$price,$details,$id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("Location: ../index.php");
    }
    else{
        header("Location: ../index.php");
        exit();
    }