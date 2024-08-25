<?php
session_start();
include 'database.php';
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php"); // Redirect to login page if not logged in or not an admin
    exit();
}

// Fetch data grouped by department
$query = "SELECT department, COUNT(*) as count FROM students GROUP BY department";
$result = mysqli_query($con, $query);

$departments = [];
$counts = [];
while ($row = mysqli_fetch_assoc($result)) {
    $departments[] = $row['department'];
    $counts[] = $row['count'];
}

// Fetch total count of rows
$totalQuery = "SELECT COUNT(*) as total FROM students";
$totalResult = mysqli_query($con, $totalQuery);
$totalRow = mysqli_fetch_assoc($totalResult);
$totalCount = $totalRow['total'];
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
      <h5 style="color:#fff;text-align:center;">ADDMISSION</h5>
    </div>
    <ul class="nav-links">
      <li>
        <a href="add_admin.php" class="active">
          <i class='bx bx-home'></i>
          <span class="links_name">Student Dashboard</span>
        </a>
      </li>
      <li>
        <a href="students/upload.php">
          <i class='bx bx-pie-chart-alt'></i>
          <span class="links_name">Student Analytics</span>
        </a>
      </li>
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
        <span class="dashboard">Addmission Module</span>
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
      <div class="main-content">
        <div class="dashboard-container">
          <div class="tab">
            <div class="tab-content">
              <h1><center>Students Data</center></h1>
              <div class="chart-container">
                <div class="chart">
                  <canvas id="departmentDonutChart" width="300" height="300"></canvas>
                </div>
                <div class="chart">
                  <canvas id="totalBarChart" width="300" height="300"></canvas>
                </div>
              </div>
              <script>
                // Get the counts from your PHP code
                var departments = <?php echo json_encode($departments); ?>;
                var counts = <?php echo json_encode($counts); ?>;

                // Create labels with counts
                var labelsWithCounts = departments.map((department, index) => `${department} (${counts[index]})`);

                // Get the canvas element for the doughnut chart
                var ctxDonut = document.getElementById("departmentDonutChart").getContext("2d");

                // Create a doughnut chart
                var departmentDonutChart = new Chart(ctxDonut, {
                  type: "doughnut",
                  data: {
                    labels: labelsWithCounts,
                    datasets: [{
                      data: counts,
                      backgroundColor: ['#1b4965', '#90EE90', '#ef233c', '#6610f2', '#ffca3a'],
                    }],
                  },
                  options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                      position: "bottom",
                    },
                  },
                });

                // Get the total count from your PHP code
                var totalCount = <?php echo $totalCount; ?>;

                // Get the canvas element for the bar chart
                var ctxBar = document.getElementById("totalBarChart").getContext("2d");

                // Create a bar chart
                var totalBarChart = new Chart(ctxBar, {
                  type: "bar",
                  data: {
                    labels: ["Total Students"],
                    datasets: [{
                      label: 'Total Students (' + totalCount + ')',
                      data: [totalCount],
                      backgroundColor: ['#1b4965'],
                    }],
                  },
                  options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                      y: {
                        beginAtZero: true,
                      },
                    },
                    legend: {
                      display: false,
                    },
                  },
                });
              </script>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php include 'footer.php';?>
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
</body>

</html>
