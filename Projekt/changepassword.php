<?php 
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
    $errors = [];
    $errors["old_password"] = false;
    $errors["new_password"] = false;
    $errors["repeat_new_password"] = false;
    $errors["formPassword"] = false;


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $loggedin = $_SESSION['loggedin'];
        $session_email = $_SESSION["Session_Email"];
        $session_password = $_SESSION["Session_Password"];
        include './inc/functions.php';

        if (empty($enteredOldPassword) || empty($enteredNewPassword) || empty($enteredRepeatNewPassword)) {
            $emptyForm = true;
        }

        $enteredOldPassword = sanitize_input($_POST["OldPassword"]);
        $enteredNewPassword = sanitize_input($_POST["NewPassword"]);
        $enteredRepeatNewPassword = sanitize_input($_POST["RepeatNewPassword"]);

        if(!validate_Repeat_Password($session_password, $enteredOldPassword)){
            $errors["old_password"] = true;
        }

        if(!validate_Repeat_Password($enteredNewPassword, $enteredRepeatNewPassword)){
            $errors["repeat_new_password"] = true;
        }
        
        if (empty($errors)) {
            // Falls alles korrekt ist, weitere Verarbeitung (z.B. Speichern der Daten)
            // Hier könnte die Speicherung in einer Datenbank folgen   
        }
    }
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Change Password</title>
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
                            <?php if ($_SESSION['loggedin']) : ?>
                                <h2 class="fw-bold mb-3 mx-auto text-center">Change Password</h2>
                                <form action="" method="POST">
                                    <div class="form-floating mb-3">
                                        <input type="password"
                                            class="form-control 
                                    <?php echo ($errors["old_password"] && $emptyForm) ? 'is-invalid' : ($enteredOldPassword ? 'is-valid' : ''); ?>"
                                            id="floatingOldPassword"
                                            placeholder="OldPassword"
                                            name="OldPassword"
                                            value=""
                                            required>
                                            <!-- Show/Hide Password Eye-->

                                        <label for="floatingOldPassword">Old Password</label>
                                        <?php if ($errors["formPassword"]): ?>
                                            <div class="invalid-feedback">Falsches Passwort.</div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input
                                            type="password"
                                            class="form-control"
                                            id="floatingNewPassword"
                                            placeholder="NewPassword"
                                            name="NewPassword"
                                            required>
                                            <!-- Show/Hide Password Eye-->

                                        <label for="floatingNewPassword">New Password</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input
                                            type="password"
                                            class="form-control 
                                    <?php if(!($errors["old_password"] && $emptyForm)) echo ($errors['repeat_new_password'] && $emptyForm) ? 'is-invalid' : ($enteredRepeatNewPassword ? 'is-valid' : ''); ?>"
                                            id="floatingRepeatNewPassword"
                                            placeholder="RepeatNewPassword"
                                            name="RepeatNewPassword"
                                            required>
                                            <!-- Show/Hide Password Eye-->

                                        <label for="floatingRepeatNewPassword">Repeat New Password</label>
                                        <?php if ( $errors["repeat_new_password"]): ?>
                                            <div class="invalid-feedback">Falsches Passwort.</div>
                                        <?php endif; ?>
                                    </div>
                                    <button class="btn btn-primary btn-lg btn-block w-100" type="submit">Change Password</button>
                                </form>
                            <?php else : ?>
                                <h2 class="fw-bold mx-auto text-center mt-3">You have to log in first!</h2>
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
