<?php
session_start();
include "./inc/functions.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newsTitel = sanitize_input($_POST['newsTitel']);
    $newsText = sanitize_input($_POST['newsText']);

    if (isset($_FILES['newsFoto']) && $_FILES['newsFoto']['error'] == 0) {
        $thumbDir = './Pictures/Thumbnails/';
        $resizedDir = './Pictures/Thumbnails-resized/';

        if (!is_dir($thumbDir)) {
            mkdir($thumbDir, 0777, true);
        }
        if (!is_dir($resizedDir)) {
            mkdir($resizedDir, 0777, true);
        }

        // Pfade definieren
        $thumbName = $thumbDir . $newsText . ".jpeg";
        $destinationPath = $resizedDir . $newsText . ".jpeg";

        // Datei verschieben
        if (move_uploaded_file($_FILES['newsFoto']['tmp_name'], $thumbName)) {
            echo "<div class='alert alert-success'>News-Beitrag wurde erfolgreich erstellt und das Bild hochgeladen.</div>";

            // Thumbnail erstellen
            if (createThumbnail($thumbName, $destinationPath, 640, 360)) { //720x480 auch möglich
                echo "<div class='alert alert-success'>Thumbnail erfolgreich erstellt.</div>";
            } else {
                echo "<div class='alert alert-danger'>Fehler beim Erstellen des Thumbnails.</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Fehler beim Hochladen des Bildes.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Fehler beim Hochladen des Bildes.</div>";
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
                        <form action="" method="POST" enctype="multipart/form-data">
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
                                       accept="image/*" required>
                                <div class="text-muted mt-1" id="fileHelp">
                                    <label for="newsFoto">Nur JPEG-Dateien.</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Post</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php include "./inc/footer.php"; ?>
</body>

</html>