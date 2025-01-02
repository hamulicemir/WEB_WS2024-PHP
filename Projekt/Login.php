<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include './inc/functions.php';
include("./inc/dbconnection.php");


$errors = [];
$errors["formUser"] = false;
$errors["formPassword"] = false;
$loginSuccess = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if(!$conn){
    die("Datenbankverbindung fehlgeschlagen: " . mysqli_connect_error());
  }
    $enteredUser = sanitize_input($_POST["formUser"]);
    $enteredPassword = sanitize_input($_POST["formPassword"]);

    $stmt = $conn->prepare("SELECT * FROM User WHERE Username = ?");
    $stmt->bind_param("s", $enteredUser);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION["UserInformation"] = $user;
        $hashedPassword = $user['password_hash'];

        if (password_verify($enteredPassword, $hashedPassword)) {
            $_SESSION['loggedin'] = true;
            $_SESSION["Session_User"] = $enteredUser;
            
            updateUserInformation($enteredUser);

            header("Location: index.php");
            exit();
        }
        else {
            $_SESSION['loggedin'] = false;
            $errors["formPassword"] = true;
        }
    } else {
        $_SESSION['loggedin'] = false;
    }
    $stmt->close();
    
}
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Login</title>
    <style>
        .background {
            background-image: url(./Pictures/pexels-pixabay-258154.jpg);
            background-size: cover;
            background-position: center;
            position: fixed;
            width: 100%;
            height: 100%;
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
                            <?php if ($loginSuccess): ?>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                                </div>
                                <script>
                                    setTimeout(function() {
                                        window.location.href = "index.php";
                                    }, 1000);
                                </script>
                            <?php endif; ?>
                            <?php if (isset($_SESSION)) : ?>
                                <h2 class="fw-bold mb-3 mx-auto text-center">Login</h2>
                                <form action="" method="POST">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control"
                                            id="floatingUser"
                                            placeholder="name@example.com"
                                            name="formUser"
                                            value="<?php if (isset($enteredUser)) echo $enteredUser; ?>"
                                            required>

                                        <label for="floatingUser">Username</label>

                                        <?php if ($errors["formUser"]): ?>
                                            <div class="invalid-feedback">Ungültiger Username.</div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input
                                            type="password"
                                            class="form-control 
                                    <?php if (!$errors["formUser"]) echo $errors['formPassword'] ? 'is-invalid' : ($enteredPassword ? 'is-valid' : ''); ?>"
                                            id="floatingPassword"
                                            placeholder="Passwort"
                                            name="formPassword"
                                            required>

                                        <label for="floatingPassword">Passwort</label>
                                        <?php if ($errors["formPassword"]): ?>
                                            <div class="invalid-feedback">Falsches Passwort.</div>
                                        <?php endif; ?>
                                    </div>
                                    <button class="btn btn-primary btn-lg btn-block w-100" type="submit">Login</button>
                                </form>
                            <?php else : ?>
                                <h2 class="fw-bold mx-auto text-center mt-3">Welcome <?php //echo Username aus Datenbank ziehen statt User...?>User!</h2>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <?php include './inc/footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>