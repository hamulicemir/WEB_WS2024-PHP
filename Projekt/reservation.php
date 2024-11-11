<?php
session_start();

// Überprüfen, ob der Benutzer eingeloggt ist
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo "Bitte loggen Sie sich ein, um eine Reservierung vorzunehmen.";
    echo '<br><a href="login.php" class="btn btn-primary mt-3">Login</a>';
    exit;
}

// Statische Reservierungsdaten als Platzhalter
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

// Wenn das Formular für eine neue Reservierung abgeschickt wurde
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    $breakfast = isset($_POST['breakfast']);
    $parking = isset($_POST['parking']);
    $pets = isset($_POST['pets']);

    // Validierung des Datums
    if (strtotime($checkout) <= strtotime($checkin)) {
        $error = "Das Abreisedatum muss nach dem Anreisedatum liegen.";
    } else {
        // Neue Reservierung (nur zur Anzeige, keine Speicherung)
        $newReservation = [
            'id' => count($reservations) + 1,
            'checkin' => htmlspecialchars($checkin),
            'checkout' => htmlspecialchars($checkout),
            'status' => 'neu',
            'breakfast' => $breakfast,
            'parking' => $parking,
            'pets' => $pets
        ];

        $reservations[] = $newReservation;
        $success = "Reservierung erfolgreich erstellt.";
    }
}
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
            border-radius: 10px; /* Beispielwert, anpassen nach Bedarf */
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
                        <h1 class="mt-1 text-center">Zimmerreservierung</h1>

                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $error; ?>
                            </div>
                        <?php endif; ?>

                        <?php if (isset($success)): ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo $success; ?>
                            </div>
                        <?php endif; ?>

                        <h4 class="mt-4">Neue Zimmerreservierung anlegen</h4>
                        <form method="post" class="mb-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="checkin">Anreisedatum:</label>
                                        <input type="date" class="form-control" id="checkin" name="checkin" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="checkout">Abreisedatum:</label>
                                        <input type="date" class="form-control" id="checkout" name="checkout" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="breakfast" name="breakfast">
                                        <label class="form-check-label" for="breakfast">Frühstück</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="parking" name="parking">
                                        <label class="form-check-label" for="parking">Parkplatz</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="pets" name="pets">
                                        <label class="form-check-label" for="pets">Haustiere</label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Reservieren</button>
                        </form>
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