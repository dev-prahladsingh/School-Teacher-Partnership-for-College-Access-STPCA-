<?php
include 'database.php';

$user_id = $_GET['user_id'];

$sql = "SELECT schools as name, status FROM faculty_data WHERE user_id = $user_id";
$result = $con->query($sql);

$data = '<ul>';
while ($row = $result->fetch_assoc()) {
    $data .= "<li>{$row['name']} - {$row['status']}</li>";
}
$data .= '</ul>';

echo $data;
$con->close();
?>
