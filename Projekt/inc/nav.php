<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
$current_page = basename($_SERVER['PHP_SELF']);

?>
<div class="container">
  <header class="navbar navbar-expand-md navbar-light bg-light py-3 mb-2 border-bottom">
    <div class="container-fluid">
      <a class="navbar-brand" href="./index.php">
        <img src="./Pictures/Icon.png" alt="Sonnenschuss-Logo" width="110" height="60">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarContent">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
        <li class="nav-item"><a href="./index.php" class="nav-link <?php echo $current_page == 'index.php' ? 'active' : ''; ?>">Home</a></li>
          <li class="nav-item"><a href="./news.php" class="nav-link <?php echo $current_page == 'news.php' ? 'active' : ''; ?>">News</a></li>
          <li class="nav-item"><a href="./pictures.php" class="nav-link <?php echo $current_page == 'pictures.php' ? 'active' : ''; ?>">Pictures</a></li>
          <li class="nav-item"><a href="./FAQ.php" class="nav-link <?php echo $current_page == 'FAQ.php' ? 'active' : ''; ?>">FAQ</a></li>
          <li class="nav-item"><a href="./impressum.php" class="nav-link <?php echo $current_page == 'impressum.php' ? 'active' : ''; ?>">Imprint</a></li>
        </ul>
        <?php if ((isset(($_SESSION["loggedin"]))) && ($_SESSION["loggedin"])) : ?>
          <div class="d-flex align-items-center">
            <a href="./reservation.php" class="btn btn-primary me-3">New Reservation</a>
            <div class="dropdown">
              <a href="#" id="dropdownUser1" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16" alt="User Settings" aria-label="User Settings">
                  <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"></path>
                  <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"></path>
                </svg>
              </a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                <li><a class="dropdown-item" href="./usersettings.php">Settings</a></li>
                <li><a class="dropdown-item" href="./reservation-list.php">Reservations</a></li>
                <li><a class="dropdown-item" href="./logout.php">Sign out</a></li>
              </ul>
            </div>
          </div>
        <?php else : ?>
          <div class="d-flex">
            <a href="./login.php" class="btn btn-outline-primary me-2">Login</a>
            <a href="./registration.php" class="btn btn-primary">Sign-Up</a>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </header>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</div>
