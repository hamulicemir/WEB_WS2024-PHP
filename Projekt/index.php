<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome to Sonnen-Schuss Hotel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
  <?php include './inc/nav.php'; ?>
  <div class="position-relative vh-100 mb-5">
    <img src="./Pictures/d67617b8-8107-4487-90d1-9b61dea0b0df.webp" class="img-fluid w-100 h-100" alt="Hotel" style="object-fit: cover;">
    <div class="card-img-overlay d-flex justify-content-start align-items-center">
      <div class="bg-dark bg-opacity-75 text-white p-5 rounded">
        <h2 class="fst-italic display-3">Welcome to Hotel</h2>
        <h1 class="fw-bold display-1">Sonnen-Schuss</h1>
      </div>
    </div>
  </div>
  <hr>
  <div class="container-fluid d-flex align-items-center mb-5 mt-5"> <!-- mt-5 hinzugefügt -->
      <div class="row w-100">
        <div class="col-12 col-md-6 p-0">
          <div id="carouselExampleControls" class="carousel slide h-100" data-bs-ride="carousel">
            <div class="carousel-inner h-100">
              <div class="carousel-item active h-100">
                <img src="./Pictures/pexels-enginakyurt-2736388.jpg" class="d-block w-100 h-100" alt="First slide" style="object-fit: cover;">
              </div>
              <div class="carousel-item h-100">
                <img src="./Pictures/room-3475665_1920.jpg" class="d-block w-100 h-100" alt="Second slide" style="object-fit: cover;">
              </div>
              <div class="carousel-item h-100"> 
                <img src="./Pictures/bed-4416515_1920.jpg" class="d-block w-100 h-100" alt="Third slide" style="object-fit: cover;">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </a>
          </div>
        </div>
        <div class="col-12 col-md-6 d-flex justify-content-center align-items-center bg-opacity-75 text-dark p-5 rounded text-end">
          <div>
            <hr> <!-- Horizontale Linie über dem Text -->
            <br>
            <h2 class="fst-italic display-5">Our Suites</h2>
            <p class="lead">"Experience comfort and style in our thoughtfully designed rooms. Each room offers cozy beds, private bathrooms, and modern amenities to ensure a relaxing and enjoyable stay for all our guests."</p>
            <br>
            <hr> <!-- Horizontale Linie unter dem Text -->
          </div>
        </div>
      </div>
    </div>
  <hr>
  <div class="container-fluid mt-5 mb-5">
    <div class="row">
      <div class="col-12 col-md-4 mb-4">
        <img src="./Pictures/restaurant-1837150_1920.jpg" class="img-fluid rounded" alt="Photo 1">
      </div>
      <div class="col-12 col-md-4 mb-4"> 
        <img src="./Pictures/pexels-enginakyurt-3019019.jpg" class="img-fluid rounded" alt="Photo 2">
      </div>
      <div class="col-12 col-md-4 mb-4">
        <img src="./Pictures/pexels-mart-production-9565921.jpg" class="img-fluid rounded" alt="Photo 3">
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-12 text-center">
        <p class="lead">"Enjoy our exquisite dining options, best koktels, and local made wine ."</p> <!-- Neue Unterschrift hinzugefügt -->
      </div>
    </div>
  </div>
  <?php include './inc/footer.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+3oB7j1o5y5r1b7+AMvyTG2x1p5r" crossorigin="anonymous"></script>
</body>
</html>