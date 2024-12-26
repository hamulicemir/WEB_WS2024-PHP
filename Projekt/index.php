<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Landing-Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="index.stylesheet.css" rel="stylesheet">
</head>

<body>
  <div class="header">
  </div>
  <?php include './inc/nav.php'; ?>

  <div class="card text-bg-dark">
    <img src="./Pictures/d67617b8-8107-4487-90d1-9b61dea0b0df.webp" class="card-img-fluid" alt="Hotel">
    <div class="container d-flex justify-content-center align-items-center vh-100">

      <div class="text-center">
        <div class="card-img-overlay">
          <h1 class="card-title">Welcome to Sonnen-Schuss Hotel</h1>
          <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
        </div>
      </div>
    </div>
  </div>
 

  <footer class="footer">
  <div class="container">
  <footer class="py-1 my-1">
    <ul class="nav justify-content-center border-bottom pb-1 mb-1">
      <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">News</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">FAQs</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Impressum</a></li>
    </ul>
    <p class="text-center text-muted">© 2024 Sonnen-Schuss Hotel</p>
  </footer>
</div>
 
</body>

</html>