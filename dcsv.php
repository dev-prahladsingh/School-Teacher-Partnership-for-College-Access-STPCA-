<?php
include 'database.php';

$department = $_GET['department'];
$user_id = $_GET['user_id'];

// Set CSV header
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="data_export.csv"');

// Open output stream
$output = fopen('php://output', 'w');

// Add CSV header row
fputcsv($output, ['#', 'Name', 'Department', 'Allotted Schools', 'Pending', 'Completed', 'School Name', 'Status']);

// SQL query based on filters
$sql = "SELECT * FROM usersss WHERE 1=1";
if ($department) {
    $sql .= " AND department = '$department'";
}
if ($user_id) {
    $sql .= " AND id = $user_id";
}
$sql .= " ORDER BY id DESC";

$result = $con->query($sql);

while ($row_user = $result->fetch_assoc()) {
    $user_id = $row_user['id'];
    $username = $row_user['name'];
    $department = $row_user['department'];

    // Fetch school counts
    $sql_schools_count = "SELECT COUNT(*) as total_schools FROM faculty_data WHERE user_id = $user_id";
    $result_schools_count = $con->query($sql_schools_count);
    $total_schools = $result_schools_count->fetch_assoc()['total_schools'];

    $sql_pending_count = "SELECT COUNT(*) as pending_schools FROM faculty_data WHERE user_id = $user_id AND status = 'Pending'";
    $result_pending_count = $con->query($sql_pending_count);
    $pending_schools = $result_pending_count->fetch_assoc()['pending_schools'];

    $sql_completed_count = "SELECT COUNT(*) as completed_schools FROM faculty_data WHERE user_id = $user_id AND status = 'Completed'";
    $result_completed_count = $con->query($sql_completed_count);
    $completed_schools = $result_completed_count->fetch_assoc()['completed_schools'];

    // Fetch schools details
    $sql_schools = "SELECT schools, status FROM faculty_data WHERE user_id = $user_id";
    $result_schools = $con->query($sql_schools);

    if ($result_schools->num_rows > 0) {
        while ($row_school = $result_schools->fetch_assoc()) {
            fputcsv($output, [
                $user_id,
                $username,
                $department,
                $total_schools,
                $pending_schools,
                $completed_schools,
                $row_school['schools'],
                $row_school['status']
            ]);
        }
    } else {
        // Add a row for users with no schools
        fputcsv($output, [
            $user_id,
            $username,
            $department,
            $total_schools,
            $pending_schools,
            $completed_schools,
            'No data available',
            ''
        ]);
    }
}

fclose($output);
$con->close();
?>
