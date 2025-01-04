<?php 
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    } 
    include("./inc/functions.php");
    include("./inc/dbconnection.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $newFirstname = sanitize_input($_POST["formFirstname"]);
      $newLastname = sanitize_input($_POST["formLastname"]);
      $newBirthday = sanitize_input($_POST["formBirthdate"]);
      $newEmail = sanitize_input($_POST["formEMail"]);
      $newUsername = sanitize_input($_POST["formUsername"]);
  
      $currentUser = $_SESSION['UserInformation'];
      $updates = [];
  
      if ($newFirstname !== $currentUser['Firstname']) {
          $updates['Firstname'] = $newFirstname;
      }
      if ($newLastname !== $currentUser['Lastname']) {
          $updates['Lastname'] = $newLastname;
      }
      if ($newBirthday !== $currentUser['Birthday']) {
          $updates['Birthday'] = $newBirthday;
      }
      if ($newEmail !== $currentUser['Email']) {
          if (!filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Ungültige E-Mail-Adresse.";
          }
          else {
            $updates['Email'] = $newEmail;
          }
      }
      if ($newUsername !== $currentUser['Username']) {
        if (UsernameAvailable($newUsername)) {
            $updates['Username'] = $newUsername;
        }
        else{
            $errors[] = 'Username bereits vergeben. Bitte wählen Sie einen anderen.'; 
        }
      }

      if (!empty($updates)) {
        foreach ($updates as $column => $value) {
            $stmt = $conn->prepare("UPDATE User SET $column = ? WHERE Username = ?");
            $stmt->bind_param('ss', $value, $currentUser['Username']);
            $stmt->execute();
            $stmt->close();
        }
        updateUserInformation($newUsername);
        $updated = true;
    } else {
        $updated = false;
    }
  
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./usersettings.stylesheet.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Settings</title>
</head>
<?php if (isset($_SESSION['loggedin']) && ($_SESSION['loggedin'])) : ?>
<body>
<?php include("./inc/nav.php")?>
<div class="container">
<div class="row gutters-sm">
  <div class="col-md-4 d-none d-md-block">
    <div class="card">
      <div class="card-body">
        <nav class="nav flex-column nav-pills nav-gap-y-1">
          <a href="#account" data-toggle="tab" class="nav-item nav-link has-icon nav-link-faded active">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings pe-1"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>Account Settings
          </a>
          <?php if ($_SESSION['UserInformation']['Role_ID'] == 1) : ?>
          <a href="#usermanagement" data-toggle="tab" class="nav-item nav-link has-icon nav-link-faded">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings pe-1"><circle cx="12" cy="12" r="3"></circle><path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"></path></svg>User Management
          </a>
          <?php endif; ?>
          <a href="#notification" data-toggle="tab" class="nav-item nav-link has-icon nav-link-faded">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell pe-1"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>Notification
          </a>
        </nav>
      </div>
    </div>
  </div>
  <div class="col-md-8">
    <div class="card">
      <div class="card-header border-bottom mb-3 d-flex d-md-none">
        <ul class="nav nav-tabs card-header-tabs nav-gap-x-1" role="tablist"> <!-- Responsive navbar falls Seite zu klein wird -->
          <li class="nav-item">
            <a href="#account" data-bs-toggle="tab" class="nav-link has-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg></a>
          </li>
          <?php if ($_SESSION['UserInformation']['Role_ID'] == 1) : ?>
          <li class="nav-item">
            <a href="#usermanagement" data-bs-toggle="tab" class="nav-link has-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"></path></svg></a>
          </li>
          <?php endif; ?>
          <li class="nav-item">
            <a href="#notification" data-bs-toggle="tab" class="nav-link has-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg></a>
          </li>
        </ul>
      </div>

      <div class="card-body tab-content">
        <div class="tab-pane active" id="account">
          <h6>YOUR ACCOUNT SETTINGS</h6>
          <hr>
          <form action="usersettings.php" method="POST">
            <div class="form-floating mb-3">
              <input type="text" required class="form-control form-control-lg" id="firstname" placeholder="firstname" name="formFirstname" value="<?php echo($_SESSION['UserInformation']['Firstname']); ?>">
              <label for="firstname">First Name</label>
            </div>
            <div class="form-floating mb-3">
              <input type="text" class="form-control form-control-lg" id="lastname" placeholder="lastname" name="formLastname" value="<?php echo($_SESSION['UserInformation']['Lastname']); ?>"> <!-- Hier Daten aus Datenbank einfügen -->
              <label for="lastname">Last Name</label>
            </div>
            <div class="form-floating mb-3 datepicker w-100">
                      <input type="date" id="birthdayDate" required class="form-control form-control-lg" placeholder="first name" name="formBirthdate" value="<?php echo($_SESSION['UserInformation']['Birthday']); ?>" /> <!-- Hier Daten aus Datenbank einfügen -->
                      <label for="birthdayDate">Birthday</label>
            </div>
            <div class="form-floating mb-3">
                      <input type="email" id="emailAddress" required class="form-control form-control-lg" name="formEMail" value="<?php echo($_SESSION['UserInformation']['Email']); ?>"/> <!-- Hier Daten aus Datenbank einfügen -->
                      <label class="form-label" for="emailAddress">E-Mail</label>
            </div>
            <div class="form-floating mb-3">
                      <input type="text" id="username" required class="form-control form-control-lg" placeholder="Username" name="formUsername" autocomplete="off" value="<?php echo($_SESSION['UserInformation']['Username']); ?>" /> <!-- Hier Daten aus Datenbank einfügen -->
                      <label for="username">Username</label>
                    </div>

            <button type="button" id="UpdateProfileButton" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#checkModal">Update Profile</button>
            
            <div class="modal fade" id="checkModal" tabindex="-1" aria-labelledby="checkModalLabel" aria-hidden="true">
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
            <script>
              var myModal = document.getElementById('checkModal')
              var myInput = document.getElementById('UpdateProfileButton')
              myModal.addEventListener('shown.bs.modal', function () {
                myInput.focus()
              })
            </script>

            <button type="reset" class="btn btn-light">Reset Changes</button>
            <hr>
            <div class="form-group">
              <label class="d-block .text-black mb-1">Change Password</label>
              <p class="text-muted font-size-sm">To change your password, you have to type the old password.</p>
            </div>
            <button class="btn btn-primary" onclick="window.location.href='./changepassword.php'" type="button">Change Password</button>
            
            <hr>
            <div class="form-group">
              <label class="d-block text-danger">Delete Account</label>
              <p class="text-muted font-size-sm">Once you delete your account, there is no going back. Please be certain.</p>
            </div>
            <button class="btn btn-danger" type="button">Delete Account</button>
            <?php //hier Modal einbauen & nachfragen ob Account wirklich gelöscht werden soll?>
          </form>
        </div>
        
        <?php if ($_SESSION['UserInformation']['Role_ID'] == 1) : ?>
        <div class="tab-pane" id="usermanagement">
          <h6>USER Management</h6>
          <hr>
          <form>
            <div class="form-group">
              <label class="d-block .text-black mb-1">View Users</label>
              <p class="text-muted font-size-sm">Here you can see all registered users.</p>
            </div>
            <button class="btn btn-primary" onclick="window.location.href='./userlist.php'" type="button">View Users</button>
            <hr>
            <div class="form-group">
              <label class="d-block .text-black mb-1">View Reservations</label>
              <p class="text-muted font-size-sm">Here you can see all Reservation.</p>
            </div>
            <button class="btn btn-primary" onclick="window.location.href='./reservationlist_all.php'" type="button">View Reservations</button>

          </form>
        </div>
        <?php endif; ?>

        <div class="tab-pane" id="notification">
          <h6>NOTIFICATION SETTINGS</h6>
          <hr>
          <form>
            <div class="form-group">
              <label class="d-block mb-1">Alerts</label>
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="customCheck1" checked="">
                <label class="custom-control-label mb-3" for="customCheck1">Email Reservation</label> <!-- Benachrichtigung bei Reservierung, Werbung usw... -->
              </div>
            </div>
            <div class="form-group mb-2">
              <label class="d-block mb-2">SMS Notifications</label>
              <ul class="list-group list-group-sm">
                <li class="list-group-item has-icon">
                  Comments
                  <div class="custom-control custom-control-nolabel custom-switch ml-auto">
                    <input type="checkbox" class="custom-control-input" id="customSwitch1" checked="">
                    <label class="custom-control-label" for="customSwitch1"></label>
                  </div>
                </li>
                <li class="list-group-item has-icon">
                  News Updates
                  <div class="custom-control custom-control-nolabel custom-switch ml-auto">
                    <input type="checkbox" class="custom-control-input" id="customSwitch2">
                    <label class="custom-control-label" for="customSwitch2"></label>
                  </div>
                </li>
                <li class="list-group-item has-icon">
                  Reminders
                  <div class="custom-control custom-control-nolabel custom-switch ml-auto">
                    <input type="checkbox" class="custom-control-input" id="customSwitch3" checked="">
                    <label class="custom-control-label" for="customSwitch3"></label>
                  </div>
                </li>
              </ul>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>



<div class="modal fade" id="ErrorUserSettingsModal" tabindex="-1" aria-labelledby="ErrorUserSettingsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
        The following issues have occurred: 
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
    document.addEventListener("DOMContentLoaded", function() {
      <?php if (isset($updated) && $updated === true): ?>
        var successModal = new bootstrap.Modal(document.getElementById('successModal'));
        successModal.show();
        setTimeout(function() {
          successModal.hide();
        }, 1500);
      <?php endif; ?>
    });
</script>

<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script> <!--SEHR WICHTIG SONST SCHALTET NICHT -->
</body>
<?php else : ?>
  <?php header("Location: login.php"); ?>
<?php endif; ?>
</html>