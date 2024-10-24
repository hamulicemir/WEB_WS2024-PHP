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
    <?php include './inc/nav.php';?>
    <div class="background"></div>
    <div class="container-fluid vh-100 d-flex justify-content-center align-items-center">
        <div class="row w-100">
            <div class="col-md-4 mx-auto">
                <div class="card p-4 p-md-5">
                    <h2 class="fw-bold mb-3 mx-auto">Login</h2>
                    <form action="./test.html" method="post">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                            <label for="floatingInput">Email Adresse</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                            <label for="floatingPassword">Passwort</label>
                        </div>
                        <p class="small mt-2"><a class="text-black" href="#!">Passwort vergessen?</a></p>
                        <button class="btn btn-primary btn-lg btn-block w-100" type="submit">Login</button>
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
