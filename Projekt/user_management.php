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



global $userdata;
$user_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$errors = [];


if ($user_id > 0) {
  $stmt = $conn->prepare("SELECT * FROM User WHERE User_ID = ?");
  $stmt->bind_param("s", $user_id);
  $stmt->execute();
  $result = $stmt->get_result();
  $userdata = $result->fetch_assoc();
  $stmt->close();

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $newFirstname = sanitize_input($_POST["formFirstname"]);
    $newLastname = sanitize_input($_POST["formLastname"]);
    $newBirthday = sanitize_input($_POST["formBirthdate"]);
    $newEmail = sanitize_input($_POST["formEMail"]);
    $newUsername = sanitize_input($_POST["formUsername"]);
    $newStatus = sanitize_input($_POST["formStatus"]);

    $updates = [];

    if ($newFirstname !== $userdata['Firstname']) {
      $updates['Firstname'] = $newFirstname;
    }
    if ($newLastname !== $userdata['Lastname']) {
      $updates['Lastname'] = $newLastname;
    }
    if ($newBirthday !== $userdata['Birthday']) {
      $updates['Birthday'] = $newBirthday;
    }
    if ($newEmail !== $userdata['Email']) {
      if (!filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Ungültige E-Mail-Adresse.";
      } else {
        $updates['Email'] = $newEmail;
      }
    }
    if ($newUsername !== $userdata['Username']) {
      if (UsernameAvailable($newUsername)) {
        $updates['Username'] = $newUsername;
      } else {
        $errors[] = 'Username bereits vergeben. Bitte wählen Sie einen anderen.';
      }
    }
    if ($newStatus !== $userdata['status_user']) {
      $updates['status_user'] = $newStatus;
    }

    if (!empty($updates)) {
      foreach ($updates as $column => $value) {
        $stmt = $conn->prepare("UPDATE User SET $column = ? WHERE User_ID = ?");
        $stmt->bind_param('ss', $value, $user_id);
        $stmt->execute();
        $stmt->close();
      }
      $AdminUpdated = true;
    } else {
      $AdminUpdated = false;
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <title>Settings</title>
</head>

<body>
  <?php include("./inc/nav.php") ?>
  <div class="d-flex justify-content-center align-items-center mt-5">
    <div class="container">
      <div class="row gutters-sm justify-content-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-body">
              <h6>User Settings: <?php echo $userdata['Username'] ?></h6>
              <hr>
              <form action="user_management.php?id=<?php echo $user_id ?>" method="POST">
                <div class="form-floating mb-3">
                  <input type="text" required class="form-control form-control-lg" id="firstname"
                    placeholder="firstname" name="formFirstname" value="<?php echo $userdata['Firstname'] ?>">
                  <label for="firstname">First Name</label>
                </div>
                <div class="form-floating mb-3">
                  <input type="text" class="form-control form-control-lg" id="lastname" placeholder="lastname"
                    name="formLastname" value="<?php echo $userdata['Lastname']; ?>">
                  <label for="lastname">Last Name</label>
                </div>
                <div class="form-floating mb-3 datepicker w-100">
                  <input type="date" id="birthdayDate" required class="form-control form-control-lg"
                    placeholder="first name" name="formBirthdate" value="<?php echo $userdata['Birthday']; ?>" />
                  <label for="birthdayDate">Birthday</label>
                </div>
                <div class="form-floating mb-3">
                  <input type="email" id="emailAddress" required class="form-control form-control-lg" name="formEMail"
                    value="<?php echo $userdata['Email']; ?>" />
                  <label class="form-label" for="emailAddress">E-Mail</label>
                </div>
                <div class="form-floating mb-3">
                  <input type="text" id="username" required class="form-control form-control-lg" placeholder="Username"
                    name="formUsername" autocomplete="off" value="<?php echo $userdata['Username']; ?>" />
                  <label for="username">Username</label>
                </div>

                <select class="form-select mb-3" id="status" name="formStatus" required>
                  <option <?php if ($userdata['status_user'] === "Aktiv")
                    echo "selected" ?> value="Aktiv">Active</option>
                    <option <?php if ($userdata['status_user'] === "Inaktiv")
                    echo "selected" ?> value="Inaktiv">Inactive
                    </option>
                  </select>

                  <div class="d-flex justify-content-between">
                    <button type="button" id="AdminUpdateProfileButton" class="btn btn-primary me-3"
                      data-bs-toggle="modal" data-bs-target="#AdminUpdateProfileModal">Update Profile</button>
                    <button type="reset" class="btn btn-light">Reset Changes</button>
                    <button type="button" id="AdminChangePasswordButton" class="btn btn-primary ms-auto"
                      data-bs-toggle="modal" data-bs-target="#AdminChangePasswordModal"
                      data-whatever="@getbootstrap">Change Password</button>
                  </div>

                  <div class="modal fade" id="AdminUpdateProfileModal" tabindex="-1"
                    aria-labelledby="AdminUpdateProfileModalLabel" aria-hidden="true">
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
                </form>
              </div>
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
            Sie haben die Daten erfolgreich aktualisert!
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
      <?php if (isset($_SESSION['PasswordChanged']) && $_SESSION['PasswordChanged'] === true): ?>
        var successModal = new bootstrap.Modal(document.getElementById('successModal'));
        successModal.show();
        <?php $_SESSION['PasswordChanged'] = false; // Reset ?>
        setTimeout(function () {
          window.location.href = 'user_management.php?id=<?php echo $user_id ?>';
        }, 1500);
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
    document.addEventListener("DOMContentLoaded", function () {
      <?php if (isset($error) && !empty($error)): ?>
        var errorModal = new bootstrap.Modal(document.getElementById('ErrorUserSettingsModal'));
        errorModal.show();
      <?php endif; ?>
    });
  </script>

  <!-- Change Password Error Modal -->
  <div class="modal fade" id="ErrorPasswordSettingsModal" tabindex="-1"
    aria-labelledby="ErrorPasswordSettingsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
          The following issues occurred during the password change:
          <ul>
            <?php
            if (isset($_GET['error'])) {
              $errorsAdminPassword = explode(', ', urldecode($_GET['error']));
            }
            foreach ($errorsAdminPassword as $error) {
              echo "<li>" . htmlspecialchars($error) . "</li>";
            }
            ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      <?php if (isset($_GET['error']) && !empty($_GET['error'])): ?>
        var errorPasswordModal = new bootstrap.Modal(document.getElementById('ErrorPasswordSettingsModal'));
        errorPasswordModal.show();
      <?php endif; ?>
    });
  </script>

  <!-- Change Password Modal -->
  <div class="modal fade" id="AdminChangePasswordModal" tabindex="-1" role="dialog"
    aria-labelledby="AdminChangePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="AdminChangePasswordModalLabel">Change Password</h5>
          <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="admin_changepassword.php?id=<?php echo $user_id ?>" method="POST">
            <div class="form-group">
              <label for="new-password" class="col-form-label">New Password:</label>
              <input type="password" class="form-control" id="new-password" name="new_password" required>
            </div>
            <div class="form-group">
              <label for="confirm-password" class="col-form-label">Confirm New Password:</label>
              <input type="password" class="form-control" id="confirm-password" name="confirm_password" required>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <?php include './inc/footer.php'; ?>
  <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>