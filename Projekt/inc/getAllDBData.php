<?php 

require_once('dbaccess.php');
$db_obj = new mysqli($host, $user, $password, $database);

if ($db_obj->connect_error) {
    echo "Connection Error: " . $db_obj->connect_error;
    exit();
}

$sql = "SELECT * FROM `User`";
$result = $db_obj->query($sql);

while ($row = $result->fetch_array()) {
    echo "id: " . $row['User_ID'] . "<br>";
    echo "username: " . $row['Username'] . "<br>";
    echo "useremail: " . $row['Email'] . "<br>";
    echo "password: " . $row['Password'] . "<br>";
    echo "Role_ID: " . $row['Role_ID'] . "<br>";
    echo "First Name: " . $row['Firstname'] . "<br>";
    echo "Nach Name: " . $row['Lastname'] . "<br>";
    echo "Birthday: " . $row['Birthday'] . "<br>";
    echo "Gender " . $row['Gender'] . "<br>";
    echo "Status: " . $row['Status'] . "<br>";
    echo "<br>";
}
?> 