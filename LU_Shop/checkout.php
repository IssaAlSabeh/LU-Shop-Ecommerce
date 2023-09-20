<?php
    session_start();
    require_once 'includes/dbh.inc.php';
    require_once 'includes/functions.inc.php';
    onlyUsers("login.php","index.php");

    makeOrder($conn);
    emptyCart($conn);
