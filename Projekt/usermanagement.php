<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./usersettings.stylesheet.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <title>Settings</title>
</head>

<body>
  <?php include("./inc/nav.php") ?>
  <div class="d-flex justify-content-center align-items-center  mt-5">
    <!-- Added classes to center the container and margin-top -->
    <div class="container ">
      <div class="row gutters-sm justify-content-center">
        <div class="col-md-8 ">
          <div class="card ">
            <div class="card-header border-bottom mb-3 d-flex d-md-none">
              <ul class="nav nav-tabs card-header-tabs nav-gap-x-1" role="tablist">
                <!-- Responsive navbar falls Seite zu klein wird -->
                <li class="nav-item">
                  <a href="#account" data-bs-toggle="tab" class="nav-link has-icon"><svg
                      xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                      class="feather feather-settings">
                      <circle cx="12" cy="12" r="3"></circle>
                      <path
                        d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                      </path>
                    </svg></a>
                </li>
                <li class="nav-item">
                  <a href="#notification" data-bs-toggle="tab" class="nav-link has-icon"><svg
                      xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                      class="feather feather-bell">
                      <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                      <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                    </svg></a>
                </li>
              </ul>
            </div>

            <div class="card-body tab-content">
              <div class="tab-pane active" id="account">
                <h6>USER: <?php echo $_SESSION['UserInformation']['Username']; ?> SETTINGS</h6>
                <!-- Display the username -->
                <hr>
                <form action="usersettings.php" method="POST">
                  <div class="form-floating mb-3">
                    <input type="text" required class="form-control form-control-lg" id="firstname"
                      placeholder="firstname" name="formFirstname"
                      value="<?php echo ($_SESSION['UserInformation']['Firstname']); ?>">
                    <label for="firstname">First Name</label>
                  </div>
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control form-control-lg" id="lastname" placeholder="lastname"
                      name="formLastname" value="<?php echo ($_SESSION['UserInformation']['Lastname']); ?>">
                    <!-- Hier Daten aus Datenbank einfügen -->
                    <label for="lastname">Last Name</label>
                  </div>
                  <div class="form-floating mb-3 datepicker w-100">
                    <input type="date" id="birthdayDate" required class="form-control form-control-lg"
                      placeholder="first name" name="formBirthdate"
                      value="<?php echo ($_SESSION['UserInformation']['Birthday']); ?>" />
                    <!-- Hier Daten aus Datenbank einfügen -->
                    <label for="birthdayDate">Birthday</label>
                  </div>
                  <div class="form-floating mb-3">
                    <input type="email" id="emailAddress" required class="form-control form-control-lg" name="formEMail"
                      value="<?php echo ($_SESSION['UserInformation']['Email']); ?>" />
                    <!-- Hier Daten aus Datenbank einfügen -->
                    <label class="form-label" for="emailAddress">E-Mail</label>
                  </div>
                  <div class="form-floating mb-3">
                    <input type="text" id="username" required class="form-control form-control-lg"
                      placeholder="Username" name="formUsername" autocomplete="off"
                      value="<?php echo ($_SESSION['UserInformation']['Username']); ?>" />
                    <!-- Hier Daten aus Datenbank einfügen -->
                    <label for="username">Username</label>
                  </div>

                  <div class="d-flex justify-content-between">

                    <button type="button" id="UpdateProfileButton" class="btn btn-primary" data-bs-toggle="modal"
                      data-bs-target="#checkModal">Update Profile</button>
                    <button type="reset" class="btn btn-light">Reset Changes</button>
                    <button type="button" class="btn btn-primary ms-auto" data-bs-toggle="modal"
                      data-bs-target="#changePasswordModal" data-whatever="@getbootstrap">Change Password</button>
                  </div>

                  <div class="modal fade" id="checkModal" tabindex="-1" aria-labelledby="checkModalLabel"
                    aria-hidden="true">
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
  </div>

  <!-- Change Password Modal -->
  <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog"
    aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
          <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
          <!-- Aligned to the right -->
        </div>
        <div class="modal-body ">
          <form>
            <div class="form-group">
              <label for="new-password" class="col-form-label">New Password:</label>
              <input type="password" class="form-control" id="new-password">
            </div>
            <div class="form-group">
              <label for="confirm-password" class="col-form-label">Confirm New Password:</label>
              <input type="password" class="form-control" id="confirm-password">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  <?php include './inc/footer.php'; ?>
  <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>