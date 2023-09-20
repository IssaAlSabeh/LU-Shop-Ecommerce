<?php
    session_start();
    require_once 'dbh.inc.php';

    if(isset($_GET['product_id']) && isset($_GET['archive'])){
        $product = $_GET["product_id"];
        $ar = $_GET["archive"];

        $sql = "UPDATE Products SET archive = $ar WHERE product_id = ?";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ../index.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt,"s",$product);
        mysqli_stmt_execute($stmt);
        header('Location: ../index.php?status=product_deleted');
    }else{
        header('Location: ../index.php');
    }
?>