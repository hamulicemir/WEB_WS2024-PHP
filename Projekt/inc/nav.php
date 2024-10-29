<?php 
  session_start();
?>
<div class="container">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-2 border-bottom">
          <div class="col-md-3 mb-2 mb-md-0">
              <img src="./Pictures/Icon.svg" alt="Logo" width="110" height="60">            
          </div>
    
          <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            <li><a href="./index.php" class="nav-link px-2">Home</a></li>
            <li><a href="./pictures.php" class="nav-link px-2">Pictures</a></li>
            <li><a href="./FAQ.php" class="nav-link px-2">FAQs</a></li>
            <li><a href="./impressum.php" class="nav-link px-2">Impressum</a></li>
          </ul>
          <?php if(!$_SESSION["loggedin"]) : ?>
          <div class="col-md-3 text-end">
            <a href="./login.php"><button type="button" class="btn btn-outline-primary me-2">Login</button></a>
            <a href="./registration.php"><button type="button" class="btn btn-primary">Sign-Up</button></a>
          </div>
          <?php else : ?>
            <div class="col-md-3 text-end">
            <?php echo $_SESSION["Session_Email"]?>
            <a href="./logout.php"><button type="button" class="btn btn-primary ms-3">Log-Out</button></a>
          </div>
          <?php endif; ?>
        </header>
    </div>
</div>