<?php
session_start();
$thumbnailsDir = './Pictures/Thumbnails-resized/';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Newsfeed</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="header">
    </div>
    <?php include './inc/nav.php'; ?>

    <main class="container my-5">
        <div class="row">
            <div class="col-8 mb-4">
                <h2 class="mb-4">Latest Posts</h2>
            </div>
            <?php
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] && $_SESSION['UserInformation']['Role_ID'] === 1) :
            ?>
                <div class="col-4 mb-4 d-flex justify-content-end">
                    <a href="./news-form.php"><button type="button" class="btn btn-primary me-3">Neuer Beitrag</button></a>
                </div>
            <?php endif; ?>

            <?php
            $posts = [
                [
                    "title" => "Test",
                    "text" => "Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.",
                    "image" => './Pictures/Thumbnails-resized/Test.jpeg',
                    "date" => "2024-11-23"
                ],
                [
                    "title" => "2. Beitrag",
                    "text" => "Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.",
                    "image" => './Pictures/Thumbnails-resized/Test2.jpeg',
                    "date" => "2024-11-22"
                ],
                [
                    "title" => "3. Beitrag",
                    "text" => "Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.",
                    "image" => './Pictures/Thumbnails-resized/Test3.jpeg',
                    "date" => "2024-11-21"
                ]
            ];

            foreach ($posts as $post) : ?>
                <div class="col-12 mb-4">
                    <div class="card h-100">
                        <?php if (!empty($post['image']) && file_exists($post['image'])) : ?>
                            <img src="<?php echo $post['image']; ?>" class="card-img-top" alt="Thumbnail">
                        <?php endif; ?>
                        <div class="card-body">
                            <h2 class="card-title "><?php echo $post['title'] ?></h2>
                            <p class="card-text"><?php echo $post['text'] ?></p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted"><?php echo $post['date'] ?></small>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>


    
    <?php include './inc/footer.php'; ?>
    
    
</body>

</html>