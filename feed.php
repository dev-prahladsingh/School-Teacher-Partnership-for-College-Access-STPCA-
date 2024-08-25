<?php
// Include database connection
include('database.php');

// Fetch data from faculty_data table where status is Completed or Expired
$sql1 = "SELECT name, department, schools, status, tedate, creation_date FROM faculty_data WHERE status = 'Expired'";
$result1 = $con->query($sql1);

// Fetch data from others table
$sql2 = "SELECT name, department, type,iname, creation_date FROM others";
$result2 = $con->query($sql2);

$sql3 = "SELECT name, department, schools, date FROM faculty_fill_data ";
$result3 = $con->query($sql3);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Data Feed</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
    <style>
        
        table.dataTable thead th {
            border-bottom: 2px solid #dee2e6;
        }
        table.dataTable tbody td {
            vertical-align: middle;
        }
          .highlighted-text {
            text-transform: uppercase;
            color: #610C9F;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <table id="facultyTable" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Serial Number</th>
                    <th>Message</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $serialNumber = 1;

                // Output data from faculty_data table
                if ($result1->num_rows > 0) {
                    while($row = $result1->fetch_assoc()) {
                       
                            $message = 'The <span class="highlighted-text">' . htmlspecialchars($row['schools']) . '</span> allotted to <span class="highlighted-text" >' . htmlspecialchars($row['name']) . '</span> from ' . htmlspecialchars($row['department']) . ' department has expired because target date ' . htmlspecialchars($row['tedate']) . ' has passed.';
                       
                        $date = htmlspecialchars($row['creation_date']);
                        echo '<tr>';
                        echo '<td>' . $serialNumber . '</td>';
                        echo '<td>' . $message . '</td>';
                        echo '<td>' . $date . '</td>';
                        echo '</tr>';
                        $serialNumber++;
                    }
                }

                // Output data from others table
                if ($result2->num_rows > 0) {
                    while($row = $result2->fetch_assoc()) {
                        $message = '<span class="highlighted-text" >' . htmlspecialchars($row['name']) . '</span> from ' . htmlspecialchars($row['department']) . ' department has collected the data from <span class="highlighted-text" >' . htmlspecialchars($row['type']) .'('. htmlspecialchars($row['iname']) . ')</span>.';
                        $date = htmlspecialchars($row['creation_date']);
                        echo '<tr>';
                        echo '<td>' . $serialNumber . '</td>';
                        echo '<td>' . $message . '</td>';
                        echo '<td>' . $date . '</td>';
                        echo '</tr>';
                        $serialNumber++;
                    }
                }


 if ($result3->num_rows > 0) {
                    while($row = $result3->fetch_assoc()) {
                       
                        $message = '<span class="highlighted-text" >' . htmlspecialchars($row['name']) . '</span> from ' . htmlspecialchars($row['department']) . ' department has collected the data from <span class="highlighted-text" >' . htmlspecialchars($row['schools']) . '</span>.';
                       
                        $date = htmlspecialchars($row['date']);
                        echo '<tr>';
                        echo '<td>' . $serialNumber . '</td>';
                        echo '<td>' . $message . '</td>';
                        echo '<td>' . $date . '</td>';
                        echo '</tr>';
                        $serialNumber++;
                    }
                }
                if ($serialNumber == 1) {
                    echo '<tr><td colspan="3">No records found.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Include DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#facultyTable').DataTable({
                "responsive": true,
                "autoWidth": false
            });
        });
    </script>
</body>
</html>

<?php
$con->close();
?>
