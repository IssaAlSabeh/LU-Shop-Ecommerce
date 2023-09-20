        <?php
            include_once 'header.php';
            require_once 'includes/dbh.inc.php';
            require_once 'includes/functions.inc.php';
            onlyAdmin("login.php","index.php");
        ?>
        <main class="main-div">
            <div class="cart-products">
                    <div class="cart-item">
                        <span>All Items</span>
                    </div>

                    <div class="cart-item">
                        <span>Item</span>
                        <span>Name</span>
                        <span>Price</span>
                        <span></span>
                    </div>
            <?php
                if(isset($_SESSION["usersUsername"])){
                    $customer = $_SESSION["usersUsername"];
                    $sql = "SELECT product_id,product_name,product_price,product_image,archive FROM Products";
                    $stmt = mysqli_stmt_init($conn);
            
                    if(!mysqli_stmt_prepare($stmt,$sql)){
                        header("Location: index.php?error=stmtfailed");
                        exit();
                    }
                    mysqli_stmt_execute($stmt);
            
                    $resultData = mysqli_stmt_get_result($stmt);
                    $resultCheck = mysqli_num_rows($resultData);
            
                    
            
                        if($resultCheck > 0){
            
                            while($row = mysqli_fetch_assoc($resultData))
                            {
                                $imagesrc = $row['product_image'];
                                $archive = $row['archive'];
                                if($archive == 0){
                                    $archive = 1;
                                    $str = "Archive Item";
                                    $c = "remove-btn";

                                }else{
                                    $archive = 0;
                                    $str = "Unarchive Item";
                                    $c = "archive-btn";
                                }
                                echo "  
                                    <div class='cart-item'>
                                        <span><img src='images/$imagesrc' alt='$imagesrc'></span>
                                        <span>".$row['product_name']."</span>
                                        <span>".$row['product_price']."$</span>
                                        <span><a href='includes/remove_product.php?archive=$archive&product_id=".$row['product_id']."'><button class='$c'>$str</button></a></span>
                                    </div>
                                ";
                            }
                        }else{
                            echo "<h1 class='totalprice'>You haven't posted any items yet!</h1>
                                <p class='anc center'><a href='add_product.php'>Click here to post a product.</a></p>
                            ";
                        }
            
            
                }else{
                    header("Location: login.php");
                    exit();
                }
            ?> 
            
            
            </div>
        </main>
    </body>
</html>

