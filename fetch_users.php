<?php
include 'database.php';

$department = $_GET['department'];
$sql = "SELECT id, name FROM usersss WHERE department = '$department'";
$result = $con->query($sql);

$users = [];
while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}

echo json_encode($users);
$con->close();
?>
