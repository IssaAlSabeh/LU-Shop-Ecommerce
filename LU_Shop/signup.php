<?php
    include_once 'header.php';
    require_once 'includes/functions.inc.php';
    if(isLogged()){
        header("Location: index.php");
    }
?>
    <main class="main-div">
        <?php
            if(isset($_GET['error'])){
                echo "
                        <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    ";
                if($_GET['error'] === 'emptyinput'){
                    echo "<strong>Fill out all fields!</strong>";
                }
                else if($_GET['error'] === 'invalidemail'){
                    echo "<strong>Invalid Email!</strong>";
                }
                else if($_GET['error'] === 'invalidphone'){
                    echo "<strong>Invalid phone number, it should only consist of 8 digits!</strong>";
                }
                else if($_GET['error'] === 'invalidusername'){
                    echo "<strong>Invalid Username!</strong>";
                }
                else if($_GET['error'] === 'usernametaken'){
                    echo "<strong>Username or email already taken!</strong>";
                }
                else if($_GET['error'] === 'passwordmismatch'){
                    echo "<strong>Passwords do not match!</strong>";
                }
                else if($_GET['error'] === 'invalidname'){
                    echo "<strong>Invalid Name!</strong>";
                }
                else if($_GET['error'] === 'stmtfailed'){
                    echo "<strong>Something went wrong!</strong>";
                }
                echo "
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    ";
            }
        ?>
        <div class="login-form">
            <form action="includes/signup.inc.php" method="post">
                    <h1>Sign Up</h1>
                    <label for="name">Full Name:</label>
                    <input type="text" name="name" id="name" required>
                    <label for="email">Email:</label>
                    <input type="email" name="email" id ="email"required>
                    <label for="phone">Phone Number:</label>
                    <input type="text" name="phone" id ="phone"required>
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" required>
                    <label for="pwd">Password:</label>
                    <input type="password" name="pwd" id="pwd" required>
                    <label for="pwdRepeat">Repeat Password:</label>
                    <input type="password" name="pwdRepeat" id="pwdRepeat" required>
                    <label for="city">City:</label>
                    <input type="text" name="city" id="city" required>
                    <label for="area">Area:</label>
                    <input type="text" name="area" id="area" required>
                    <label for="street">Street:</label>
                    <input type="text" name="street" id="street" required>
                    <label for="bldng">Building Name:</label>
                    <input type="text" name="bldng" id="bldng" required>
                    <label for="floor">Floor:</label>
                    <input type="number" name="floor" id="floor" required>
                    <button type="submit" name="submit">Sign Up</button>
                    
            </form>
        </div>
    </main>
</body>
</html>
