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

$stmt = $conn->prepare("SELECT User_ID, Firstname, Lastname, Username, Email, Birthday, status_user FROM User");
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
                        <h5 class="card-title text-uppercase mb-0 text-center">Manage Users</h5>
                        <hr>
                    </div>
                    <div class="table-responsive">
                        <table class="table user-table mb-0 table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="border-0 text-uppercase font-medium pl-4 text-center">#</th>
                                    <th scope="col" class="border-0 text-uppercase font-medium text-center">First Name</th>
                                    <th scope="col" class="border-0 text-uppercase font-medium text-center">Last Name</th>
                                    <th scope="col" class="border-0 text-uppercase font-medium text-center">Username</th>
                                    <th scope="col" class="border-0 text-uppercase font-medium text-center">Email</th>
                                    <th scope="col" class="border-0 text-uppercase font-medium text-center">Birthday</th>
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
                                        echo "<a href='user_data.php?id=" . htmlspecialchars($row['User_ID']) . "' class='btn btn-primary m-1'>User Data</a>";
                                        echo "<a href='reservation_data.php?id=" . htmlspecialchars($row['User_ID']) . "' class='btn btn-primary m-1'>Reservation Data</a>";
                                        echo "<a href='delete_user.php?id=" . htmlspecialchars($row['User_ID']) . "' class='btn btn-danger m-1'>Delete Data</a>";
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
</body>

</html>