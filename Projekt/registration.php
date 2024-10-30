<?php
session_start();
include './inc/functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $firstname = sanitize_input($_POST["formFirstname"]);
  $lastName = sanitize_input($_POST['formLastname']);
  $birthday = sanitize_input($_POST['formBirthdate']);
  $gender = sanitize_input($_POST['formGender']);
  $email = sanitize_input($_POST['formEMail']);
  $username = sanitize_input($_POST['formUsername']);
  $password = sanitize_input($_POST['formPassword']);
  $passwordRepeat = sanitize_input($_POST['formPasswordSecond']);

  $EmptyForm = false;

  if (empty($firstName) || empty($lastName) || empty($birthday) || empty($gender) || empty($email) || empty($username) || empty($password) || empty($passwordRepeat)) {
    $EmptyForm = true;
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
                      <input type="text" id="firstName" class="form-control form-control-lg" placeholder="first name" name="formFirstname" />
                      <label for="firstName">First Name</label>
                    </div>

                  </div>
                  <div class="col-md-6 mb-2">

                    <div class="form-floating mb-2">
                      <input type="text" id="lastName" class="form-control form-control-lg" placeholder="last name" name="formLastname" />
                      <label for="lastName">Last Name</label>
                    </div>
                     
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-2 d-flex align-items-center">

                    <div class="form-floating mb-2 datepicker w-100">
                      <input type="date" id="birthdayDate" class="form-control form-control-lg" placeholder="first name" name="formBirthdate" />
                      <label for="birthdayDate">Birthday</label>
                    </div>

                  </div>
                  <div class="col-md-6 mb-2">
                    <h6 class="mb-2 pb-1">Gender: </h6>

                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="formGender" id="femaleGender"
                        value="female" checked />
                      <label class="form-check-label" for="femaleGender">Female</label>
                    </div>

                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="formGender" id="maleGender"
                        value="male" />
                      <label class="form-check-label" for="maleGender">Male</label>
                    </div>

                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="formGender" id="otherGender"
                        value="other" />
                      <label class="form-check-label" for="otherGender">Other</label>
                    </div>

                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-2 pb-2">

                    <div class="form-floating mb-1">
                      <input type="email" id="emailAddress" class="form-control form-control-lg" placeholder="name@example.com" name="formEMail" />
                      <label class="form-label" for="emailAddress">E-Mail</label>
                    </div>

                  </div>
                  <div class="col-md-6 mb-2 pb-2">

                    <div class="form-floating mb-2">
                      <input type="text" id="username" class="form-control form-control-lg" placeholder="Username" name="formUsername" />
                      <label for="username">Username</label>
                    </div>

                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-2 pb-2">
                    <div class="form-floating mb-2">
                      <input type="password" id="passwordfirst" class="form-control form-control-lg" placeholder="password" name="formPassword" />
                      <label for="passwordfirst">Password</label>
                    </div>
                  </div>

                  <div class="col-md-6 mb-1 pb-1">
                    <div class="form-floating mb-2">
                      <input type="password" id="passwordsecond" class="form-control form-control-lg" placeholder="password" name="formPasswordSecond" />
                      <label for="passwordsecond">Repeat Password</label>
                    </div>
                  </div>
                  <p class="small"><a class="text-black" href="#!">Bereits registriert?</a></p>
                </div>

                <div class="">
                  <button class="btn btn-primary btn-lg btn-block w-100" type="submit">Sign-Up</button>
                </div>
                <?php  if($EmptyForm) : ?>
                  <p class="m-3 mx-auto text-center text-danger">Das Formular ist unvollständig</p>
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