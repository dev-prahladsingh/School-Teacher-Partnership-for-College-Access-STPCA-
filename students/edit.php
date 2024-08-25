<?php
// Include the database configuration file
include '../database.php';

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Update student data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $mobile_number = $_POST['mobile_number'];
    $school_name = $_POST['school_name'];
    $department = $_POST['department'];
    $region = $_POST['region'];
    $year = $_POST['year'];

    $sql = "UPDATE students SET name=?, mobile_number=?, school_name=?, department=?, region=?, year=? WHERE id=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('ssssssi', $name, $mobile_number, $school_name, $department, $region, $year, $id);

    if ($stmt->execute()) {
        header("Location: upload.php");
    } else {
        echo "Error updating record: " . $con->error;
    }

    $stmt->close();
}

// Close connection
$con->close();
?>
