<?php
    require_once 'dbh.inc.php';
    if(isset($_GET['oid'])){
        $oid = $_GET['oid'];
        $sql = "UPDATE orders SET status = 'completed' WHERE order_id = ?;";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ../index.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt,"i",$oid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("Location: ../pending_orders.php?message=orderComplete");
    }