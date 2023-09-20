<?php
    include_once 'header.php';
    require_once 'includes/dbh.inc.php';
    require_once 'includes/functions.inc.php';

    onlyAdmin("login.php","index.php");

    if(!isset($_GET['pid'])){
        header("Location: index.php?error=noItemToEdit");
    }

    

    $row = editProduct($conn,$_GET['pid']);
    if($row == false){
        header("Location: index.php?error=productToEditNotFound");
        exit();
    }

    $pid = $row['product_id'];
    $pname = $row['product_name'];
    $pprice = $row['product_price'];
    $pdetails = $row['product_details'];
?>

    <div class="login-form">
        <form action="includes/edit.inc.php" method="post">
            <input type="hidden" id="productid" name="productid" value=<?php echo $pid?>>
            <label for="productname">Product Name:</label>
            <input type="text" id="productname" name="productname" value='<?php echo $pname ?>' required>
            <label for="productprice">Product Price:</label>
            <input type="number" id="productprice" name="productprice"  value=<?php echo $pprice?> required>
            <label for="productdetails">Product Details:</label>
            <textarea type="textarea" id="productdetails" name="productdetails" required><?php echo $pdetails?></textarea>
            <button type="submit" name="submit">UPDATE</button>
        </form>
    </div>
  </body>
</html>

