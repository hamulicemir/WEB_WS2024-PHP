<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include './inc/dbconnection.php';
include './inc/functions.php';
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['UserInformation']['Role_ID'] != 1) {
    header('location: login.php');
    exit;
}
if (!$conn) {
    die("Database Connection Failed: " . mysqli_connect_error());
}

$user_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($user_id > 0) {
    $stmt = $conn->prepare("SELECT * FROM Reservation WHERE User_ID = ?");
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $resultReservationPerUser = $stmt->get_result();
}

?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="./picture.stylesheet.css" rel="stylesheet" />
    <title>Pictures</title>
</head>

<body>
    <?php include './inc/nav.php'; ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-uppercase mb-0 text-center">Manage Reservations</h5>
                        <hr>
                    </div>
                    <div class="table-responsive">
                        <table class="table user-table mb-0 table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="border-0 text-uppercase font-medium pl-4 text-center">#</th>
                                    <th scope="col" class="border-0 text-uppercase font-medium text-center">Name
                                    </th>
                                    <th scope="col" class="border-0 text-uppercase font-medium text-center">Username
                                    </th>
                                    <th scope="col" class="border-0 text-uppercase font-medium text-center">Start</th>
                                    <th scope="col" class="border-0 text-uppercase font-medium text-center">End
                                    </th>
                                    <th scope="col" class="border-0 text-uppercase font-medium text-center">Status</th>
                                    <th scope="col" class="border-0 text-uppercase font-medium text-center">Breakfast</th>
                                    <th scope="col" class="border-0 text-uppercase font-medium text-center">Parking</th>
                                    <th scope="col" class="border-0 text-uppercase font-medium text-center">Pets</th>
                                    <th scope="col" class="border-0 text-uppercase font-medium text-center">Manage</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if($resultReservationPerUser->num_rows === 0) {
                                    echo "<tr class='text-center'>";
                                    echo "<td colspan='10' class='align-middle fw-bold'>No reservations found</td>";
                                    echo "</tr>";
                                }
                                while ($row = $resultReservationPerUser->fetch_assoc()) {
                                    $stmt = $conn->prepare("SELECT User_ID, Firstname, Lastname, Username FROM User WHERE User_ID = ?");
                                    $stmt->bind_param('i', $row['User_ID']);
                                    $stmt->execute();
                                    $resultUser = $stmt->get_result();
                                    $resultUser = $resultUser->fetch_assoc();
                                    $stmt->close();
                                    echo "<tr class='text-center'>";
                                    echo "<td class='align-middle fw-bold'>" . htmlspecialchars($row['Reservation_ID']) . "</td>";
                                    echo "<td class='align-middle fw-bold'>" . htmlspecialchars($resultUser['Firstname']) . " " . htmlspecialchars($resultUser['Lastname'])  . "</td>";
                                    echo "<td class='align-middle fw-bold'>" . htmlspecialchars($resultUser['Username']) . "</td>";
                                    echo "<td class='align-middle'>" . htmlspecialchars($row['Start_Date']) . "</td>";
                                    echo "<td class='align-middle'>" . htmlspecialchars($row['End_Date']) . "</td>";
                                    echo "<td class='align-middle'>" . htmlspecialchars($row['Status']) . "</td>";
                                    echo "<td class='align-middle'>" . (htmlspecialchars($row['Breakfast']) == 1 ? "&#10003" : "&#10008;") . "</td>";       
                                    echo "<td class='align-middle'>" . (htmlspecialchars($row['Parking']) == 1 ? "&#10003" : "&#10008;") . "</td>";       
                                    echo "<td class='align-middle'>" . (htmlspecialchars($row['Pets']) == 1 ? "&#10003" : "&#10008;") . "</td>";       

                                    echo "<td class='align-middle'>";
                                    echo "<a href='reservation_management.php?id=" . htmlspecialchars($row['Reservation_ID']) . "' class='btn btn-primary m-1'>Reservation Data</a>";
                                    echo "<button class='btn btn-danger m-1' data-bs-toggle='modal' data-bs-target='#CheckDeleteModal' data-reservation-id='" . htmlspecialchars($row['Reservation_ID']) . "'>Delete Reservation</button>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="CheckDeleteModal" tabindex="-1" aria-labelledby="CheckDeleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Reservation?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this Reservation?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="confirmDeleteButton" class="btn btn-danger">Delete Reservation</button>
                </div>
            </div>
        </div>
    </div>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll('button[data-bs-toggle="modal"]').forEach(function (button) {
            button.addEventListener('click', function () {
                var reservationID = this.getAttribute('data-reservation-id');
                document.getElementById('confirmDeleteButton').setAttribute('data-reservation-id', reservationID);
            });
        });

        document.getElementById('confirmDeleteButton').addEventListener('click', function () {
            var reservationID = this.getAttribute('data-reservation-id');
            window.location.href = 'reservation_delete.php?id=' + reservationID;
        });
    });
</script>
</body>

</html>