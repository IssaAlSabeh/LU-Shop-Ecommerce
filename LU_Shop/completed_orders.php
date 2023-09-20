    <?php
      include_once 'header.php';
      require_once 'includes/functions.inc.php';
      require_once 'includes/dbh.inc.php';
      onlyAdmin("login.php","index.php");
    ?>

    <main class="main-div">
      <?php loadOrders($conn,"completed"); ?>
    </main>  
  </body>
</html>
