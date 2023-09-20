<?php
    include_once 'header.php';
    require_once 'includes/dbh.inc.php';
    require_once 'includes/functions.inc.php';
    onlyUsers("login.php","index.php");
?>
<main class="main-div">
    <?php
        if(isset($_GET['error'])){
            echo "
                    <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                ";
            if($_GET['error'] === 'emptyQuantity'){
                echo "<strong>Enter a quantity!</strong>";
            }
            else if($_GET['error'] === 'negativeQuantity'){
                echo "<strong>Quantity should be positive!</strong>";
            }
            echo "
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                ";
        }

        if(isset($_GET['message'])){
            echo "
                    <div class='alert alert-success alert-dismissible fade show' role='alert'>
                ";
            if($_GET['message'] === 'orderSent'){
                echo "<strong>Your order was submitted successfully!</strong>";
            }
            echo "
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                ";
        }
    ?>
    <div class="cart-products">

            <div class="cart-item">
                <span>Item</span>
                <span>Name</span>
                <span>Quantity</span>
                <span>Price</span>
                <span>Total</span>
                <span></span>
                <span></span>
            </div>


    <?php
        loadCartItems($conn);
    ?>
    </div>
</main>
        

</body>
</html>