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

$reservation_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($reservation_id > 0) {
    $sql = "DELETE FROM Reservation WHERE Reservation_ID = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $reservation_id);
        if ($stmt->execute()) {
            header('Location: ' . $_SERVER['HTTP_REFERER']); // redirect zu vorheriger page
        } else {
            echo "Fehler beim Löschen des Reservation.";
        }
        $stmt->close();
    } else {
        echo "Fehler bei der Vorbereitung der SQL-Abfrage.";
    }
} else {
    echo "Ungültige Reservation-ID.";
}
?>