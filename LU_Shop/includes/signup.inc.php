<?php
    if(isset($_POST['submit'])){

        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $username = $_POST['username'];
        $pwd = $_POST['pwd'];
        $pwdrepeat = $_POST['pwdRepeat'];
        $city = $_POST['city'];
        $area = $_POST['area'];
        $street = $_POST['street'];
        $building = $_POST['bldng'];
        $floor = $_POST['floor'];

        require_once 'dbh.inc.php';
        require_once 'functions.inc.php';

        if(emptyInputSignup($name,$email,$username,$pwd,$pwdrepeat,$city,$street,$area,$building,$floor) !== false){
            header("Location: ../signup.php?error=emptyinput");
            exit();
        }

        if(invalidEmail($email) !== false){
            header("Location: ../signup.php?error=invalidemail");
            exit();
        }

        if(invalidPhone($phone) !== false){
            header("Location: ../signup.php?error=invalidphone");
            exit();
        }

        if(invalidUsername($username) !== false){
            header("Location: ../signup.php?error=invalidusername");
            exit();
        }

        if(usernameExists($conn,$username,$email) !== false){
            header("Location: ../signup.php?error=usernametaken");
            exit();
        }

        if(passwordmismatch($pwd,$pwdrepeat) !== false){
            header("Location: ../signup.php?error=passwordmismatch");
            exit();
        }

        createUser($conn,$name,$email,$phone,$username,$pwd,$city,$street,$area,$building,$floor);

    }else{
        header("Location: ../signup.php");
        exit();
    }