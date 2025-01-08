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

function createThumbnail($srcPath, $destPath, $width, $height): bool
{
    if (!file_exists($srcPath)) {
        echo "<div class='alert alert-danger'>Fehler: Quelldatei $srcPath existiert nicht.</div>";
        return false;
    }

    $imageInfo = getimagesize($srcPath);
    if ($imageInfo === false || $imageInfo[2] !== IMAGETYPE_JPEG) {
        echo "<div class='alert alert-danger'>Fehler: Bildinformationen konnten nicht abgerufen werden oder das Bild ist kein JPEG.</div>";
        return false;
    }
    
    $fileExtension = strtolower(pathinfo($srcPath, PATHINFO_EXTENSION));
    if ($fileExtension !== 'jpeg') {
        echo "<div class='alert alert-danger'>Fehler: Die Datei ist keine JPEG-Datei.</div>";
        return false;
    }

    $srcWidth = $imageInfo[0];
    $srcHeight = $imageInfo[1];
    if ($srcWidth < $width || $srcHeight < $height) {
        echo "<div class='alert alert-danger'>createThumbnail: Originalbild ist kleiner als das gewünschte Thumbnail.</div>";
        return false;
    }

    $srcImage = imagecreatefromjpeg($srcPath);
    if ($srcImage === false) {
        echo "<div class='alert alert-danger'>Fehler: Das Quellbild $srcPath konnte nicht geladen werden.</div>";
        return false;
    }

    $thumbnail = imagecreatetruecolor($width, $height);
    if ($thumbnail === false) {
        echo "<div class='alert alert-danger'>Fehler: Fehler beim Erstellen der Thumbnail-Ressource.</div>";
        imagedestroy($srcImage);
        return false;
    }

    $srcWidth = imagesx($srcImage);
    $srcHeight = imagesy($srcImage);

    if ($srcWidth < $width || $srcHeight < $height) {
        echo "<div class='alert alert-danger'>Fehler: Originalbild ist kleiner als das gewünschte Thumbnail ($srcWidth x $srcHeight) < ($width x $height).</div>";
        imagedestroy($srcImage);
        imagedestroy($thumbnail);
        return false;
    }

    if (!imagecopyresampled($thumbnail, $srcImage, 0, 0, 0, 0, $width, $height, $srcWidth, $srcHeight)) {
        echo "<div class='alert alert-danger'>Fehler: Fehler beim Resampling des Bildes.</div>";
        imagedestroy($srcImage);
        imagedestroy($thumbnail);
        return false;
    }

    if (!imagejpeg($thumbnail, $destPath)) {
        echo "<div class='alert alert-danger'>Fehler: Fehler beim Speichern des Thumbnails nach $destPath.</div>";
        imagedestroy($srcImage);
        imagedestroy($thumbnail);
        return false;
    }

    imagedestroy($srcImage);
    imagedestroy($thumbnail);

    return true;
}

function updateUserInformation($Username){
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM User WHERE Username = ?");
    $stmt->bind_param("s", $Username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $_SESSION["UserInformation"] = $user;
    $stmt->close();
}

function UsernameAvailable($Username){
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM User WHERE Username = ?");
    $stmt->bind_param("s", $Username);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    return $result->num_rows === 0;
}
?>