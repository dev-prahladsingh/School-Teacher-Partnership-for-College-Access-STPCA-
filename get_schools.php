<?php
// Database connection setup
include 'database.php';

if (isset($_GET['region_id'])) {
    $region_id = $_GET['region_id'];

    // Retrieve schools based on the selected region
    $school_query = "SELECT school_name,board,address FROM schools WHERE region_id = ?";
    $stmt = $con->prepare($school_query);
    $stmt->bind_param("i", $region_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $schools = array();

    while ($row = $result->fetch_assoc()) {
        // Check if the school has been allotted and the status is completed
        $check_allotment_query = "SELECT * FROM faculty_data WHERE schools = ? AND status != 'Completed'";
        $check_stmt = $con->prepare($check_allotment_query);
        $check_stmt->bind_param("s", $row['school_name']);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

        if ($check_result->num_rows == 0) {
            $schools[] = $row;
        }
    }

    echo json_encode($schools);
} else {
    echo json_encode(array());
}
?>
