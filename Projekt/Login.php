<?php
session_start();

$validEmail = "test@email.com";
$validPassword = "123";

function sanitize_input($input): string
{
    $output = trim($input);
    $output = stripslashes($output);
    $output = htmlspecialchars($output);
    return $output;
}

$errors = [];
$errors["formEmail"] = false;
$errors["formPassword"] = false;
$loginSuccess = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enteredEmail = sanitize_input($_POST["formEmail"]);
    $enteredPassword = sanitize_input($_POST["formPassword"]);

    // Login-Prüfung
    if ($enteredEmail === $validEmail && $enteredPassword === $validPassword) {
        $_SESSION['loggedin'] = true;
        $_SESSION["Session_Email"] = $enteredEmail;
        $_SESSION["Session_Password"] = $enteredPassword;
        $loginSuccess = true;
        
        header("Location: index.php");
    } else {
        $_SESSION['loggedin'] = false;
        if ($enteredEmail !== $validEmail) $errors["formEmail"] = true;
        if ($enteredPassword !== $validPassword) $errors["formPassword"] = true;
    }
}
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>User-Login</title>
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
                            <h2 class="fw-bold mb-3 mx-auto text-center">Login</h2>
                            
                            <?php if ($loginSuccess): ?>
                                <div class="alert alert-success" role="alert">
                                    Login erfolgreich! Willkommen zurück!
                                </div>
                            <?php endif; ?>
                            
                            <form action="" method="POST">
                                <div class="form-floating mb-3">
                                    <input type="email" 
                                    class="form-control 
                                    <?php echo $errors['formEmail'] ? 'is-invalid' : ($enteredEmail ? 'is-valid' : ''); ?>" 
                                    id="floatingEmail" 
                                    placeholder="name@example.com" 
                                    name="formEmail" 
                                    value="<?php if(isset($enteredEmail)) echo $enteredEmail;?>"
                                    required>

                                    <label for="floatingEmail">Email Adresse</label>

                                    <?php if ($errors["formEmail"]): ?>
                                        <div class="invalid-feedback">Ungültige E-Mail-Adresse.</div>
                                    <?php endif; ?>
                                </div>

                                <div class="form-floating mb-3">
                                    <input 
                                    type="password" 
                                    class="form-control 
                                    <?php if(!$errors["formEmail"]) echo $errors['formPassword'] ? 'is-invalid' : ($enteredPassword ? 'is-valid' : ''); ?>" 
                                    id="floatingPassword" 
                                    placeholder="Passwort" 
                                    name="formPassword" 
                                    required>

                                    <label for="floatingPassword">Passwort</label>
                                    <?php if ($errors["formPassword"]): ?>
                                        <div class="invalid-feedback">Falsches Passwort.</div>
                                    <?php endif; ?>
                                </div>
                                <p class="small mt-2"><a class="text-black" href="#!">Passwort vergessen?</a></p>
                                <button class="btn btn-primary btn-lg btn-block w-100" type="submit">Login</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
