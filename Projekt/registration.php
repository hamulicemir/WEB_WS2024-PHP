<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

include './inc/functions.php';
include("./inc/dbconnection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if(!$conn){
    die("Datenbankverbindung fehlgeschlagen: " . mysqli_connect_error());
  }

  $firstname = sanitize_input($_POST["formFirstname"]);
  $lastName = sanitize_input($_POST['formLastname']);
  $birthday = sanitize_input($_POST['formBirthdate']);
  $gender = sanitize_input($_POST['formGender']);
  $email = sanitize_input($_POST['formEMail']);
  $Username = sanitize_input($_POST['formUsername']);
  $password = sanitize_input($_POST['formPassword']);
  $passwordRepeat = sanitize_input($_POST['formPasswordSecond']);

  //based on this article: https://en.wikipedia.org/wiki/ISO/IEC_5218
  if(isset($gender)){
    switch($gender){ 
        case "male": 
            $gender = 1; 
            break;
        case "female": 
            $gender = 2; 
            break;
        case "other":
            $gender = 0;
            break;
        default:
            $gender = null;
    }} else {
        $gender = null;
    }

  //Flags
  $firstnameError = false;
  $lastNameError = false;
  $birtdayError = false;
  $EMailError = false;
  $UsernameError = false;
  $emptyForm = false;
  $passwordDoesNotMatch = false;
  $errors = [];

  //Überprüfungen
  if (
    empty($firstname) || empty($lastName) || empty($birthday) || $gender == null ||
    empty($email) || empty($Username) || empty($password) || empty($passwordRepeat)
  ) {
    $emptyForm = true;
    $errors[] = "Alle Felder müssen ausgefüllt sein.";
  }

  if (strlen($firstname) > 40 || strlen($firstname) < 2) {
    $firstnameError = true;
    $errors[] = "Ungültiger Vorname";
  }

  if (strlen($lastName) > 40 || strlen($lastName) < 1) {
    $errors[] = "Ungültiger Nachname";
  }

  if (!validate_Repeat_Password($password, $passwordRepeat)) {
    $passwordDoesNotMatch = true;
    $errors[] = "Die Passwörter stimmen nicht überein.";
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Ungültige E-Mail-Adresse.";
  }

  if (strlen($Username) < 3) {
    $usernameError = true;
    $errors[] = "Der Benutzername muss mindestens 3 Zeichen lang sein.";
  }
  
  $UsernameError = !UsernameAvailable($Username);
  if ($UsernameError) {
    $errors[] = "Der Benutzername ist bereits vergeben.";
  }
 
  if (empty($errors)) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $roleID = 2;
    $status = "User";

    $preparedInsertStatemant = "INSERT INTO User (Username, Email, password_hash, Role_ID, Firstname, Lastname, Birthday, Gender, status_user) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($preparedInsertStatemant);

    if (!$stmt) {
        die("Fehler bei der Vorbereitung der Abfrage: " . $conn->error);
    }

    $stmt->bind_param("sssisssis", $Username, $email, $hashedPassword, $roleID, $firstname, $lastName, $birthday, $gender, $status);

    if ($stmt->execute()) {
        $execution = true;
        $_SESSION["loggedin"] = true;
        $_SESSION["username"] = $Username;

        updateUserInformation($Username);
      } else {
        $execution = false;
        die("Fehler beim Anlegen: " . $stmt->error);
    }
    $stmt->close();
    }
  } 
  ?>

<!DOCTYPE html>
<html lang="de">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <title>Sign-Up</title>
  <style>
    .background {
      background-image: url(./Pictures/pexels-pixabay-258154.jpg);
      background-size: cover;
      background-position: center;
      position: fixed;
      width: 100%;
      height: 120%;
      z-index: -1;
      filter: blur(5px);
    }
  </style>
</head>

