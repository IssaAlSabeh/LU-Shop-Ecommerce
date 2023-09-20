<?php
    include_once 'header.php';
    require_once 'includes/dbh.inc.php';
    require_once 'includes/functions.inc.php';

    onlyUsers("login.php","index.php");

    $row = getAddress($conn);

    $usersCity = $row['usersCity'];
    $usersArea = $row['usersArea'];
    $usersStreet = $row['usersStreet'];
    $usersBuilding = $row['usersBuilding'];
    $usersFloor = $row['usersFloor'];
?>

    <div class="login-form">
        <form action="includes/edit_address.inc.php" method="post">
            <label for="city">City:</label>
            <input type="text" id="city" name="city" value='<?php echo $usersCity ?>' required>
            <label for="=area">Area:</label>
            <input type="text" id="area" name="area"  value='<?php echo $usersArea?>' required>
            <label for="street">Street:</label>
            <input type="text" id="street" name="street"  value='<?php echo $usersStreet?>' required>
            <label for="building">Building:</label>
            <input type="text" id="building" name="building"  value='<?php echo $usersBuilding?>' required>
            <label for="floor">Floor:</label>
            <input type="number" id="floor" name="floor"  value='<?php echo $usersFloor?>' required>
            <button type="submit" name="submit" value="update">UPDATE</button>
            <?php
                    if(isset($_GET['error'])){
                        if($_GET['error'] === 'emptyInput'){
                            echo "<p class='signup-error'>Fill all fields</p>";
                        }
                    }
                    ?>
        </form>
    </div>
  </body>
</html>

