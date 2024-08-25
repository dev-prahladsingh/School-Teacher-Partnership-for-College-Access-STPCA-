<?php
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $region_id = $_POST['region_id'];
    $region_name = $_POST['region_name'];

    $query = "UPDATE regions SET region_name = '$region_name' WHERE region_id = $region_id";
    mysqli_query($con, $query);

    header('Location: fetch_regions.php');
}
?>
