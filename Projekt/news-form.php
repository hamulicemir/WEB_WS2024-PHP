<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include './inc/functions.php';
include("./inc/dbconnection.php");

if (!$conn) {
    die("Datenbankverbindung fehlgeschlagen: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newsTitel = sanitize_input($_POST['newsTitel']);
    $newsText = sanitize_input($_POST['newsText']);

    if (!is_dir($thumbDir)) {
        mkdir($thumbDir, 0777, true);
    }
    if (!is_dir($resizedDir)) {
        mkdir($resizedDir, 0777, true);
    }

    $stmt = $conn->prepare("SELECT MAX(News_ID) FROM News");
    $stmt->execute();
    $maxID = $stmt->get_result()->fetch_row()[0];
    $stmt->close();

    $thumbDir = './Pictures/Thumbnails/';
    $resizedDir = './Pictures/Thumbnails-resized/';

    $thumbName = $thumbDir . $newsTitel . "-" . $maxID .".jpeg";
    $destinationPath = $resizedDir . $newsTitel . "-" . $maxID . ".jpeg";

    if (isset($_FILES['newsFoto']) && $_FILES['newsFoto']['error'] == 0) {
        if (move_uploaded_file($_FILES['newsFoto']['tmp_name'], $thumbName)) {
            // Thumbnail erstellen
            if (createThumbnail($thumbName, $destinationPath, 640, 360)) { 
                $stmt = $conn->prepare("INSERT INTO News (User_ID, Title, Description, Image_Path) VALUES (?, ?, ?, ?)");
                $stmt->bind_param('isss', $_SESSION['UserInformation']['User_ID'], $newsTitel, $newsText, $destinationPath);
                if ($stmt->execute()) {
                    echo "<div class='alert alert-success'>News-Beitrag wurde erfolgreich erstellt.</div>";
                    $success = true;
                } else {
                    echo "<div class='alert alert-danger'>Fehler beim Hochladen des News-Beitrags auf die Datenbank.</div>";
                }
                $stmt->close();
            } else {
                echo "<div class='alert alert-danger'>Fehler beim Erstellen des Thumbnails.</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Fehler beim Hochladen des Bildes.</div>";
        }
    } else {
        $stmt = $conn->prepare("INSERT INTO News (User_ID, Title, Description) VALUES (?, ?, ?)");
        $stmt->bind_param('iss', $_SESSION['UserInformation']['User_ID'], $newsTitel, $newsText);
        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>News-Beitrag wurde erfolgreich erstellt.</div>";
            $success = true;
        } else {
            echo "<div class='alert alert-danger'>Fehler beim Hochladen des News-Beitrags auf die Datenbank.</div>";
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>News erstellen</title>
</head>

<body class="d-flex flex-column min-vh-100">
    <?php include "./inc/nav.php"; ?>
    <main class="container my-3 flex-fill">
        <section class="vh-100 gradient-custom">
            <div class="row justify-content-center align-items-center ">
                <div class="col-12 col-lg-9 col-xl-7">
                    <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                        <div class="card-body p-4 p-md-5">
                            <h2 class="fw-bold mb-3 mx-auto text-center">News hinzufügen</h2>
                            <form action="news-form.php" method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="newsTitel" class="form-label">Titel</label>
                                    <input type="text" class="form-control" id="newsTitel" name="newsTitel" required>
                                </div>
                                <div class="mb-3">
                                    <label for="newsText" class="form-label">Beschreibung</label>
                                    <textarea class="form-control" id="newsText" name="newsText" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="newsFoto" class="form-label">Foto</label>
                                    <input type="file" class="form-control" id="newsFoto" name="newsFoto"
                                        accept="image/*">
                                    <div class="text-muted mt-1" id="fileHelp">
                                        <label for="newsFoto">Nur JPEG-Dateien.</label>
                                    </div>
                                </div>
                                <button type="submit" id="PostModal" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#successModal">Post</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        You have successfully posted your News!
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                <?php if (isset($success) && $success === true): ?>
                    var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                    successModal.show();
                    setTimeout(function() {
                        successModal.hide();
                    }, 1500);
                <?php endif; ?>
            });
        </script>
    </main>
    <?php include "./inc/footer.php"; ?>
</body>

</html>