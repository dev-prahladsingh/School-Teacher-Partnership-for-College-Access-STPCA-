<?php
include 'database.php';

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $region_name = $_POST['region_name'];

    // Insert data into the database
    $sql = "INSERT INTO regions (region_name) VALUES ('$region_name')";

    if ($con->query($sql) === TRUE) {
        $response['success'] = true;
        $response['message'] = "New region registered successfully";
    } else {
        $response['success'] = false;
        $response['message'] = "Error: " . $sql . "<br>" . $con->error;
    }
} else {
    $response['success'] = false;
    $response['message'] = "Invalid request method";
}

header('Content-Type: application/json');
echo json_encode($response);
?>
