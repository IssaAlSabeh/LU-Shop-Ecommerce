<?php
    session_start();
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if(isset($_SESSION["usersId"])){
        if(isset($_GET["pid"])){
            $pid = $_GET['pid'];
            addToCart($conn,$pid);
        }else{
            header("Location: ../index.php?error=notthroughform");
            exit();
        }
    }else{
        header('Location: ../login.php');
        exit();
    }