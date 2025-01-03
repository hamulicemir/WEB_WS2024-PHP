<?php     
if (session_status() === PHP_SESSION_NONE) {
      session_start();
}?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="./picture.stylesheet.css" rel="stylesheet" />
    <title>Pictures</title>
</head>

<body>
    <?php include './inc/nav.php';?>
    <div class="album py-5 bg-body-tertiary">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row cols-md-3 g-3">
                <div class="col">
                    <div class="card shadow-sm">
                        <img src="./Pictures/P5.jpg" class="img-fluid" alt="Responsive image">
                        <div class="card-body">
                            <p class="card-text">
                                This is text.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card shadow-sm">
                        <img src="./Pictures/P5.jpg" class="img-fluid" alt="Responsive image">
                        <div class="card-body">
                            <p class="card-text">
                                This is text.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card shadow-sm">
                    <img src="./Pictures/P5.jpg" class="img-thumbnail" alt="Responsive image">
                    <div class="card-body">
                            <p class="card-text">
                                This is text.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card shadow-sm">
                        <img src="./Pictures/P5.jpg" class="img-thumbnail" alt="Responsive image">
                        <div class="card-body">
                            <p class="card-text">
                                This is text.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include './inc/footer.php'; ?>
</body>

</html>