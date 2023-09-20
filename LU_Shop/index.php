<?php
include_once 'header.php';
require_once 'includes/functions.inc.php';
?>
    <main class="main-div">
       <?php
            if(isset($_GET['message'])){
                echo "
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                    ";
                if($_GET['message'] === 'itemAdded'){
                    echo "<strong>Item added to cart!</strong>";
                }
                echo "
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    ";
            }

            else if(isset($_GET['error'])){
                echo "
                        <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    ";
                if($_GET['error'] === 'productToEditNotFound'){
                    echo "<strong>Product to edit not found (Wrong product ID)</strong>";
                }
                else if($_GET['error'] === 'productNotFound'){
                    echo "<strong>Product not found (Wrong product ID)</strong>";
                }
                echo "
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    ";
            }
        ?>
      <div id="Products">
        <?php
          require_once 'includes/dbh.inc.php';
          
            $sql = "SELECT * FROM Products;";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            if($resultCheck > 0)
            {
              while($row = mysqli_fetch_assoc($result))
              {
                $pid = urlencode($row['product_id']);
                $pname = urlencode($row['product_name']);
                $pprice = urlencode($row['product_price']);
                $pimage = urlencode($row['product_image']);
                $pdetails = urlencode($row['product_details']);
                $archive = $row['archive'];
                if($archive) continue;
                echo "
                <div class='Product'>
                  <div class='image'>
                   <img class='image__img' src='images/$pimage' alt='$pname'> 
                   <a href='view.php?pid=$pid&pname=$pname&pprice=$pprice&pimage=images/$pimage&pdetails=$pdetails'> <div class='image__overlay'>View Product</div> </a>
                  </div>
                  <div class='Product-info'>
                    <span class='Product-name'>".urldecode($pname)."</span>
                    <span class='Product-price'>".urldecode($pprice)."$</span>
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
              }
            }
            
        ?>
      </div>
    </main>
  </body> 
</html>
