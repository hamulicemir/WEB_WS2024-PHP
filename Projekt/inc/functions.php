<?php 

function sanitize_input($input): string {
    $output = trim($input);
    $output = stripslashes($output);
    $output = htmlspecialchars($output);
    return $output;
}

function validate_Repeat_Password($p, $repeatP) : bool{
  return $repeatP === $p;
}

function processNewsImage($file) : bool
{
    $thumbDir = __DIR__ . '/Pictures/Thumbnails/';

    if (!is_dir($thumbDir)) {
        mkdir($thumbDir, 0777, true);
    }

    // Überprüfen, ob das hochgeladene Bild ein JPEG ist
    $fileType = mime_content_type($file['tmp_name']);
    if ($fileType != 'image/jpeg') {
        echo "<div class='alert alert-danger'>Fehler: Nur JPEG-Bilder sind erlaubt.</div>";
        return false;
    }

    $thumbnailPath = $thumbDir . basename($file['name']);
    if (!createThumbnail($newsImagePath, $thumbnailPath, 720, 480)) {
        echo "<div class='alert alert-danger'>Fehler beim Erstellen des Thumbnails.</div>";
        return false;
    }

    echo "<div class='alert alert-success'>News-Bild und Thumbnail wurden erfolgreich erstellt.</div>";
    return true;
}

function createThumbnail($srcPath, $destPath, $width, $height) : bool
{
    $srcImage = imagecreatefromjpeg($srcPath);
    if (!$srcImage) {
        return false;
    }

    // Originalbild-Größe ermitteln
    $origWidth = imagesx($srcImage);
    $origHeight = imagesy($srcImage);

    // Thumbnail-Ressource erstellen
    $thumbImage = imagecreatetruecolor($width, $height);

    // Originalbild auf Thumbnail-Größe skalieren
    if (!imagecopyresampled($thumbImage, $srcImage, 0, 0, 0, 0, $width, $height, $origWidth, $origHeight)) {
        return false;
    }

    // Thumbnail als JPEG speichern
    if (!imagejpeg($thumbImage, $destPath)) {
        return false;
    }

    // Speicher freigeben
    imagedestroy($srcImage);
    imagedestroy($thumbImage);

    return true;
}
?>