<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="./picture.stylesheet.css" rel="stylesheet" />
    <title>Pictures</title>
</head>

<body>
    <?php include './inc/nav.php'; ?>
    <div class="album py-5 bg-body-tertiary">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row cols-md-3 g-3">
                <div class="col">
                    <div class="card shadow-sm h-100 d-flex flex-column">
                        <img src="./Pictures/P5.jpg" class="img-fluid" alt="Pool image">
                        <div class="card-body">
                            <p class="card-text">
                                Welcome to Paradise Resort, where relaxation meets tropical luxury. Unwind by our
                                crystal-clear pool, surrounded by lush greenery and swaying palm trees. Enjoy a
                                refreshing drink at our poolside bar, soak up the sun on our comfortable loungers, and
                                let your worries drift away under the serene blue skies. Experience the perfect escape,
                                tailored for your ultimate comfort and enjoyment.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card shadow-sm h-100 d-flex flex-column">
                        <img src="./Pictures/alkoholicari.jpg" class="img-fluid" alt="Room image">
                        <div class="card-body">
                            <p class="card-text">
                                Indulge in luxury at its finest with our exclusive romantic getaway package. Revel in
                                the elegance of our plush rooms, featuring sophisticated décor and a cozy atmosphere.
                                Celebrate life's special moments with a bottle of Moët & Chandon champagne, delectable
                                gourmet desserts, and the finest touches of comfort, all designed to make your stay
                                unforgettable. Let us help you create memories that will last a lifetime. </p>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card shadow-sm h-100 d-flex flex-column">
                        <img src="./Pictures/soba_zena.jpg" class="img-fluid" alt="Room View image">
                        <div class="card-body">
                            <p class="card-text">
                                Escape to a tranquil oasis where nature meets comfort. Our eco-luxury suites offer a
                                harmonious blend of rustic charm and modern elegance, complete with canopy beds, warm
                                wooden interiors, and breathtaking views of lush greenery. Start your day with the
                                serenity of the outdoors, as you unwind on your private balcony and embrace the peaceful
                                rhythm of nature. Your perfect retreat awaits.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card shadow-sm h-100 d-flex flex-column">
                        <img src="./Pictures/pexels-pixabay-261101.jpg" class="img-fluid" alt="Pool Area image">
                        <div class="card-body">
                            <p class="card-text">
                                Welcome to our tropical oasis, where every day feels like a vacation. Our resort-style
                                pool is surrounded by swaying palm trees and serene landscaping, creating the perfect
                                environment for relaxation and fun. Whether you're lounging poolside, taking a
                                refreshing dip, or enjoying a quiet moment under our charming cabana, you'll find
                                everything you need to unwind and soak up the sun. Your paradise escape awaits! </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include './inc/footer.php'; ?>
</body>

</html>