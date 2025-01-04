<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

include './inc/dbconnection.php';
include './inc/functions.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['UserInformation']['Role_ID'] != 1) {
  header('location: index.php');
  exit;
}

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  header('location: login.php');
  exit;
}
if (!$conn) {
  die("Database Connection Failed: " . mysqli_connect_error());
}


global $reservationdata;

$user_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$errors = [];

if ($user_id > 0) {
  $stmt = $conn->prepare("SELECT * FROM Reservation WHERE User_ID = ?");
  $stmt->bind_param("s", $user_id);
  $stmt->execute();
  $result = $stmt->get_result();
  $reservationdata = $result->fetch_assoc();
  $stmt->close();

  $stmt = $conn->prepare("SELECT * FROM User WHERE User_ID = ?");
  $stmt->bind_param("s", $user_id);
  $stmt->execute();
  $result = $stmt->get_result();
  $userdata = $result->fetch_assoc();
  $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $checkin = sanitize_input($_POST["checkin"]);
  $checkout = sanitize_input($_POST["checkout"]);
  $breakfast = isset($_POST["breakfast"]) ? 1 : 0;
  $parking = isset($_POST["parking"]) ? 1 : 0;
  $pets = isset($_POST["pets"]) ? 1 : 0;
  $room = sanitize_input($_POST["room"]);
  switch ($room) {
    case 1:
      $roomNo = 1;
      break;
    case 2:
      $roomNo = 2;
      break;
    case 3:
      $roomNo = 3;
      break;
  }

  $updates = [];

    if ($checkin != $reservationdata['Start_Date']) {
      if (strtotime($checkin) < strtotime(date('Y-m-d'))) {
          $errors[] = "Check-in date must be after today.";
      } elseif (strtotime($checkout) <= strtotime($checkin)) {
          $errors[] = "Check-out date must be after the check-in date.";
      } else {
          $updates['Start_Date'] = $checkin;
      }
  }
  
  if ($checkout != $reservationdata['End_Date']) {
      if (strtotime($checkout) <= strtotime($checkin)) {
          $errors[] = "Check-out date must be after the check-in date.";
      } else {
          $updates['End_Date'] = $checkout;
      }
  }

  if ($breakfast != $reservationdata['Breakfast']) {
    $updates['Breakfast'] = $breakfast;
  }
  if ($parking != $reservationdata['Parking']) {
    $updates['Parking'] = $parking;
  }
  if ($pets != $reservationdata['Pets']) {
    $updates['Pets'] = $pets;
  }
  if ($roomNo != $reservationdata['Room_ID']) {
    $updates['Room_ID'] = $roomNo;
  }

  if (!empty($updates)) {
    foreach ($updates as $column => $value) {
      $stmt = $conn->prepare("UPDATE Reservation SET $column = ? WHERE User_ID = ?");
      $stmt->bind_param('ss', $value, $user_id);
      $stmt->execute();
      $stmt->close();
    }
    $AdminUpdated = true;
  } else {
    $AdminUpdated = false;
  }
}
?>
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
              <form action="reservation_management.php?id=<?php echo $user_id ?>" method="POST">
                <div class="form-floating mb-3">
                  <input type="date" class="form-control" id="checkin" name="checkin" value="<?php echo $reservationdata['Start_Date'] ?>" required>
                  <label for="checkin">Check-in Date</label>
                </div>
                <div class="form-floating mb-3">
                  <input type="date" class="form-control" id="checkout" name="checkout" value="<?php echo $reservationdata['End_Date'] ?>" required>
                  <label for="checkout">Check-out Date</label>
                </div>
                <div class="form-check mb-3">
                  <input type="checkbox" class="form-check-input" id="breakfast" name="breakfast" <?php if ($reservationdata['Breakfast'] == 1) echo "checked" ?>>
                  <label class="form-check-label" for="breakfast">Breakfast</label>
                </div>
                <div class="form-check mb-3">
                  <input type="checkbox" class="form-check-input" id="parking" name="parking" <?php if ($reservationdata['Parking'] == 1) echo "checked" ?>>
                  <label class="form-check-label" for="parking">Parking</label>
                </div>
                <div class="form-check mb-3">
                  <input type="checkbox" class="form-check-input" id="pets" name="pets" <?php if ($reservationdata['Pets'] == 1) echo "checked" ?>>
                  <label class="form-check-label" for="pets">Pets</label>
                </div>
                <?php
                $roomID = $reservationdata['Room_ID'];
                switch ($roomID) {
                  case 1:
                    $room = "SingleBed";
                    break;
                  case 2:
                    $room = "TwoBed";
                    break;
                  case 3:
                    $room = "Suite";
                    break;
                }
                ?>
                <div class="form-floating mb-3">
                  <select class="form-select" id="room" name="room" required> <?php //SELCECTED 
                                                                              ?>
                    <option value="SingleBed" <?php if ($room === 'SingleBed') echo "selected" ?>>Single Bed</option>
                    <option value="TwoBed" <?php if ($room === 'TwoBed') echo "selected" ?>>Two Bed</option>
                    <option value="Suite" <?php if ($room === 'Suite') echo "selected" ?>>Penthouse Suite</option>
                  </select>
                  <label for="room">Room Type</label>
                </div>

                <div class="d-flex justify-content-between mt-4">
                  <button type="reset" class="btn btn-light">Reset Changes</button>
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#SaveChangesModal">Save Changes</button>

                  <div class="modal fade" id="SaveChangesModal" tabindex="-1"
                    aria-labelledby="SaveChangesModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Save Changes?</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          Do you want to save the changes?
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" id="SaveChangesButton" class="btn btn-primary">Save Changes</button>
                        </div>
                      </div>
                    </div>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
      <div class="modal-dialog ">
        <div class="modal-content">
          <div class="modal-body">
          You have successfully updated the data!
          </div>
        </div>
      </div>
    </div>
    </div>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
      <?php if (isset($AdminUpdated) && $AdminUpdated === true): ?>
        var successModal = new bootstrap.Modal(document.getElementById('successModal'));
        successModal.show();
        setTimeout(function () {
          window.location.href = 'user_management.php?id=<?php echo $user_id ?>';
        }, 1500);
        <?php $AdminUpdated = false; // Reset ?>
      <?php endif; ?>
    });
  </script>

  <!-- Error Modal -->
  <div class="modal fade" id="ErrorUserSettingsModal" tabindex="-1" aria-labelledby="ErrorUserSettingsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
          The following issues occurred during the data update:
          <?php
          foreach ($errors as $error) {
            echo "<li>" . sanitize_input($error) . "</li>";
          }
          ?>
        </div>
      </div>
    </div>
  </div>
  </div>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      <?php if (isset($error) && !empty($error)): ?>
        var errorModal = new bootstrap.Modal(document.getElementById('ErrorUserSettingsModal'));
        errorModal.show();
      <?php endif; ?>
    });
  </script>

  <?php include './inc/footer.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>