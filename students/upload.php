<?php
session_start();
include 'database.php';
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php"); // Redirect to login page if not logged in or not an admin
    exit();
}
$updateStatusQuery = "UPDATE faculty_data SET status = 'Expired' WHERE status = 'Pending' AND CURDATE() > tedate";
mysqli_query($con, $updateStatusQuery);

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  <!-- Boxicons CDN Link -->
  <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="dashboard.css">
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link href='sidebar.css' rel='stylesheet'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel || Dasboard</title>
   <style>
      h2 {
            text-align: center;
            margin-bottom: 1.5rem;
            font-size: 2rem;
            color: #007bff;
        }
        .search-form {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .search-form label {
            flex: 1 1 100%;
            margin: 5px 0;
        }
        .search-form input, .search-form select {
            flex: 1 1 100%;
            max-width: 180px;
            margin: 5px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .search-form input[type="submit"], .search-form button {
            flex: 1 1 100%;
            max-width: 120px;
            margin: 5px;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            background-color: #007bff;
            color: white;
            transition: background-color 0.3s;
        }
        .search-form input[type="submit"]:hover, .search-form button:hover {
            background-color: #0056b3;
        }
        .total-count {
              display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-bottom: 2px;
        }
       .btn, button,
input[type="submit"] {
    background-color: #4CAF50; /* Green background */
    color: white; /* White text */
    padding: 10px 20px; /* Padding for better appearance */
    border: none; /* Remove default border */
    border-radius: 4px; /* Rounded corners */
    cursor: pointer; /* Pointer cursor on hover */
    font-size: 16px; /* Font size */
    transition: background-color 0.3s; /* Smooth transition for hover effect */
    text-decoration:none;
}

.btn,button:hover,
input[type="submit"]:hover {
    background-color: #45a049; /* Darker green on hover */
}

.btn,button:active,
input[type="submit"]:active {
    background-color: #3e8e41; /* Even darker green on active (click) */
}


        
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
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            padding-top: 60px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }
        .modal-content {
            background-color: #fff;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 8px;
            position: relative;
        }
        .close {
            color: #aaa;
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
        .close:hover, .close:focus {
            color: black;
        }
        .modal-content form input {
            width: 100%;
            margin: 10px 0;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .modal-content form input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            background-color: #007bff;
            color: white;
            transition: background-color 0.3s;
        }
        .modal-content form input[type="submit"]:hover {
            background-color: #0056b3;
        }
        @media (max-width: 768px) {
            .search-form input, .search-form select, .search-form input[type="submit"], .search-form button {
                flex: 1 1 100%;
                max-width: none;
            }
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

       <span class="logo_name" style="margin-left:1px"><img width="59" height="55" src="../kcmtlogos.jpg" alt="d"/></span> &nbsp;<H5 style="color:#fff;text-align:center;">ADDMISSION</H5>
    </div>
   <ul class="nav-links">
      <li>
        <a href="../add_admin.php">
          <i class='bx bx-home'></i>
          <span class="links_name">Student Dashboard</span>
        </a>
      </li>
      <li>
        <a href="upload.php" class="active">
          <i class='bx bx-pie-chart-alt'></i>
          <span class="links_name">Student Analytics</span>
        </a>
      </li>
      <li class="log_out">
          <a href="../admin_main.php">
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
        <span class="dashboard">Student Analytics</span>
      </div>
       <div class="avt dropdown">
        <button class="dropdown-toggle" id="profile-dropdown-toggle">
            <img src="../pro_avt.png" alt="Profile Avatar" class="profile-avatar">
        </button>
        <ul class="dropdown-menu" id="profile-dropdown">
            <li><a href="../Profile.php?id=<?php echo $_SESSION['id']; ?>">Profile</a></li>
            <li><a href="students_data.php">Upload</a></li>
            <li><a href="../logout.php">Logout</a></li>
        </ul>
    </div>
    </nav>

    <div class="home-content">
  
        
        <?php
        // Include the database configuration file
        include '../database.php';

        // Check connection
        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }

        // Function to fetch distinct values
        function fetchDistinctValues($con, $column) {
            $values = [];
            $sql = "SELECT DISTINCT $column FROM students ORDER BY $column";
            $result = $con->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $values[] = $row[$column];
                }
            }
            return $values;
        }

        // Fetch distinct values for each field
        $school_names = fetchDistinctValues($con, 'school_name');
        $regions = fetchDistinctValues($con, 'region');
        $departments = fetchDistinctValues($con, 'department');
        $years = fetchDistinctValues($con, 'year');

        // Initialize search conditions
        $conditions = [];

        // Build SQL query based on search inputs
        if (!empty($_GET['school_name'])) {
            $conditions[] = "school_name = '" . $_GET['school_name'] . "'";
        }
        if (!empty($_GET['region'])) {
            $conditions[] = "region = '" . $_GET['region'] . "'";
        }
        if (!empty($_GET['department'])) {
            $conditions[] = "department = '" . $_GET['department'] . "'";
        }
        if (!empty($_GET['year_from']) && !empty($_GET['year_to'])) {
            $conditions[] = "year BETWEEN '" . $_GET['year_from'] . "' AND '" . $_GET['year_to'] . "'";
        } elseif (!empty($_GET['year'])) {
            $conditions[] = "year = '" . $_GET['year'] . "'";
        }

        // Generate WHERE clause if conditions exist
        $where = "";
        if (!empty($conditions)) {
            $where = " WHERE " . implode(" AND ", $conditions);
        }

        // Fetch total student count without search
        $total_sql = "SELECT COUNT(*) as total FROM students";
        $total_result = $con->query($total_sql);
        $total_count = $total_result->fetch_assoc()['total'];

        // Fetch student count with search criteria
        $search_sql = "SELECT COUNT(*) as total FROM students" . $where;
        $search_result = $con->query($search_sql);
        $search_count = $search_result->fetch_assoc()['total'];
        ?>

     

        <!-- Search Form -->
        <form id="searchForm" method="get">
            <div class="search-form">
                <select name="school_name">
                    <option value="">School</option>
                    <?php foreach ($school_names as $school_name): ?>
                        <option value="<?= $school_name ?>" <?= (isset($_GET['school_name']) && $_GET['school_name'] == $school_name) ? 'selected' : '' ?>><?= $school_name ?></option>
                    <?php endforeach; ?>
                </select>

                <select name="region">
                    <option value="">Region</option>
                    <?php foreach ($regions as $region): ?>
                        <option value="<?= $region ?>" <?= (isset($_GET['region']) && $_GET['region'] == $region) ? 'selected' : '' ?>><?= $region ?></option>
                    <?php endforeach; ?>
                </select>

                <select name="department">
                    <option value="">Department</option>
                    <?php foreach ($departments as $department): ?>
                        <option value="<?= $department ?>" <?= (isset($_GET['department']) && $_GET['department'] == $department) ? 'selected' : '' ?>><?= $department ?></option>
                    <?php endforeach; ?>
                </select>

               <select name="year">
    <option value="">Year</option>
    <?php
    for ($year = 2015; $year <= date("Y"); $year++) {
        $selected = isset($_GET['year']) && $_GET['year'] == $year ? 'selected' : '';
        echo "<option value=\"$year\" $selected>$year</option>";
    }
    ?>
