<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <script defer src="js/script.js"></script>
    <title>Project</title>
  </head>
  <body>
    <nav>
        <a href="index.php" title="Products">Products</a>
        <?php
            if(isset($_SESSION['usersId'])){
                if($_SESSION['usersRole'] == 'Admin'){
                    echo "<a href='add_product.php' title='Add Item'>Add Item</a>";
                    echo "<a href='all_items.php' title='All Items'>All Items</a>";
                    echo "<a href='pending_orders.php' title='Pending Orders'>Pending Orders</a>";
                    echo "<a href='completed_orders.php' title='Completed Orders'>Completed Orders</a>";
                }elseif ($_SESSION['usersRole'] == 'User') {
                    echo "<a href='cart.php' title='My Cart'>My Cart</a>";
                    echo "<a href='about.php' title='About Us'>About Us</a>";
                }
                echo "<a class='floatright' href='includes/logout.inc.php' title='Log Out'>Log Out</a>";
                echo "<p class='floatright'>".$_SESSION['usersName']."</p>";
            }else{
                echo "<a class='floatright' href='signup.php' title='Sign Up'>Sign Up</a>";
                echo "<a class='floatright' href='login.php' title='Log In'>Log In</a>";
            }
            
        ?>
    </nav>