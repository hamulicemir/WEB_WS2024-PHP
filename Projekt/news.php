<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include './inc/functions.php';
include("./inc/dbconnection.php");

if (!$conn) {
    die("Datenbankverbindung fehlgeschlagen: " . mysqli_connect_error());
}

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
            $stmt = $conn->prepare("SELECT * FROM News ORDER BY Creation_Stamp DESC");
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            ?>
            <?php while ($post = $result->fetch_assoc()) : ?>
                <div class="col-12 mb-4">
                    <div class="card h-100">
                        <?php if (!empty($post['Image_Path']) && file_exists($post['Image_Path'])) : ?>
                            <img src="<?php echo $post['Image_Path']; ?>" class="card-img-top" alt="Thumbnail">
                        <?php endif; ?>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h2 class="card-title"><?php echo $post['Title'] ?></h2>
                                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] && $_SESSION['UserInformation']['Role_ID'] === 1) : ?>
                                    <button class='btn btn-danger m-1' data-bs-toggle='modal' data-bs-target='#CheckDeleteModal' data-news-id=" <?php echo $post['News_ID']?>">Delete</button>
                                <?php endif; ?>
                            </div>
                            <p class="card-text"><?php echo $post['Description'] ?></p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted"><?php echo $post['Creation_Stamp'] ?></small>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </main>
    <div class="modal fade" id="CheckDeleteModal" tabindex="-1" aria-labelledby="CheckDeleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete News?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this News?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="confirmDeleteButton" class="btn btn-danger">Delete News</button>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('button[data-bs-toggle="modal"]').forEach(function(button) {
                button.addEventListener('click', function() {
                    var newsID = this.getAttribute('data-news-id');
                    document.getElementById('confirmDeleteButton').setAttribute('data-news-id', newsID);
                });
            });

            document.getElementById('confirmDeleteButton').addEventListener('click', function() {
                var newsID = this.getAttribute('data-news-id');
                window.location.href = 'news_delete.php?id=' + newsID;
            });
        });
    </script>

    <?php include './inc/footer.php'; ?>
</body>

</html>