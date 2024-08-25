<?php
// Include the database configuration file
include '../database.php';

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Delete student record
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM students WHERE id=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        header("Location: upload.php");
    } else {
        echo "Error deleting record: " . $con->error;
    }

    $stmt->close();
}

// Close connection
$con->close();
?>
