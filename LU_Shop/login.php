<?php
  include_once 'header.php';
  if(isset($_SESSION["usersId"])){
    header("Location: index.php");
  }
?>
    <main class='main-div'>
        <?php
            if(isset($_GET['error'])){
                echo "
                        <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    ";
                if($_GET['error'] === 'emptyinput'){
                    echo "<strong>Fill out all fields!</strong>";
                }
                else if($_GET['error'] === 'usernamenotfound'){
                    echo "<strong>Invalid Username!</strong>";
                }
                else if($_GET['error'] === 'wrongpassword'){
                    echo "<strong>Invalid Password!</strong>";
                }
                else if($_GET['error'] === 'stmtfailed'){
                    echo "<strong>An error occurred!</strong>";
                }
                echo "
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    ";
            }
        ?>

        <div class="login-form">
            <form action="includes/login.inc.php" method="post">
                    <h1>Login</h1>
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" required>
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" required>
                    <button type="submit" name="submit">Login</button>
            </form>
        </div>

    </main>

</body>
</html>