<body>
  <?php include './inc/nav.php'; ?>
  <div class="background"></div>
  <section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
      <div class="row justify-content-center align-items-center h-100">
        <div class="col-12 col-lg-9 col-xl-7">
          <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
            <div class="card-body p-4 p-md-5">
              <h2 class="fw-bold mb-3 mx-auto text-center">Sign-Up</h2>
              <form action="registration.php" method="POST">
                <div class="row">
                  <div class="col-md-6 mb-2">

                    <div class="form-floating mb-2">
                      <input type="text" id="firstName" required class="form-control form-control-lg <?php if ($firstnameError) echo "is-invalid";
                                                                                                      else "is-valid"; ?>" placeholder="first name" name="formFirstname" value="<?php if (isset($firstname)) echo $firstname; ?>" />
                      <label for="firstName">First Name</label>
                    </div>

                  </div>
                  <div class="col-md-6 mb-2">

                    <div class="form-floating mb-2">
                      <input type="text" id="lastName" required class="form-control form-control-lg <?php if ($lastNameError) echo "is-invalid";
                                                                                                    else "is-valid"; ?>" placeholder="last name" name="formLastname" value="<?php if (isset($lastName)) echo $lastName; ?>" />
                      <label for="lastName">Last Name</label>
                    </div>

                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-2 d-flex align-items-center">

                    <div class="form-floating mb-2 datepicker w-100">
                      <input type="date" id="birthdayDate" required class="form-control form-control-lg <?php if ($birtdayError) echo "is-invalid";
                                                                                                        else "is-valid"; ?>" placeholder="Birthday" name="formBirthdate" value="<?php if (isset($birthday)) echo $birthday; ?>" />
                      <label for="birthdayDate">Birthday</label>
                    </div>

                  </div>
                  <div class="col-md-6 mb-2">
                    <h6 class="mb-2 pb-1">Gender: </h6>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" required name="formGender" id="femaleGender" value="female" <?php if (isset($gender) && $gender == "female") echo "checked" ?> />
                      <label class="form-check-label" for="femaleGender">Female</label>
                    </div>

                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" required name="formGender" id="maleGender" value="male" <?php if (isset($gender) && $gender == "male") echo "checked" ?> />
                      <label class="form-check-label" for="maleGender">Male</label>
                    </div>

                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" required name="formGender" id="otherGender" value="other" <?php if (isset($gender) && $gender == "other") echo "checked" ?> />
                      <label class="form-check-label" for="otherGender">Other</label>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-2 pb-2">

                    <div class="form-floating mb-1">
                      <input type="email" id="emailAddress" required class="form-control form-control-lg <?php if ($EMailError) echo "is-invalid";
                                                                                                          else "is-valid"; ?>" placeholder="name@example.com" name="formEMail" value="<?php if (isset($email)) echo $email; ?>" />
                      <label class="form-label" for="emailAddress">E-Mail</label>
                    </div>

                  </div>
                  <div class="col-md-6 mb-2 pb-2">

                    <div class="form-floating mb-2">
                      <input type="text" id="username" required class="form-control form-control-lg <?php if ($UsernameError) echo "is-invalid";
                                                                                                    else "is-valid"; ?>" placeholder="Username" name="formUsername" autocomplete="off" value="<?php if (isset($Username)) echo $Username; ?>" />
                      <label for="username">Username</label>
                    </div>

                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-2 pb-2">
                    <div class="form-floating mb-2">
                      <input type="password" id="passwordfirst" required class="form-control form-control-lg" placeholder="password" name="formPassword" />
                      <label for="passwordfirst">Password</label>
                    </div>
                  </div>

                  <div class="col-md-6 mb-1 pb-1">
                    <div class="form-floating mb-2">
                      <input type="password" id="passwordsecond" required class="form-control form-control-lg <?php if ($passwordDoesNotMatch) echo "is-invalid";
                                                                                                              else "is-valid"; ?>" placeholder="password" name="formPasswordSecond" />
                      <label for="passwordsecond">Repeat Password</label>
                    </div>
                  </div>
                  <p class="small"><a class="text-black" href="./Login.php">Bereits registriert?</a></p>
                </div>

                <div class="">
                  <button id="SignUp" class="btn btn-primary btn-lg btn-block w-100" data-bs-toggle="modal" data-bs-target="#execModal" type="submit">Sign-Up</button>
                </div>
                <?php if (isset($emptyForm) && $emptyForm) : ?>
                  <p class="m-3 mx-auto text-center text-danger">Das Formular ist unvollständig</p>
                <?php endif; ?>

                <?php if (isset($passwordDoesNotMatch) && $passwordDoesNotMatch) : ?>
                  <p class="m-3 mx-auto text-center text-danger">Das Password ist nicht gleich.</p>
                <?php endif; ?>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <div class="modal fade" id="ErrorModal" tabindex="-1" aria-labelledby="ErrorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">

        <div class="modal-body">
          Folgende Probleme sind aufgetreten: 
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
      <?php if (isset($errors) && !empty($errors)): ?>
        var ErrorModal = new bootstrap.Modal(document.getElementById('ErrorModal'));
        ErrorModal.show();
      <?php endif; ?>
    });
  </script>



  <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
          Sie haben sich erfolgreich registriert!
        </div>
      </div>
    </div>
  </div>
</div>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      <?php if (isset($execution) && $execution === true): ?>
        var successModal = new bootstrap.Modal(document.getElementById('successModal'));
        successModal.show();
        setTimeout(function() {
        window.location.href = 'index.php';
      }, 1000);
      <?php endif; ?>
    });
</script>
</body>

<script
      src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
      integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
      integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/"
      crossorigin="anonymous"
    ></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="./app.js"></script>
</html>