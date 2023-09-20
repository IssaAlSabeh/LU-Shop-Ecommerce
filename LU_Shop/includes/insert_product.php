<?php
    session_start();
    require_once 'dbh.inc.php';
    
    if (isset($_POST['submit'])) {
        $imageFolder = "C:\\xampp\\htdocs\\PHP_Project\\images";
        $name = $_POST['productname'];
        $price = $_POST['productprice'];
        $user = $_SESSION['usersUsername'];
        $details = $_POST['productdetails'];

        foreach($_FILES as $file_name => $file_array){
        $arr = explode(".",$file_array['name']);
        $ext = $arr[sizeof($arr)-1];
        $image = uniqid() . "." . $ext;
            if(is_uploaded_file($file_array["tmp_name"])){
                move_uploaded_file($file_array["tmp_name"],"$imageFolder/$image") or die("Couldn't copy");
            }
        }

        $sql = "INSERT INTO products (product_name, product_price, product_image, added_by, product_details) VALUES (?,?,?,?,?);";
        $stmt = mysqli_stmt_init($conn);
        
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ../add_product.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt,"sssss",$name,$price,$image,$user,$details);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("Location: ../index.php");
        exit();
    }

    
?>