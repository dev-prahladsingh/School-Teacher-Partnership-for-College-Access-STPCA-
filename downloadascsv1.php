<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

// Database connection
include 'database.php';

if (isset($_POST['download_csv'])) {
    // Retrieve form data
    $fields = isset($_POST['fields']) ? explode(',', $_POST['fields']) : [];
    $typeFilter = isset($_POST['typeFilter']) ? $con->real_escape_string($_POST['typeFilter']) : '';

    if (!empty($fields)) {
        // Define your field labels for display
        $fieldLabels = array(
            'name' => 'Name',
            'department' => 'Department',
            'type' => 'Institute Type',
            'address' => 'Address',
            'date' => 'Date',
            'key_name' => 'Key Name',
            'key_cont' => 'Key Contact',
            'key_email' => 'Key Email',
            'key_dob' => 'Key DOB',
            'key_doa' => 'Key DOA',
            'visit_remark' => 'Visit Remark',
            'creation_date' => 'Creation Date',
            'photo_path' => 'Photo Path',
            'region' => 'Region',
            'excel_path' => 'Excel Path',
            'iname' => 'Institute Name'
        );

        // Prepare columns for SQL query and adjust for regions
        $queryFields = [];
        foreach ($fields as $field) {
            if ($field == 'region') {
                $queryFields[] = 'regions.region_name AS region';
            } else {
                $queryFields[] = $field;
            }
        }
        $columns = implode(", ", $queryFields);

        // Build WHERE clause
        $whereClause = " WHERE 1=1"; // Always true to handle optional filters
        if (!empty($typeFilter)) {
            $whereClause .= " AND type = '$typeFilter'";
        }

        // Construct and execute the query
        $query = "SELECT $columns FROM others" . 
                 (in_array('region', $fields) ? " LEFT JOIN regions ON others.region = regions.region_id" : "") . 
                 $whereClause;
        
        $result = $con->query($query);

        if ($result->num_rows > 0) {
            // Output headers to prompt for CSV download
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="filtered_data.csv"');

            // Open output stream
            $output = fopen('php://output', 'w');

            // Output column headers
            fputcsv($output, array_map(function($field) use ($fieldLabels) {
                return $fieldLabels[$field] ?? $field;
            }, $fields));

            // Output data rows
            while ($row = $result->fetch_assoc()) {
                fputcsv($output, array_map(function($field) use ($row) {
                    return $row[$field] ?? '';
                }, $fields));
            }

            // Close output stream
            fclose($output);
        } else {
            echo "No results found.";
        }
    } else {
        echo "No columns selected.";
    }
    $con->close();
    exit();
}
?>
