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
  <div class="container-fluid vh-100 d-flex align-items-center mb-5 mt-3"> <!-- mt-3 hinzugefügt -->
    <div class="row w-100">
      <div class="col-12 col-md-6 p-0">
        <img src="./Pictures/pexels-enginakyurt-2736388.jpg" class="img-fluid w-100 h-100" alt="Hotel">
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
  <?php include './inc/footer.php'; ?>
</body>
</html>