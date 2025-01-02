<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include './inc/dbconnection.php';
include './inc/functions.php';
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
   header('Location: login.php');
}

if(!$conn){ die("Database Connection Failed: " . mysqli_connect_error());  }
   

// Statische Reservierungsdaten als Platzhalter, später durch Datenbank ersetzt
$stmt = $conn->prepare("SELECT * FROM Reservation WHERE User_ID = ?");
$stmt->bind_param("s", $_SESSION['UserInformation']['User_ID']);
$stmt->execute();
$result = $stmt->get_result();
$reservations = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
$_SESSION["ReservationInformation"] = $reservations;
?>
<!DOCTYPE html>
<html lang="de">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./reservation.stylesheet.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .rounded-corners {
            border-radius: 10px;
        }
    </style>
    <title>Reservation</title>
</head>
<body>
    <?php include './inc/nav.php'; ?>
    <div class="container">
    <div class="row justify-content-center align-items-center h-100">
        <div class="col-12 col-lg-9 col-xl-7">
            <div class="card shadow-2-strong rounded-corners">
                <div class="card-body p-4 p-md-2">
                    <h1 class="mt-1 text-center">Your Reservations</h1>
                    <hr class="hr"/>
                    <div class="table-responsive">
                        <table class="table table-striped mt-3">
                            <thead>
                                <tr>
                                    <th class="col">ID</th>
                                    <th class="col">Check-in</th>
                                    <th class="col">Check-out</th>
                                    <th class="col">Status</th>
                                    <th class="col">Breakfast</th>
                                    <th class="col">Parking</th>
                                    <th class="col">Pets</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($reservations)) : ?>
                                    <?php foreach ($reservations as $reservation) : ?>
                                        <tr>
                                            <td><?php echo $reservation['Reservation_ID']; ?></td>
                                            <td class="fw-bold"><?php echo $reservation['Start_Date']; ?></td>
                                            <td class="fw-bold"><?php echo $reservation['End_Date']; ?></td>
                                            <td><?php echo ucfirst($reservation['Status']); ?></td>
                                            <td><?php echo $reservation['Breakfast'] ? 'Ja' : 'Nein'; ?></td>
                                            <td><?php echo $reservation['Parking'] ? 'Ja' : 'Nein'; ?></td>
                                            <td><?php echo $reservation['Pets'] ? 'Ja' : 'Nein'; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="7" class="text-center">No reservations found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>                        
                </div>
            </div>
        </div>
    </div>
</div>
<?php include './inc/footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>