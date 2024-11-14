<?php 
    session_start();
    //function für DB Acess und reset funktion sowie update funktion
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
          <li class="nav-item">
            <a href="#notification" data-bs-toggle="tab" class="nav-link has-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg></a>
          </li>
        </ul>
      </div>

      <div class="card-body tab-content">
        <div class="tab-pane active" id="account">
          <h6>YOUR ACCOUNT SETTINGS</h6>
          <hr>
          <form> <!-- Form muss noch vervollständigt werden-->
            <div class="form-floating mb-3">
              <input type="text" required class="form-control form-control-lg" id="firstname" placeholder="firstname" value=""> <!-- Hier Daten aus Datenbank einfügen -->
              <label for="firstname">First Name</label>
            </div>
            <div class="form-floating mb-3">
              <input type="text" class="form-control form-control-lg" id="lastname" placeholder="lastname" value=""> <!-- Hier Daten aus Datenbank einfügen -->
              <label for="lastname">Last Name</label>
            </div>
            <div class="form-floating mb-3 datepicker w-100">
                      <input type="date" id="birthdayDate" required class="form-control form-control-lg" placeholder="first name" name="formBirthdate" value="" /> <!-- Hier Daten aus Datenbank einfügen -->
                      <label for="birthdayDate">Birthday</label>
            </div>
            <div class="form-floating mb-3">
                      <input type="email" id="emailAddress" required class="form-control form-control-lg" value=""/> <!-- Hier Daten aus Datenbank einfügen -->
                      <label class="form-label" for="emailAddress">E-Mail</label>
            </div>
            <div class="form-floating mb-3">
                      <input type="text" id="username" required class="form-control form-control-lg" placeholder="Username" name="formUsername" autocomplete="off" value="" /> <!-- Hier Daten aus Datenbank einfügen -->
                      <label for="username">Username</label>
                    </div>

            <button type="button" class="btn btn-primary">Update Profile</button>
            <?php //hier Modal einbauen & nachfragen ob Settings gesaved werden sollen?>

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
        
        <div class="tab-pane" id="notification">
          <h6>NOTIFICATION SETTINGS</h6>
          <hr>
          <form> <!-- Form muss noch vervollständigt werden-->
            <div class="form-group">
              <label class="d-block mb-0">Alerts</label>
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="customCheck1" checked="">
                <label class="custom-control-label" for="customCheck1">Email Reservation</label> <!-- Benachrichtigung bei Reservierung, Werbung usw... -->
              </div>
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="customCheck2" checked="">
                <label class="custom-control-label" for="customCheck2">Email a digest summary of vulnerability</label>
              </div>
            </div>
            <div class="form-group mb-0">
              <label class="d-block">SMS Notifications</label>
              <ul class="list-group list-group-sm">
                <li class="list-group-item has-icon">
                  Comments
                  <div class="custom-control custom-control-nolabel custom-switch ml-auto">
                    <input type="checkbox" class="custom-control-input" id="customSwitch1" checked="">
                    <label class="custom-control-label" for="customSwitch1"></label>
                  </div>
                </li>
                <li class="list-group-item has-icon">
                  Updates From People
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
                <li class="list-group-item has-icon">
                  Events
                  <div class="custom-control custom-control-nolabel custom-switch ml-auto">
                    <input type="checkbox" class="custom-control-input" id="customSwitch4" checked="">
                    <label class="custom-control-label" for="customSwitch4"></label>
                  </div>
                </li>
                <li class="list-group-item has-icon">
                  Pages You Follow
                  <div class="custom-control custom-control-nolabel custom-switch ml-auto">
                    <input type="checkbox" class="custom-control-input" id="customSwitch5">
                    <label class="custom-control-label" for="customSwitch5"></label>
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
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script> <!--SEHR WICHTIG SONST SCHALTET NICHT -->
</body>
</html>