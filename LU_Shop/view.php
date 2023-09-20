    <?php
      include_once 'header.php';
    ?>

    <main class="main-div">
      <?php
      $pid = $_GET['pid'];
      $pname = $_GET['pname'];
      $pprice = $_GET['pprice'];
      $pimage = $_GET['pimage'];
      $pdetails = $_GET['pdetails'];
      echo "
        <div class='product_details'>
              <img src='$pimage'>
              <div class='info-item'>
                <p class='product_details_title'>Product Name:</p>
                <p class='product_details_info'>$pname</p>
                <p class='product_details_title'>Price:</p>
                <p class='product_details_info'>$pprice$</p>
                <p class='product_details_title'>Product Details:</p>
                <p class='product_details_info'>".$pdetails."</p>
              ";
          if(isset($_SESSION["usersRole"]))
          {
            if($_SESSION["usersRole"] == "User"){
              echo "<a href='includes/addtocart.inc.php?pid=$pid'><button class='addToCart_button'>Add to Cart</button></a>";
            }else{
              echo "<a href='edit.php?pid=$pid'><button class='editItem_button'>Edit Item</button></a>";
            }
          }
        echo"
            </div>
          </div>
          ";
      ?>
    </main>
  </body>
</html>
