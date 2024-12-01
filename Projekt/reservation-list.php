<?php
session_start();

// Überprüfen, ob der Benutzer eingeloggt ist (wird später schöner gemacht)
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo "Bitte loggen Sie sich ein, um Ihre Reservierungen zu sehen.";
    echo '<br><a href="login.php" class="btn btn-primary mt-3">Login</a>';
    exit;
}

// Statische Reservierungsdaten als Platzhalter, später durch Datenbank ersetzt
$reservations = [
    [
        'id' => 1,
        'checkin' => '2024-12-01',
        'checkout' => '2024-12-05',
        'status' => 'bestätigt',
        'breakfast' => true,
        'parking' => false,
        'pets' => true
    ],
    [
        'id' => 2,
        'checkin' => '2024-12-10',
        'checkout' => '2024-12-15',
        'status' => 'storniert',
        'breakfast' => false,
        'parking' => true,
        'pets' => false
    ]
];
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
                    <h1 class="mt-1 text-center">Ihre Reservierungen</h1>
                    <hr class="hr" />
                    <div class="table-responsive">
                        <table class="table table-striped mt-3">
                            <thead>
                                <tr>
                                    <th class="col">ID</th>
                                    <th class="col">Check-in</th>
                                    <th class="col">Check-out</th>
                                    <th class="col">Status</th>
                                    <th class="col">Frühstück</th>
                                    <th class="col">Parken</th>
                                    <th class="col">Haustiere</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($reservations as $reservation) : ?>
                                    <tr>
                                        <td><?php echo $reservation['id']; ?></td>
                                        <td><?php echo $reservation['checkin']; ?></td>
                                        <td><?php echo $reservation['checkout']; ?></td>
                                        <td><?php echo ucfirst($reservation['status']); ?></td>
                                        <td><?php echo $reservation['breakfast'] ? 'Ja' : 'Nein'; ?></td>
                                        <td><?php echo $reservation['parking'] ? 'Ja' : 'Nein'; ?></td>
                                        <td><?php echo $reservation['pets'] ? 'Ja' : 'Nein'; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>                        
                </div>
            </div>
        </div>
    </div>
</div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
