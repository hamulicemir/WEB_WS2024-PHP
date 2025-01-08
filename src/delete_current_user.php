<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include './inc/dbconnection.php';
include './inc/functions.php';
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('location: login.php');
    exit;
}
if(!$conn){ die("Database Connection Failed: " . mysqli_connect_error());  }

$currentUserID = $_SESSION['UserInformation']['User_ID'];

if ($currentUserID > 0) {
    $sql = "DELETE FROM User WHERE User_ID = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $currentUserID);
        if ($stmt->execute()) {
            header('Location: logout.php'); 
        } else {
            echo "Fehler beim Löschen des Benutzers.";
        }
        $stmt->close();
    } else {
        echo "Fehler bei der Vorbereitung der SQL-Abfrage.";
    }
} else {
    echo "Ungültige Benutzer-ID.";
}
?>