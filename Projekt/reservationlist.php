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

$stmt = $conn->prepare("SELECT Reservation_ID, User_ID, Room_ID, Start_Date, End_Date, Status, Breakfast, Parking, Pets FROM Reservation");
$stmt->execute();
$result = $stmt->get_result();
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
                                    <th scope="col" class="border-0 text-uppercase font-medium text-center">First Name
                                    </th>
                                    <th scope="col" class="border-0 text-uppercase font-medium text-center">Last Name
                                    </th>
                                    <th scope="col" class="border-0 text-uppercase font-medium text-center">Username
                                    </th>
                                    <th scope="col" class="border-0 text-uppercase font-medium text-center">Email</th>
                                    <th scope="col" class="border-0 text-uppercase font-medium text-center">Birthday
                                    </th>
                                    <th scope="col" class="border-0 text-uppercase font-medium text-center">Status</th>
                                    <th scope="col" class="border-0 text-uppercase font-medium text-center">Manage</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr class='text-center'>";
                                    echo "<td class='align-middle fw-bold'>" . htmlspecialchars($row['User_ID']) . "</td>";
                                    echo "<td class='align-middle fw-bold'>" . htmlspecialchars($row['Firstname']) . "</td>";
                                    echo "<td class='align-middle fw-bold'>" . htmlspecialchars($row['Lastname']) . "</td>";
                                    echo "<td class='align-middle'>" . htmlspecialchars($row['Username']) . "</td>";
                                    echo "<td class='align-middle'>" . htmlspecialchars($row['Email']) . "</td>";
                                    echo "<td class='align-middle'>" . htmlspecialchars($row['Birthday']) . "</td>";
                                    echo "<td class='align-middle'>" . htmlspecialchars($row['status_user']) . "</td>";
                                    echo "<td class='align-middle'>";
                                    echo "<a href='user_management.php?id=" . htmlspecialchars($row['User_ID']) . "' class='btn btn-primary m-1'>User Data</a>";
                                    echo "<a href='reservation_management.php?id=" . htmlspecialchars($row['User_ID']) . "' class='btn btn-primary m-1'>Reservation Data</a>";
                                    echo "<button class='btn btn-danger m-1' data-bs-toggle='modal' data-bs-target='#CheckDeleteModal' data-user-id='" . htmlspecialchars($row['User_ID']) . "'>Delete Data</button>";
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
                    <h5 class="modal-title">Delete User?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this Reservation?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="confirmDeleteButton" class="btn btn-danger">Delete User</button>
                </div>
            </div>
        </div>
    </div>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll('button[data-bs-toggle="modal"]').forEach(function (button) {
            button.addEventListener('click', function () {
                var userId = this.getAttribute('data-user-id');
                document.getElementById('confirmDeleteButton').setAttribute('data-user-id', userId);
            });
        });

        document.getElementById('confirmDeleteButton').addEventListener('click', function () {
            var userId = this.getAttribute('data-user-id');
            window.location.href = 'user_delete.php?id=' + userId;
        });
    });
</script>
</body>

</html>