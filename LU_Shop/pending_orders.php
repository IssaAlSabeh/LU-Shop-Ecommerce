    <?php
      include_once 'header.php';
      require_once 'includes/functions.inc.php';
      require_once 'includes/dbh.inc.php';
      onlyAdmin("login.php","index.php");
    ?>

    <main class="main-div">
      
      <?php 
        if(isset($_GET['message'])){
              echo "
                      <div class='alert alert-success alert-dismissible fade show' role='alert'>
                  ";
              if($_GET['message'] === 'orderComplete'){
                  echo "<strong>Order packaging is complete and is on its way to the customer!</strong>";
              }
              echo "
                          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                      </div>
                  ";
          }
        loadOrders($conn,"pending"); 
      ?>
    </main>  
  </body>
</html>
