<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: index.php");
    exit();
}

// Database connection
include 'database.php';

// Fetch distinct types for the dropdown
$typeQuery = "SELECT DISTINCT type FROM others";
$typeResult = $con->query($typeQuery);

$types = [];
if ($typeResult->num_rows > 0) {
    while ($row = $typeResult->fetch_assoc()) {
        $types[] = $row['type'];
    }
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="dashboard.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link href='sidebar.css' rel='stylesheet'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel || Dashboard</title>
  <style>
   table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #dee2e6;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #a2a8d3;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #fff;
        }

        tr:nth-child(odd) {
            background-color: #e7eaf6;
        }
    .dropdown {
      position: relative;
      display: inline-block;
    }

    .dropdown-toggle {
      background-color: transparent;
      border: none;
      cursor: pointer;
      padding: 8px 16px;
    }

    .dropdown-menu {
      display: none;
      position: absolute;
      background-color: #fff;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      z-index: 1;
      list-style-type: none;
      padding: 0;
    }

    .dropdown-menu li {
      padding: 8px 16px;
    }

    .dropdown-menu li:hover {
      background-color: #f2f2f2;
    }

    .dropdown:hover .dropdown-menu {
      display: block;
    }

    .profile-avatar {
      width: 40px;
      height: 40px;
      border-radius: 50%;
    }

    .chart-container {
      display: flex;
      justify-content: space-around;
      margin: 20px 0;
    }

    .chart {
      width: 45%;
    }
  </style>
</head>

<body>
  <div class="sidebar">
    <div class="logo-details">
      <span class="logo_name" style="margin-left:1px">
        <img width="59" height="55" src="kcmtlogos.jpg" alt="d"/>
      </span>
      <h5 style="color:#fff;text-align:center;">OTHERS</h5>
    </div>
    <ul class="nav-links">
      <li>
        <a href="others_user.php">
<i class='bx bx-grid-alt'></i>
          <span class="links_name">Data Dashboard</span>
        </a>
      </li>
      <li>
        <a href="others.php">
<i class='bx bx-group'></i>
          <span class="links_name">Others Form</span>
        </a>
      </li>
      <li>
        <a href="user_other_filters.php"  class="active">
<i class='bx bx-line-chart'></i>
          <span class="links_name">Data Analytics</span>
        </a>
      </li>
      <li>
        <a href="user_other_completed.php">
          <i class='bx bx-calendar-check'></i>
          <span class="links_name">Completed Data</span>
        </a>
      </li>
     <li class="log_out">
          <a href="user_main.php">
            <i class='bx bx-log-out bx-fade-left-hover'></i>
            <span class="links_name">Home Page</span>
          </a>
        </li>
    </ul>
  </div>
  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Data Analytics</span>
      </div>
      <div class="avt dropdown">
        <button class="dropdown-toggle" id="profile-dropdown-toggle">
          <img src="pro_avt.png" alt="Profile Avatar" class="profile-avatar">
        </button>
        <ul class="dropdown-menu" id="profile-dropdown">
          <li><a href="Profile.php?id=<?php echo $_SESSION['id']; ?>">Profile</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </div>
    </nav>

    <div class="home-content">
 <!-- Filter Button -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#filterModal">
    Filters
</button>