</select>

<select name="year_from">
    <option value="">From Year</option>
    <?php
    for ($year = 2015; $year <= date("Y"); $year++) {
        $selected = isset($_GET['year_from']) && $_GET['year_from'] == $year ? 'selected' : '';
        echo "<option value=\"$year\" $selected>$year</option>";
    }
    ?>
</select>

<select name="year_to">
    <option value="">To Year</option>
    <?php
    for ($year = 2015; $year <= date("Y"); $year++) {
        $selected = isset($_GET['year_to']) && $_GET['year_to'] == $year ? 'selected' : '';
        echo "<option value=\"$year\" $selected>$year</option>";
    }
    ?>
</select>

                <input type="submit" value="Search">
                <button type="button" onclick="clearSearchInputs()">Clear</button>
            </div>
        </form>
   <div class="total-count">
           <b><p>Total Students: <?= $total_count ?></p>
            <?php if (!empty($conditions)): ?></b>
              <b><p>Students after Search: <?= $search_count ?></p>
            <?php endif; ?></b>
        </div>
        <!-- Display Search Results -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Mobile Number</th>
                    <th>School Name</th>
                    <th>Department</th>
                    <th>Region</th>
                    <th>Year</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch data from database based on search criteria
                $sql = "SELECT * FROM students" . $where;
                $result = $con->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['mobile_number'] . "</td>";
                        echo "<td>" . $row['school_name'] . "</td>";
                        echo "<td>" . $row['department'] . "</td>";
                        echo "<td>" . $row['region'] . "</td>";
                        echo "<td>" . $row['year'] . "</td>";
                        echo "<td>
                            <button onclick='openEditModal(". json_encode($row) .")'>Edit</button>
                            <a class='btn' href='delete.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to delete this record?\")'>Delete</a>
                        </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No records found</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Edit Modal -->
        <div id="editModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeEditModal()">&times;</span>
                <form id="editForm" method="post" action="edit">
                    <input type="hidden" name="id" id="editId">
                    <label for="editName">Name:</label>
                    <input type="text" name="name" id="editName" required>
                    <label for="editMobileNumber">Mobile Number:</label>
                    <input type="text" name="mobile_number" id="editMobileNumber" required>
                    <label for="editSchoolName">School Name:</label>
                    <input type="text" name="school_name" id="editSchoolName" required>
                    <label for="editDepartment">Department:</label>
                    <input type="text" name="department" id="editDepartment" required>
                    <label for="editRegion">Region:</label>
                    <input type="text" name="region" id="editRegion" required>
                    <label for="editYear">Year:</label>
                    <input type="text" name="year" id="editYear" required>
                    <input type="submit" value="Save Changes">
                </form>
            </div>
        </div>

        <?php
        // Close connection
        $con->close();
        ?>

    </div>

<?php include 'footer.php';?>
  </section>
    <script>
         function clearSearchInputs() {
            document.querySelectorAll('.search-form select').forEach(select => select.value = '');
        }
        
        function openEditModal(student) {
            document.getElementById('editId').value = student.id;
            document.getElementById('editName').value = student.name;
            document.getElementById('editMobileNumber').value = student.mobile_number;
            document.getElementById('editSchoolName').value = student.school_name;
            document.getElementById('editDepartment').value = student.department;
            document.getElementById('editRegion').value = student.region;
            document.getElementById('editYear').value = student.year;
            document.getElementById('editModal').style.display = 'block';
        }

        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
        }
    </script>
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
</body>

</html><   i