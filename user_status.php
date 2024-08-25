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

        .filter-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        select {
            padding: 10px;
            font-size: 16px;
            margin-right: 20px;
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
        .dropdown {
            cursor: pointer;
            background: none;
            border: none;
            font-size: 16px;
            color: #007BFF;
            text-decoration: underline;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }
        .modal-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
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

button{
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    background-color: #385170;
    color: #fff;
    transition: background-color 0.3s ease-in-out;
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
        <a href="admin.php"class="active" >
          <i class='bx bx-home'></i>
          <span class="links_name">Deeksha Dasboard</span>
        </a>
      </li>
        <li>
        <a href="analytics.php">
          <i class='bx bx-pie-chart-alt'></i>
          <span class="links_name">Allotment Analytics</span>
        </a>
      </li>
      <!--  <li>-->
      <!--  <a href="students/upload.php">-->
      <!--    <i class='bx bx-bar-chart'></i>-->
      <!--    <span class="links_name">Student Analytics</span>-->
      <!--  </a>-->
      <!--</li>-->
       <li>
        <a href="regi_list.php" >
          <i class='bx bx-calendar-check'></i>
          <span class="links_name">Deeksha Allotments</span>
        </a>
      </li>
      <li>
        <a href="admin_data_report.php">
          <i class='bx bx-book-alt'></i>
          <span class="links_name">Completed Deeksha</span>
        </a>
      </li>
      <li>
       <a href="total_allotment.php">
           <i class='bx bx-clipboard'></i>
          <span class="links_name">Deeksha Status</span>
        </a>
      </li>
         <li>
        <a href="reallotment.php">
                      <i class='bx bx-archive-in'></i>
          <span class="links_name">Re-allotments</span>
        </a>
      </li>
      <!--<li>
        <a href="add_users.php">
           <i class='bx bx-user-plus'></i>
          <span class="links_name">Add Faculty</span>
        </a>
      </li>-->
       <li>
        <a href="add_schools.php">
           <i class='bx bx-plus'></i>
          <span class="links_name">Add Schools</span>
        </a>
      </li>
  <li>
        <a href="add_region.php">
           <i class='bx bx-grid-alt'></i>
          <span class="links_name">Add Regions</span>
        </a>
      </li>


<!--<li>-->
<!--        <a href="all_users.php" >-->
<!--                      <i class='bx bx-group'></i>-->
<!--          <span class="links_name">User Status</span>-->
<!--        </a>-->
<!--      </li>-->
      <!--<li>-->
      <!--  <a href="school_info.php">-->
      <!--     <i class='bx bx-info-circle'></i>-->
      <!--    <span class="links_name">School Info</span>-->
      <!--  </a>-->
      <!--</li>-->
      <li class="log_out">
          <a href="admin_main.php">
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
        <span class="dashboard">Deeksha Module</span>
      </div>
       <div class="avt dropdown">
        <button class="dropdown-toggle" id="profile-dropdown-toggle">
            <img src="pro_avt.png" alt="Profile Avatar" class="profile-avatar">
        </button>
        <ul class="dropdown-menu" id="profile-dropdown">
            <li><a href="Profile.php?id=<?php echo $_SESSION['id']; ?>">Profile</a></li>
            <li><a href="students/students_data.php">Upload</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    </nav>

    <div class="home-content">

<div class="filter-container">
    <select id="department-filter">
        <option value="">Select Department</option>
        <?php
        include 'database.php';
        $sql_departments = "SELECT DISTINCT department FROM usersss";
        $result_departments = $con->query($sql_departments);
        if ($result_departments->num_rows > 0) {
            while ($row_department = $result_departments->fetch_assoc()) {
                echo "<option value='{$row_department['department']}'>{$row_department['department']}</option>";
            }
        }
        ?>
    </select>

    <select id="user-filter">
        <option value="">Select User</option>
    </select>

    <button id="download-csv">Download as CSV</button>
</div>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Department</th>
            <th>Allotted Schools</th>
            <th>Pending</th>
            <th>Completed</th>
            <th>Details</th>
        </tr>
    </thead>
    <tbody id="table-body">
    </tbody>
</table>

<!-- The Modal -->
<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>School Details</h2>
    <div id="modal-body">
        <!-- School details will be injected here -->
    </div>
  </div>
</div>

    </div>

  </section>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const departmentFilter = document.getElementById('department-filter');
        const userFilter = document.getElementById('user-filter');
        const tableBody = document.getElementById('table-body');
        const downloadCsvButton = document.getElementById('download-csv');

        // Load all data initially
        fetchTableData('', '');

        departmentFilter.addEventListener('change', function() {
            const department = this.value;
            fetchUsers(department);
            fetchTableData(department, userFilter.value);
        });

        userFilter.addEventListener('change', function() {
            const userId = this.value;
            fetchTableData(departmentFilter.value, userId);
        });

        downloadCsvButton.addEventListener('click', function() {
            const department = departmentFilter.value;
            const userId = userFilter.value;
            window.location.href = `dcsv.php?department=${department}&user_id=${userId}`;
        });

        function fetchUsers(department) {
            fetch(`fetch_users.php?department=${department}`)
                .then(response => response.json())
                .then(data => {
                    userFilter.innerHTML = '<option value="">Select User</option>';
                    data.forEach(user => {
                        userFilter.innerHTML += `<option value="${user.id}">${user.name}</option>`;
                    });
                });
        }

        function fetchTableData(department, userId) {
            fetch(`fetch_table_data.php?department=${department}&user_id=${userId}`)
                .then(response => response.text())
                .then(data => {
                    tableBody.innerHTML = data;
                    attachModalEvents();
                });
        }

        function attachModalEvents() {
            const modal = document.getElementById('myModal');
            const span = document.getElementsByClassName('close')[0];

            document.querySelectorAll('.dropdown').forEach(button => {
                button.addEventListener('click', () => {
                    const userId = button.getAttribute('data-user-id');
                    fetch(`fetch_schools.php?user_id=${userId}`)
                        .then(response => response.text())
                        .then(data => {
                            document.getElementById('modal-body').innerHTML = data;
                            modal.style.display = 'block';
                        });
                });
            });

            span.onclick = function() {
                modal.style.display = 'none';
            }

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = 'none';
                }
            }
        }
    });
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

</html>