<?php
session_start();
include './inc/functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $firstname = sanitize_input($_POST["formFirstname"]);
  $lastName = sanitize_input($_POST['formLastname']);
  $birthday = sanitize_input($_POST['formBirthdate']);
  $gender = sanitize_input($_POST['formGender']);
  $email = sanitize_input($_POST['formEMail']);
  $Username = sanitize_input($_POST['formUsername']);
  $password = sanitize_input($_POST['formPassword']);
  $passwordRepeat = sanitize_input($_POST['formPasswordSecond']);

  //Flags
  $emptyForm = false;
  $firstnameError = false;
  $lastNameError = false;
  $passwordDoesNotMatch = false;
  $EMailError = false;
  $birtdayError = false;
  $UsernameError = false;
  $errors = [];

  //Überprüfungen
  if (
    empty($firstname) || empty($lastName) || empty($birthday) || empty($gender) ||
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
    $lastNameError = true;
    $errors[] = "Ungültiger Nachname";
  }

  if (!validate_Repeat_Password($password, $passwordRepeat)) {
    $passwordDoesNotMatch = true;
    $errors[] = "Die Passwörter stimmen nicht überein.";
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $EMailError = true;
    $errors[] = "Ungültige E-Mail-Adresse.";
  }

  $dateNow = new DateTime();
  $birthDate = DateTime::createFromFormat('Y-m-d', $birthday);
  if (!$birthDate || $birthDate > $dateNow) {
    $birtdayError = true;
    $errors[] = "Ungültiges Geburtsdatum.";
  }

  if (strlen($Username) < 3) {
    $UsernameError = true;
    $errors[] = "Der Benutzername muss mindestens 3 Zeichen lang sein.";
    //Überprüfung der Datenbank auf bestehende Usernamen, um sicherzugehen, dass dieser Username einzigartig ist. (in Zukunft)
    /* if(DBUsername == $Username){
        $errors[] = "Der Benutzername ist bereits vergeben.";
        $UsernameError = true;
        }
        else{
          DB TABLE INSERT $USERNAME ...
        }
    }
    */
  }
  if (empty($errors)) {
    // Falls alles korrekt ist, weitere Verarbeitung (z.B. Speichern der Daten)
    // Hier könnte die Speicherung in einer Datenbank folgen   
  }
  if (($emptyForm || $firstnameError || $lastNameError || $passwordDoesNotMatch || $EMailError || $birtdayError || $UsernameError))
    $_SESSION['loggedin'] = false;
  else {
    $_SESSION['loggedin'] = true;
    header("Location: index.php");    
  }
}
?>

<!DOCTYPE html>
<html lang="de">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <title>S</title>
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
              <form action="" method="POST">
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
                  <button class="btn btn-primary btn-lg btn-block w-100" type="submit">Sign-Up</button>
                </div>
                <?php if ($emptyForm) : ?>
                  <p class="m-3 mx-auto text-center text-danger">Das Formular ist unvollständig</p>
                <?php endif; ?>

                <?php if ($passwordDoesNotMatch) : ?>
                  <p class="m-3 mx-auto text-center text-danger">Das Password ist nicht gleich.</p>
                <?php endif; ?>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</html>