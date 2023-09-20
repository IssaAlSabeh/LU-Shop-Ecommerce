<?php
    
    // Sign Up Page Functions

    function emptyInputSignup($name,$email,$username,$pwd,$pwdrepeat,$city,$street,$area,$building,$floor){
        $result = false;
        if(empty($name) || empty($email) || empty($username) || empty($pwd) || empty($pwdrepeat) || empty($city) || empty($area) || empty($street) || empty($building) || empty($floor)){
            $result = true;
        }
        return $result;
    }

    function invalidname($name){
        $result = false;
        if(!preg_match("/^[a-zA-Z ]*$/",$name)){
            $result = true;
        }
        return $result;
    }

    function invalidUsername($username){
        $result = false;
        if(!preg_match("/^[a-zA-Z0-9]*$/",$username)){
            $result = true;
        }
        return $result;
    }

    function invalidEmail($email){
        $result = false;
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $result = true;
        }
        return $result;
    }

    function invalidPhone($phone){
        $result = false;
        if(!preg_match("/^[0-9]{8}$/",$phone)){
            $result = true;
        }
        return $result;
    }

    function usernameExists($conn,$username,$email){
        $result = false;
        $sql = "SELECT * FROM Users WHERE usersUsername = ? OR usersEmail = ?;";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../signup.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt,"ss",$username,$email);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);

        if($row = mysqli_fetch_assoc($resultData)){
            return $row;
        }else{
            return $result;
        }
    }

    function passwordmismatch($pwd,$pwdrepeat){
        $result = false;
        if($pwd !== $pwdrepeat){
            $result = true;
        }
        return $result;
    }

    function createUser($conn,$name,$email,$phone,$username,$pwd,$city,$street,$area,$building,$floor){
        $sql = "INSERT INTO users (usersName,usersEmail,usersPhone,usersUsername,usersPwd,usersRole,usersCity,usersArea,usersStreet,usersBuilding,usersFloor) VALUES (?,?,?,?,?,'User',?,?,?,?,?);";
        $stmt = mysqli_stmt_init($conn);
        
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ../signup.php?error=stmtfailed");
            exit();
        }

        $hashedpwd = password_hash($pwd,PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt,"sssssssssi",$name,$email,$phone,$username,$hashedpwd,$city,$street,$area,$building,$floor);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("Location: ../login.php?message=accountCreated");
        exit();
    }

    // Log In page functions

    function emptyInputLogin($username,$pwd){
        $result = false;
        if(empty($username) || empty($pwd)){
            $result = true;
        }
        return $result;
    }

    function loginUser($conn,$username,$pwd){
        $usernameExists = usernameExists($conn,$username,$username);

        if($usernameExists === false){
            header("Location: ../login.php?error=usernamenotfound");
            exit();
        }

        $hashedPwd = $usernameExists['usersPwd'];
        $pwdCheck = password_verify($pwd,$hashedPwd);

        if($pwdCheck === false){
            header("Location: ../login.php?error=wrongpassword");
            exit();
        }else if($pwdCheck === true) {
            session_start();
            $_SESSION['usersId'] = $usernameExists['usersId'];
            $_SESSION['usersName'] = $usernameExists['usersName'];
            $_SESSION['usersEmail'] = $usernameExists['usersEmail'];
            $_SESSION['usersUsername'] = $usernameExists['usersUsername'];
            $_SESSION['usersPhone'] = $usernameExists['usersPhone'];
            $_SESSION['usersRole'] = $usernameExists['usersRole'];
            $_SESSION['usersCity'] = $usernameExists['usersCity'];
            $_SESSION['usersArea'] = $usernameExists['usersArea'];
            $_SESSION['usersStreet'] = $usernameExists['usersStreet'];
            $_SESSION['usersBuilding'] = $usernameExists['usersBuilding'];
            $_SESSION['usersFloor'] = $usernameExists['usersFloor'];
            header("Location: ../index.php");
            exit();
        }
    }

    // Contact Us page functions
    function emptyInputContact($name,$email,$subject,$message){
        $result = false;
        if(empty($name) || empty($email) || empty($subject) || empty($message)){
            $result = true;
        }
        return $result;
    }

    // Add to cart page functions
    function addToCart($conn,$pid){
        $user = $_SESSION["usersId"]; // getting the username of the current user

        $sql = "SELECT * FROM Cart WHERE product_id = ? AND userId = ?;"; // testing if the user already has that item in his cart
        $stmt = mysqli_stmt_init($conn);
        
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ../index.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt,"ss",$pid,$user);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        if(mysqli_fetch_assoc($resultData)){
            $sql = "UPDATE Cart SET quantity = quantity + 1 WHERE product_id = ? AND userId = ?;";
            $stmt = mysqli_stmt_init($conn);
        
            if(!mysqli_stmt_prepare($stmt,$sql)){
                header("Location: ../index.php?error=stmtfailed");
                exit();
            }
            mysqli_stmt_bind_param($stmt,"ss",$pid,$user);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            header("Location: ../index.php?message=itemAdded");

        }
        
        else{
            $sql = "SELECT * FROM products WHERE product_id = ?;"; 
            
            if(!mysqli_stmt_prepare($stmt,$sql)){
                header("Location: index.php?error=stmtfailed");
                exit();
            }

            mysqli_stmt_bind_param($stmt,"i",$pid);
            mysqli_stmt_execute($stmt);
            $resultData = mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);

            if(!($row = mysqli_fetch_assoc($resultData))){
                header("Location: ../index.php?error=productNotFound");
                exit();
            }


            $sql = "INSERT INTO Cart (userId, product_id, quantity) VALUES (?,?,?);";
            $stmt = mysqli_stmt_init($conn);
        
            if(!mysqli_stmt_prepare($stmt,$sql)){
                header("Location: ../index.php?error=stmtfailed");
                exit();
            }
            $q = 1;
            mysqli_stmt_bind_param($stmt,"ssi",$user,$pid,$q);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            header("Location: ../index.php?message=itemAdded");
            exit();
        }
    }

    function getPhone($conn,$pname){
        $sql = "SELECT usersPhone FROM Users WHERE usersUsername in (SELECT product_owner FROM products WHERE product_name = ?);"; // testing if the user already has that item in his cart
        $stmt = mysqli_stmt_init($conn);
        
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ../index.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt,"s",$pname);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($resultData);
        return $row["usersPhone"];
    }

    function editProduct($conn,$pid){
        $sql = "SELECT * FROM products WHERE product_id = ?;"; // testing if the user already has that item in his cart
        $stmt = mysqli_stmt_init($conn);
        
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: index.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt,"i",$pid);
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);

        if($row = mysqli_fetch_assoc($resultData))
            return $row;
        else
            return false;
    }

    function updateQuantity($conn,$product_id,$quantity){
        $usersId = $_SESSION["usersId"];
        $sql = "UPDATE CART SET quantity = ? WHERE product_id = ? AND userId = ?";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: cart.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt,"iii",$quantity,$product_id,$usersId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header('Location: ../cart.php');
    }

    function removeFromCart($conn,$product_id){
        $usersId = $_SESSION["usersId"];
        $sql = "DELETE FROM CART WHERE product_id = ? AND userId = ?";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: cart.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt,"ii",$product_id,$usersId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header('Location: ../cart.php');
    }

    function isLogged(){
        if(isset($_SESSION["usersId"])){
            return true;
        }return false;
    }

    function isAdmin(){
        if(isLogged() && $_SESSION["usersRole"] == "Admin"){
            return true;
        }return false;
    }

    function isUser(){
        if(isLogged() && $_SESSION["usersRole"] == "User"){
            return true;
        }return false;
    }

    function onlyUsers($guestDestination,$adminDestination){
        if(!isUser()){
            if(!isLogged()){  
                header("Location: $guestDestination?x=$x");
            }
            else if(isAdmin()){
                header("Location: $adminDestination");
                
            }
            exit();
        }
    }

    function onlyAdmin($guestDestination,$userDestination){
        if(!isAdmin()){
            if(!isLogged())  
                header("Location: $guestDestination");
            else if(isUser())
                header("Location: $userDestination");
            exit();
        }
    }

    function onlyLogged($destination){
        if(!isLogged()){
            header("Location: $destination");
            exit();
        }
    }

    function getAddress($conn){
        $uid = $_SESSION["usersId"];
        $sql = "SELECT usersCity, usersArea, usersStreet, usersBuilding, usersFloor FROM users WHERE usersId = ?;"; 
        $stmt = mysqli_stmt_init($conn);
        
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: index.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt,"i",$uid);
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);

        if($row = mysqli_fetch_assoc($resultData))
            return $row;
        else
            return false;
    }

    function updateAddress($conn,$city,$area,$street,$building,$floor){
        $uid = $_SESSION["usersId"];
        $sql = "UPDATE users SET usersCity = ?, usersArea = ?, usersStreet = ?, usersBuilding = ?, usersFloor = ? WHERE usersId = ?;";
        $stmt = mysqli_stmt_init($conn);
        
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ../edit.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt,"ssssii",$city,$area,$street,$building,$floor,$uid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("Location: ../cart.php");
    }

    function emptyInput($arr){
        foreach($arr as $key=>$i){
            if(empty($i)){
                return $key;
            }
        }
        return false;
    }

    function emptyCart($conn){
        $usersId = $_SESSION["usersId"];
        $sql = "DELETE FROM CART WHERE userId = ?";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: cart.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt,"i",$usersId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header('Location: cart.php?message=orderSent');
    }

    function loadCartItems($conn){
         
        $customer = $_SESSION["usersId"];
        $sql = "SELECT P.product_id,product_name,product_price,product_image,quantity FROM cart AS C,products AS P WHERE C.product_id = P.product_id AND userId = ?;";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: cart.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt,"s",$customer);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);
        $resultCheck = mysqli_num_rows($resultData);

        

        if($resultCheck > 0){
            $totalsum = 0;
            while($row = mysqli_fetch_assoc($resultData))
            {
                $imagesrc = $row['product_image'];
                $total = $row['product_price'] * $row['quantity'];
                echo "  
                <form action='includes/updatequantity.inc.php' method='post'>
                    <div class='cart-item'>
                            <span><img src='images/$imagesrc' alt='$imagesrc'></span>
                            <span>".$row['product_name']."</span>
                            <span><input class='update-input' type='number' id='quantity' name='quantity'  value=".$row['quantity']." required></span>
                            <input type='hidden' name='productid'  value=".$row['product_id']." required>
                            <span>".$row['product_price']."$</span>
                            <span class='red'>$total$</span>
                            <span><button class='update-btn' type='submit' name='submit' value='update'>Update</button></span>
                            <span><button class='remove-btn' type='submit' name='submit' value='remove'>Remove</button></span>
                        </div>
                </form>
                ";
                $totalsum = $totalsum + $total;
            }
            echo "
                <div class='cart-item'>
                    
                    <span>Total</span>
                    <span class='red'>$totalsum$</span>
                    <span></span>
                    <span><a href='edit_address.php'><button class='editItem_button'>Edit Address</button></a></span> <br> <br>
                    <span><a href='checkout.php'><button class='addToCart_button'>Check Out</button></a></span>
                </div>
            ";

        }else{
            echo "<h1 class='totalprice'>Your Cart is Empty</h1>";
        }
        
    }

    function makeOrder($conn){

        // making a new order in the order tabel - without total
        $uid = $_SESSION["usersId"];

        $sql = "INSERT INTO orders (user_id, order_date, status) VALUES (?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: cart.php?error=stmtfailed");
            exit();
        }
        $st = "pending";
        $dt = date("Y-m-d");
        mysqli_stmt_bind_param($stmt,"iss",$uid,$dt,$st);
        mysqli_stmt_execute($stmt);
        $orderId = mysqli_insert_id($conn);
        
        // getting the items in the cart and inserting them into the cart item table
        $sql = "SELECT P.product_id,product_price,quantity FROM cart AS C,products AS P WHERE C.product_id = P.product_id AND userId = ?;";

        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: cart.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt,"i",$uid);
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);
        $resultCheck = mysqli_num_rows($resultData);

        if($resultCheck > 0){
            $totalsum = 0;
            while($row = mysqli_fetch_assoc($resultData))
            {
                $pid = $row['product_id'];
                $pprice = $row['product_price'];
                $pquantity = $row['quantity'];
                $total = $row['product_price'] * $row['quantity'];

                $sql2 = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?);";

                if(!mysqli_stmt_prepare($stmt,$sql2)){
                    header("Location: cart.php?error=stmtfailed");
                    exit();
                }

                mysqli_stmt_bind_param($stmt,"iiii",$orderId,$pid,$pquantity,$pprice);
                mysqli_stmt_execute($stmt);
                $totalsum = $totalsum + $total;
            }
        }

        //update total price

        $sql = "UPDATE orders SET total_price = ? WHERE order_id = ?;";
        $stmt = mysqli_stmt_init($conn);
        
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ../edit.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt,"ii",$totalsum,$orderId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }  

    function loadOrders($conn,$st){
        $uid = $_SESSION["usersId"];

        $sql = "SELECT order_id,user_id,total_price,order_date FROM orders WHERE status = '$st';";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: cart.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);
        $resultCheck = mysqli_num_rows($resultData);

        if($resultCheck > 0){
            while($row = mysqli_fetch_assoc($resultData))
            {
                echo "
                        <div class='pending-order'>
                ";
                $userId = $row["user_id"];
                $R_orderId = $row["order_id"];
                $R_total_price = $row["total_price"];
                $R_date = $row["order_date"];

                $sql = "SELECT usersName,usersCity,usersArea, usersStreet, usersBuilding, usersFloor, usersPhone FROM users WHERE usersId = $userId;";
                if(!mysqli_stmt_prepare($stmt,$sql)){
                    header("Location: cart.php?error=stmtfailed");
                    exit();
                }
                
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $info = mysqli_fetch_assoc($result);

                $R_usersName = $info["usersName"];
                $R_usersCity = $info["usersCity"];
                $R_usersArea = $info["usersArea"];
                $R_usersStreet = $info["usersStreet"];
                $R_usersBuilding = $info["usersBuilding"];
                $R_usersFloor = $info["usersFloor"];
                $R_usersPhone = $info["usersPhone"];
                echo "
                    <span class='center'>Order Id: $R_orderId</span>
                    <span class='center'>Order Date: $R_date</span>
                    <br>
                    <span class='red'>Customer Information</span>
                    <span>Customer Name: $R_usersName</span>
                    <span>Contact Number: $R_usersPhone</span>
                    <br>
                    <span class='red'>Customer Address</span>
                    <span>City: $R_usersCity</span>
                    <span>Area: $R_usersArea</span>
                    <span>Street: $R_usersStreet</span>
                    <span>Building: $R_usersBuilding</span>
                    <span>Floor: $R_usersFloor</span>
                    <br>
                    <span class='red'>Order Items</span>
                    <br>
                ";

                $sql = "SELECT quantity, product_name, price FROM order_items AS oi JOIN products AS p ON oi.product_id = p.product_id WHERE order_id = $R_orderId;";
                if(!mysqli_stmt_prepare($stmt,$sql)){
                    header("Location: cart.php?error=stmtfailed");
                    exit();
                }
                
                mysqli_stmt_execute($stmt);
                $items = mysqli_stmt_get_result($stmt);
                    echo "<table>
                            <tr>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                            </tr>
                ";
                while($item = mysqli_fetch_assoc($items)){
                    $price = $item['price'];
                    $quantity = $item['quantity'];
                    $pname = $item['product_name'];

                    echo "
                        <tr>
                            <td>$pname</td>
                            <td>$quantity</td>
                            <td>$price$</td>
                        </tr>
                    ";
                    
                    
                }
                echo "
                    </table>
                    <br>
                    <span class='center red big'>Total: $R_total_price$</span>
                    <br>
                    ";
                    if($st == 'pending'){
                        echo "<a href='includes/completeOrder.inc.php?oid=$R_orderId'><button class='addToCart_button'>Order Complete</button></a>";
                    }
                    echo "</div>";

            }
            

        }else{
            if($st == 'pending'){
                echo "<h1 class='totalprice'>No Pending Orders</h1>";
            }else{
                echo "<h1 class='totalprice'>No Completed Orders</h1>";
            }
        }
    }

