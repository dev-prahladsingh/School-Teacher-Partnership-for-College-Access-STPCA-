<?php
include('database.php');
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $department = $_POST['department'];
    $schools = $_POST['schools'];
    $board = $_POST['board'];
    $date = $_POST['date'];
    $pname = $_POST['pname'];
    $pcont = $_POST['pcont'];
    $twelve = $_POST['twelve'];
    $topic_covered = $_POST['topic_covered'];
    $visit_remark = $_POST['visit_remark'];

    $sql = "UPDATE faculty_fill_data SET name='$name', department='$department', schools='$schools', board='$board', date='$date', pname='$pname', pcont='$pcont', twelve='$twelve', topic_covered='$topic_covered', visit_remark='$visit_remark' WHERE id='$id'";

    if ($con->query($sql) === TRUE) {
        header("Location: user_data_fill.php?id=$id");
    } else {
        echo "Error updating record: " . $con->error;
    }

    $con->close();
}
?>