<!-- Modal -->
<div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterModalLabel">Select Columns to Display</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    <?php
                    $fields = [
                        'name' => 'Name',
                        'department' => 'Department',
                        'type' => 'Institute Type',
                        'address' => 'Address',
                        'date' => 'Date',
                        'key_name' => 'Key Name',
                        'key_cont' => 'Key Contact',
                        'key_email' => 'Key Email',
                        'key_dob' => 'Key Date of Birth',
                        'key_doa' => 'Key Date of Appointment',
                        'visit_remark' => 'Visit Remark',
                        'region' => 'Region',
                        'iname' => 'Institute Name'  // Added iname column
                    ];

                    foreach ($fields as $field => $label) {
                        echo "<div class='form-check'>
                                <input class='form-check-input' type='checkbox' name='fields[]' value='$field' id='$field'>
                                <label class='form-check-label' for='$field'>$label</label>
                              </div>";
                    }
                    ?>
                    <div class="form-group mt-3">
                        <label for="typeFilter">Filter by Type:</label>
                        <select class="form-control" id="typeFilter" name="typeFilter">
                            <option value="">All</option>
                            <?php
                            foreach ($types as $type) {
                                echo "<option value='$type'>$type</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" name="filter" class="btn btn-primary">Apply Filters</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- PHP Code to Handle Form Submission and Display Table -->
<?php
if (isset($_POST['filter'])) {
    if (!empty($_POST['fields'])) {
        // Define your field labels for display
        $fieldLabels = array(
            'user_id' => 'User ID',
            'name' => 'Name',
            'department' => 'Department',
            'type' => 'Institute Type',
            'address' => 'Address',
            'date' => 'Date',
            'key_name' => 'Key Name',
            'key_cont' => 'Key Contact',
            'key_email' => 'Key Email',
            'key_dob' => 'Key Date of Birth',
            'key_doa' => 'Key Date of Appointment',
            'visit_remark' => 'Visit Remark',
            'creation_date' => 'Creation Date',
            'photo_path' => 'Photo Path',
            'region' => 'Region',
            'excel_path' => 'Excel Path',
            'iname' => 'Institute Name'  // Added iname column
        );

        // Get the user ID from session
        $faculty_id = isset($_SESSION['id']) ? $con->real_escape_string($_SESSION['id']) : '';

        // Get selected fields and create query columns
        $selectedFields = $_POST['fields'];

        // Check if 'region' is in the selected fields and replace it with the region name
        if (in_array('region', $selectedFields)) {
            $selectedFields = array_diff($selectedFields, array('region'));
            $selectedFields[] = 'regions.region_name AS region_name';
            $fieldLabels['region_name'] = 'Region Name';
        }

        $columns = implode(", ", $selectedFields);

        // Get the filter type
        $typeFilter = $con->real_escape_string($_POST['typeFilter']);
        $whereClause = " WHERE others.user_id = '$faculty_id'"; // Filter by user_id

        if (!empty($typeFilter)) {
            $whereClause .= " AND others.type = '$typeFilter'";
        }

        // Construct and execute the query
        $query = "SELECT $columns FROM others 
                  LEFT JOIN regions ON others.region = regions.region_id" . $whereClause;
        $result = $con->query($query);

        if ($result->num_rows > 0) {
            echo "<table class='table'>
                    <thead>
                        <tr>";
            foreach ($selectedFields as $field) {
                // Ensure the field exists in the labels array
                // Adjust the field name for the region
                if ($field == 'regions.region_name AS region_name') {
                    $field = 'region_name';
                }
                if (array_key_exists($field, $fieldLabels)) {
                    echo "<th>" . $fieldLabels[$field] . "</th>";
                }
            }
            echo "  </tr>
                    </thead>
                    <tbody>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                foreach ($selectedFields as $field) {
                    // Adjust the field name for the region
                    if ($field == 'regions.region_name AS region_name') {
                        $field = 'region_name';
                    }
                    // Ensure the field exists in the result set
                    if (isset($row[$field])) {
                        echo "<td>" . htmlspecialchars($row[$field]) . "</td>";
                    }
                }
                echo "</tr>";
            }
            echo "</tbody>
                </table>";

            // Add Download CSV Button
            echo "<form method='post' action='downloadascsv'>
                    <input type='hidden' name='fields' value='" . htmlspecialchars(implode(',', $_POST['fields'])) . "'>
                    <input type='hidden' name='typeFilter' value='" . htmlspecialchars($typeFilter) . "'>
                    <button type='submit' name='download_csv' class='btn btn-secondary'>Download as CSV</button>
                </form>";
        } else {
            echo "No results found.";
        }
    } else {
        echo "No columns selected.";
    }
}

$con->close();
?>


    </div>

  </section>

  <script>
    let sidebar = document.querySelector(".sidebar");
    let sidebarBtn = document.querySelector(".sidebarBtn");
    sidebarBtn.onclick = function() {
      sidebar.classList.toggle("active");
      if (sidebar.classList.contains("active")) {
        sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
      } else {
        sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
      }
    }
  </script>
   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
</body>

</html>
