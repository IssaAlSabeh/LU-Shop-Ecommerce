<?php
  include_once 'header.php'; 
  require_once 'includes/functions.inc.php';
  onlyAdmin("login.php","index.php");

?>

    <div class="login-form">
        <form action="includes/insert_product.php" method="post" enctype="multipart/form-data">
            <label for="productname">Product Name:</label>
            <input type="text" id="productname" name="productname" required>
            <label for="productprice">Product Price:</label>
            <input type="number" id="productprice" name="productprice" required>
            <label for="productdetails">Product Details:</label>
            <textarea type="textarea" id="productdetails" name="productdetails" required></textarea>
            <label for="productimage">Upload Product Image:</label>
            <input type="file" id="productimage" name="productimage" accept="image/png, image/jpeg" required>
            <button type="submit" name="submit">Add Product</button>
        </form>
    </div>
  </body>
</html>



