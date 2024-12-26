<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include("dbaccess.php");
global $conn;
if (!isset($conn) || $conn === null) {
    $conn = new mysqli($host, $user, $password, $database);
    if ($conn->connect_error) {
        die("Verbindung fehlgeschlagen: " . $conn->connect_error);
    }
}
?>