<?php
include 'database.php';

$department = $_GET['department'];
$user_id = $_GET['user_id'];

$sql = "SELECT * FROM usersss WHERE 1=1";
if ($department) {
    $sql .= " AND department = '$department'";
}
if ($user_id) {
    $sql .= " AND id = $user_id";
}
$sql .= " ORDER BY id DESC";

$result = $con->query($sql);
$data = '';

while ($row_user = $result->fetch_assoc()) {
    $user_id = $row_user['id'];
    $username = $row_user['name'];
    $department = $row_user['department'];

    $sql_schools_count = "SELECT COUNT(*) as total_schools FROM faculty_data WHERE user_id = $user_id";
    $result_schools_count = $con->query($sql_schools_count);
    $total_schools = $result_schools_count->fetch_assoc()['total_schools'];

    $sql_pending_count = "SELECT COUNT(*) as pending_schools FROM faculty_data WHERE user_id = $user_id AND status = 'Pending'";
    $result_pending_count = $con->query($sql_pending_count);
    $pending_schools = $result_pending_count->fetch_assoc()['pending_schools'];

    $sql_completed_count = "SELECT COUNT(*) as completed_schools FROM faculty_data WHERE user_id = $user_id AND status = 'Completed'";
    $result_completed_count = $con->query($sql_completed_count);
    $completed_schools = $result_completed_count->fetch_assoc()['completed_schools'];

    $data .= "<tr>
                <td>$user_id</td>
                <td>$username</td>
                <td>$department</td>
                <td>$total_schools</td>
                <td>$pending_schools</td>
                <td>$completed_schools</td>
                <td><button class='dropdown' data-user-id='$user_id'>▼</button></td>
              </tr>";
}

echo $data;
$con->close();
?>
