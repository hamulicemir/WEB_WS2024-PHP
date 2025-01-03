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

if (!$conn) {
    die("Database Connection Failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $checkin = sanitize_input($_POST['checkin']);
    $checkout = sanitize_input($_POST['checkout']);
    $breakfast = sanitize_input(isset($_POST['breakfast']));
    $parking = sanitize_input(isset($_POST['parking']));
    $pets = sanitize_input(isset($_POST['pets']));
    $room = sanitize_input($_POST['room']);
    $roomNo = null;
    if (isset($room)) {
        switch ($room) {
            case "SingleBed":
                $roomNo = 1;
                break;
            case "TwoBed":
                $roomNo = 2;
                break;
            case "Penthouse":
                $roomNo = 3;
                break;
            default:
                $roomNo = null;
        }
    } else {
        $roomNo = null;
    }

    // Validierung des Datums
    if (strtotime($checkout) <= strtotime($checkin)) {
        $error[] = "Das Abreisedatum muss nach dem Anreisedatum liegen.";
    }
    if (strtotime($checkin) < strtotime(date('Y-m-d'))) {
        $error[] = "Das Anreisedatum muss in der Zukunft liegen.";
    }

    if (empty($error)) {
        $status = "Pending";
        $stmt = $conn->prepare("INSERT INTO Reservation (Start_Date, End_Date, Breakfast, Parking, Pets, User_ID, Room_ID, Status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiiiiis", $checkin, $checkout, $breakfast, $parking, $pets, $_SESSION['UserInformation']['User_ID'], $roomNo, $status);
        if ($stmt->execute()) {
            $stmt->close();
            $success = TRUE;
            $successMsg = "You have successfully created a reservation!";
        } else {
            $success = FALSE;
            $errorMsg = "An error occurred while creating the reservation.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./reservation.stylesheet.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .rounded-corners {
            border-radius: 10px;
        }
    </style>
    <title>Reservation</title>
</head>

<body class="d-flex flex-column min-vh-100">
    <?php include './inc/nav.php'; ?>
    <main class="container my-3 flex-fill">
        <div class="container">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-12 col-lg-9 col-xl-7">
                    <div class="card shadow-2-strong rounded-corners">
                        <div class="card-body p-4">
                            <h1 class="mt-1 text-center">Room Reservation</h1>
                            <hr>
                            <?php if (isset($errorMsg)): ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo $errorMsg; ?>
                                </div>
                            <?php endif; ?>

                            <?php if (isset($successMsg)): ?>
                                <div class="alert alert-success" role="alert">
                                    <?php echo $successMsg; ?>
                                </div>
                            <?php endif; ?>

                            <h4 class="mt-4 mb-4"><u>New Room Reservation</u></h4>
                            <form method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="checkin">Arrival Date:</label>
                                            <input type="date" class="form-control" id="checkin" name="checkin"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="checkout">Departure Date:</label>
                                            <input type="date" class="form-control" id="checkout" name="checkout"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="breakfast"
                                                name="breakfast">
                                            <label class="form-check-label" for="breakfast">Breakfast</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="parking" name="parking">
                                            <label class="form-check-label" for="parking">Parking</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="pets" name="pets">
                                            <label class="form-check-label" for="pets">Pets</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-3 mb-4">
                                        <label for="room">Room Selection</label>
                                        <select class="form-select" id="room" name="room" required="">
                                            <option value="SingleBed">Single Bed</option>
                                            <option value="TwoBed">Two Bed</option>
                                            <option value="Penthouse">Penthouse Suit</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#exampleModalCenter">
                                    Reserve
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Price Proposal</h5>
                                                <button type="button" class="btn-close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Room Price:</strong> €<?php ; ?></p>
                                                <p><strong>Extras:</strong></p>
                                                <!--
                                                <ul>
                                                    <?php if ($breakfast): ?>
                                                        <li>Breakfast: €<?php ; ?>
                                                        </li>
                                                    <?php endif; ?>
                                                    <?php if ($parking): ?>
                                                        <li>Parking: €<?php ; ?></li>
                                                    <?php endif; ?>
                                                    <?php if ($pets): ?>
                                                        <li>Pets: €<?php ; ?></li>
                                                    <?php endif; ?>
                                                </ul>
                                                    -->
                                                <hr>
                                                <p><strong>Total Price:</strong> €</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Confirm
                                                    Reservation</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="modal fade" id="ErrorModal" tabindex="-1" aria-labelledby="ErrorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-body">
                    The following issues have occurred:
                    <?php
                    foreach ($error as $err) {
                        echo "<li>" . sanitize_input($err) . "</li>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            <?php if (isset($error) && !empty($error)): ?>
                var ErrorModal = new bootstrap.Modal(document.getElementById('ErrorModal'));
                ErrorModal.show();
            <?php endif; ?>
        }); 1
    </script>


    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    You have successfully created a reservation!
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            <?php if (isset($success) && $success === true): ?>
                var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                successModal.show();
            <?php endif; ?>
        });
    </script>
    <?php include './inc/footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>