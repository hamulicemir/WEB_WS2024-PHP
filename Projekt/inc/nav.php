<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>
<div class="container">
  <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-2 border-bottom">
    <div class="col-md-3 mb-2 mb-md-0">
      <img src="./Pictures/Icon.png" alt="Logo" width="110" height="60">
    </div>

    <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
      <li><a href="./index.php" class="nav-link px-2">Home</a></li>
      <li><a href="./news.php" class="nav-link px-2">News</a></li>
      <li><a href="./pictures.php" class="nav-link px-2">Pictures</a></li>
      <li><a href="./FAQ.php" class="nav-link px-2">FAQ</a></li>
      <li><a href="./impressum.php" class="nav-link px-2">Imprint</a></li>
    </ul>
    <?php if ((isset(($_SESSION["loggedin"]))) && ($_SESSION["loggedin"])) : ?>
      <div class="col-md-3 text-end mr-auto d-flex align-items-center">
        <a href="./reservation.php"><button type="button" class="btn btn-primary me-3">New Reservation</button></a>
        <div class="dropdown">
          <a href="" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <!-- Insert Dropdown button with bootstrap-->
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
              <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"></path>
              <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"></path>
            </svg>
          </a>
          <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="./usersettings.php">Settings</a></li>
            <li><a class="dropdown-item" href="./reservation-list.php">Reservations</a></li>
            <li><a class="dropdown-item" href="./logout.php">Sign out</a></li>
          </ul>
        </div>
      </div>
    <?php else : ?>
      <div class="col-md-3 text-end">
        <a href="./login.php"><button type="button" class="btn btn-outline-primary me-2">Login</button></a>
        <a href="./registration.php"><button type="button" class="btn btn-primary">Sign-Up</button></a>
      </div>
    <?php endif; ?>
  </header>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</div>