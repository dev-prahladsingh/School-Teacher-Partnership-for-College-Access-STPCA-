<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: index.php");
    exit();
}

// Connect to the database
include 'database.php';

// Fetch distinct values for board and region
$distinctValues = [];
foreach (['board', 'region'] as $field) {
    $result = $con->query("SELECT DISTINCT $field FROM faculty_fill_data WHERE $field IS NOT NULL");
    if ($result) {
        $distinctValues[$field] = [];
        while ($row = $result->fetch_assoc()) {
            $distinctValues[$field][] = $row[$field];
        }
    } else {
        $distinctValues[$field] = [];
    }
}

// Generate years from 2015 to current year
$currentYear = date("Y");
$years = range(2015, $currentYear);

$con->close();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

   <link href='sidebar.css' rel='stylesheet'>
  <!-- Boxicons CDN Link -->
  <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="dashboard.css">
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Faculty Panel || Dashboard</title>
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
.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-toggle {
    background-color: transparent;
    border: none;
    cursor: pointer;
    padding: 0;
}

.profile-avatar {
    width: 40px; /* Adjust according to your design */
    height: 40px; /* Adjust according to your design */
    border-radius: 50%; /* Makes the image round */
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

  </style>
</head>

<body>
  <div class="sidebar">
    <div class="logo-details">

      <span class="logo_name" style="margin-left:1px"><img width="59" height="55" src="kcmtlogos.jpg" alt="d"/></span> &nbsp;<H5 style="color:#fff;text-align:center;">DEEKSHA</H5>
    </div>
  <ul class="nav-links">
   <li>
        <a href="user_dash.php">
          <i class='bx bx-grid-alt'></i>
          <span class="links_name">Dashboard</span>
        </a>
      </li>
      <li>
        <a href="guest_allotment.php">
          <i class='bx bx-id-card'></i>
          <span class="links_name">Data Form</span>
        </a>
      </li>
       <li>
        <a href="analytics_user.php"  class="active">
          <i class='bx bx-pie-chart-alt'></i>
          <span class="links_name">Search Analytics</span>
        </a>
      </li>
      <li>
        <a href="given_allotments.php">
          <i class='bx bx-highlight'></i>
          <span class="links_name">Allotted Deeksha</span>
        </a>
      </li>
      <li>
        <a href="completed_allotments.php">
          <i class='bx bx-check-double'></i>
          <span class="links_name">Completed Deeksha</span>
        </a>
      </li>
      <li>
        <a href="pending_allotments.php">
          <i class='bx bx-pulse'></i>
          <span class="links_name">Pending Deeksha</span>
        </a>
      </li>
       <li>
        <a href="expired.php">
          <i class='bx bx-calendar-x'></i>
          <span class="links_name">Expired Deeksha</span>
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
        <span class="dashboard">Search Analytics</span>
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
                //   'target' => 'Target',
                //   'tsdate' => 'Start Date',
                //   'tedate' => 'End Date',
                  'schools' => 'Schools',
                  'address' => 'School Address',
                  'board' => 'Board',
                  'date' => 'Date',
                  'region' => 'Region',
                  'pname' => 'Principal Name',
                  'pcont' => 'Principal Contact',
                  'p_dob' => 'Principal DOB',
                  'p_doa' => 'Principal DOA',
                  'p_email' => 'Principal Email',
                  'twelve' => 'Students in 12th',
                  'topic_covered' => 'Topic Covered',
                  'visit_remark' => 'Visit Remark',
                  'pgt_name' => 'PGT Name',
                  'pgt_contact' => 'PGT Contact',
                  'pgt_dob' => 'PGT Date of Birth',
                  'pgt_doa' => 'PGT Date of Appointment',
                  'pgt_subject' => 'PGT Subject',
                  'pgt_email' => 'PGT Email',
                  'tgt_name' => 'TGT Name',
                  'tgt_contact' => 'TGT Contact',
                  'tgt_dob' => 'TGT Date of Birth',
                  'tgt_doa' => 'TGT Date of Appointment',
                  'tgt_subject' => 'TGT Subject',
                  'tgt_email' => 'TGT Email'
                ];

                foreach ($fields as $field => $label) {
                  echo "<div class='form-check'>
                          <input class='form-check-input' type='checkbox' name='fields[]' value='$field' id='$field'>
                          <label class='form-check-label' for='$field'>$label</label>
                        </div>";
                }
                ?>
                <div class="form-group">
                  <label for="board">Board:</label>
                  <select name="board" id="board" class="form-control">
                    <option value="">Select Board</option>
                    <?php foreach ($distinctValues['board'] as $value): ?>
                      <option value="<?php echo htmlspecialchars($value); ?>"><?php echo htmlspecialchars($value); ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="date">Year:</label>
                  <select name="date" id="date" class="form-control">
                    <option value="">Select Year</option>
                    <?php foreach ($years as $year): ?>
                      <option value="<?php echo htmlspecialchars($year); ?>"><?php echo htmlspecialchars($year); ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="region">Region:</label>
                  <select name="region" id="region" class="form-control">
                    <option value="">Select Region</option>
                    <?php foreach ($distinctValues['region'] as $value): ?>
                      <option value="<?php echo htmlspecialchars($value); ?>"><?php echo htmlspecialchars($value); ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="sortOrder">Sort Order:</label>
                  <select name="sortOrder" id="sortOrder" class="form-control">
                    <option value="asc">Ascending</option>
                    <option value="desc">Descending</option>
                  </select>
                </div>
                <button type="submit" class="btn btn-primary" name="applyFilters">Apply Filters</button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <?php
      if (isset($_POST['applyFilters'])) {
        $selectedFields = $_POST['fields'];
        $sortOrder = $_POST['sortOrder'] ?? 'asc'; // Default to ascending if not selected

        // Collect filters
        $boardFilter = $_POST['board'] ?? '';
        $dateFilter = $_POST['date'] ?? '';
        $regionFilter = $_POST['region'] ?? '';

        if (!empty($selectedFields)) {
          $columns = [];
          foreach ($selectedFields as $field) {
            switch ($field) {
              case 'pgt_name':
                $columns[] = "pgt_info.pgt_name AS pgt_name";
                break;
              case 'pgt_contact':
                $columns[] = "pgt_info.pgt_contact AS pgt_contact";
                break;
              case 'pgt_dob':
              case 'pgt_doa':
              case 'pgt_subject':
              case 'pgt_email':
                $columns[] = "pgt_info." . str_replace('pgt_', '', $field) . " AS $field";
                break;
              case 'tgt_name':
                $columns[] = "tgt_info.tgt_name AS tgt_name";
                break;
              case 'tgt_contact':
                $columns[] = "tgt_info.tgt_contact AS tgt_contact";
                break;
              case 'tgt_dob':
              case 'tgt_doa':
              case 'tgt_subject':
              case 'tgt_email':
                $columns[] = "tgt_info." . str_replace('tgt_', '', $field) . " AS $field";
                break;
              default:
                $columns[] = "faculty_fill_data.$field";
            }
          }
          $columns = implode(", ", $columns);

         include 'database.php';
          $faculty_id = $_SESSION['id'];
          $query = "SELECT $columns 
                              FROM faculty_fill_data 
                              LEFT JOIN pgt_info ON faculty_fill_data.id = pgt_info.faculty_fill_data_id 
                              LEFT JOIN tgt_info ON faculty_fill_data.id = tgt_info.faculty_fill_data_id
                              WHERE faculty_fill_data.user_id = $faculty_id";

          if ($boardFilter) {
            $query .= " AND faculty_fill_data.board = '" . $con->real_escape_string($boardFilter) . "'";
          }

          if ($dateFilter) {
            $query .= " AND YEAR(faculty_fill_data.date) = '" . $con->real_escape_string($dateFilter) . "'";
          }

          if ($regionFilter) {
            $query .= " AND faculty_fill_data.region = '" . $con->real_escape_string($regionFilter) . "'";
          }

          $query .= " ORDER BY faculty_fill_data.date $sortOrder"; // Example sorting by date field

          $result = $con->query($query);

          if ($result) {
            echo "<table class='table table-bordered'>";
            echo "<thead><tr>";
            foreach ($selectedFields as $field) {
              echo "<th>" . $fields[$field] . "</th>";
            }
            echo "</tr></thead><tbody>";

            $csvData = [];
            $headerRow = [];
            foreach ($selectedFields as $field) {
              $headerRow[] = $fields[$field];
            }
            $csvData[] = $headerRow;

            while ($row = $result->fetch_assoc()) {
              echo "<tr>";
              $csvRow = [];
              foreach ($selectedFields as $field) {
                echo "<td>{$row[$field]}</td>";
                $csvRow[] = $row[$field];
              }
              $csvData[] = $csvRow;
              echo "</tr>";
            }
            echo "</tbody></table>";

            // Pass CSV data to the form
            $csvJson = json_encode($csvData);

            echo "<form method='post' action='download_csv'>";
            echo "<input type='hidden' name='csvData' value='" . htmlspecialchars($csvJson) . "'>";
            echo "<button type='submit' class='btn btn-secondary'>Download as CSV</button>";
            echo "</form>";
          } else {
            echo "Error executing query: " . $con->error;
          }

          $con->close();
        } else {
          echo "No fields selected.";
        }
      }
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
      } else
        sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
    }
  </script>
  
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>