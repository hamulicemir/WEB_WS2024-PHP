<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>S</title>
    <style>
        .background {
            background-image: url(pexels-pixabay-258154.jpg);
            background-size: cover;
            background-position: center;
            position: fixed;
            width: 100%;
            height: 100%;
            z-index: -1;
            filter: blur(5px);
        }
        .container-fluid {
            padding-top: 60px; /* Abstand für die Navbar */
        }
        .navbar {
            z-index: 1; /* Sicherstellen, dass die Navbar über dem Hintergrund ist */
            position: fixed;
            width: 100%;
        }
    </style>
</head>
<body>
<?php include 'nav.php'; ?>
    <div class="background"></div>
    <div class="container-fluid vh-100 d-flex justify-content-center align-items-center pt-5">
        <div class="row w-100">
            <div class="col-12 col-md-4 form-container mx-auto">
                <div class="card p-4">
                    <h2 class="fw-bold mb-3 mx-auto">Registration</h2>
                    <form action="./registration.html" method="post">
                        <div class="form-floating mb-3">
                            <select class="form-select" id="anrede" name="formAnrede" aria-label="Floating label select example" required>
                                <option value="" disabled selected>Wählen Sie Ihre Anrede</option>
                                <option value="formFrau">Frau</option>
                                <option value="formMann">Mann</option>
                            </select>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" type="text" id="vorname" name="formVorname" placeholder="Vorname" required>
                            <label for="vorname">Vorname</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" type="text" id="nachname" name="formNachname" placeholder="Nachname" required>
                            <label for="nachname">Nachname</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" type="text" id="nachname" name="formNachname" placeholder="Nachname" required>
                            <label for="nachname">Nachname</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" type="text" id="nachname" name="formNachname" placeholder="Nachname" required>
                            <label for="nachname">Nachname</label>
                        </div>
                        
                        <p class="small mt-2"><a class="text-black" href="#!">Already signed up?</a></p>
                        <button class="btn btn-primary btn-lg btn-block w-100" type="submit">Sign-Up</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
