<!DOCTYPE html>
<html lang="de">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./reservation.stylesheet.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <title>Reservation Management</title>
</head>

<body>
  <?php include './inc/nav.php'; ?>
  <div class="d-flex justify-content-center align-items-center mt-5">
    <div class="container">
      <div class="row gutters-sm justify-content-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-body">
              <h1 class="text-center mb-4">Manage Reservations</h1>

              <?php if (isset($errorMsg)): ?>
                <div class="alert alert-danger" role="alert">
                  <?php echo $errorMsg; ?>
                </div>
              <?php endif; ?>

              <?php if (isset($successMsg)): ?>
                <div class="alert alert-success" role="alert">
                  <?php echo $successMsg; ?>
                </div>
              <?php endif; ?>

              <form method="POST">
                <div class="form-floating mb-3">
                  <input type="date" class="form-control" id="checkin" name="checkin" required>
                  <label for="checkin">Check-in Date</label>
                </div>
                <div class="form-floating mb-3">
                  <input type="date" class="form-control" id="checkout" name="checkout" required>
                  <label for="checkout">Check-out Date</label>
                </div>
                <div class="form-check mb-3">
                  <input type="checkbox" class="form-check-input" id="breakfast" name="breakfast">
                  <label class="form-check-label" for="breakfast">Breakfast</label>
                </div>
                <div class="form-check mb-3">
                  <input type="checkbox" class="form-check-input" id="parking" name="parking">
                  <label class="form-check-label" for="parking">Parking</label>
                </div>
                <div class="form-check mb-3">
                  <input type="checkbox" class="form-check-input" id="pets" name="pets">
                  <label class="form-check-label" for="pets">Pets</label>
                </div>
                <div class="form-floating mb-3">
                  <select class="form-select" id="room" name="room" required>
                    <option value="SingleBed">Single Bed</option>
                    <option value="TwoBed">Two Bed</option>
                    <option value="Penthouse">Penthouse Suite</option>
                  </select>
                  <label for="room">Room Type</label>
                </div>
                
                <div class="d-flex justify-content-between mt-4">
                <button type="reset" class="btn btn-light">Reset Changes</button>
                  <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#checkModal">Save Changes</button>
                  
             
                </div>
              </form>

              <!-- Modal for Save Changes -->
              <div class="modal fade" id="checkModal" tabindex="-1" aria-labelledby="checkModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Save Changes?</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">Do you want to save the changes?</div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include './inc/footer.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
