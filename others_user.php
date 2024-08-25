<?php
session_start();
include 'database.php';
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: index.php"); // Redirect to login page if not logged in or not an admin
    exit();
}
$userId = $_SESSION['id'];

// Fetch data grouped by type
$query = "SELECT type, COUNT(*) as count FROM others WHERE user_id = $userId GROUP BY type ";
$result = mysqli_query($con, $query);

$types = [];
$counts = [];
while ($row = mysqli_fetch_assoc($result)) {
    $types[] = $row['type'];
    $counts[] = $row['count'];
}

// Fetch total count of rows
$totalQuery = "SELECT COUNT(*) as total FROM others WHERE user_id = $userId";
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
        <a href="others_user.php" class="active">
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
        <a href="user_other_filters.php">
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
        <span class="dashboard">Others Module</span>
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
      <div class="main-content">
        <div class="dashboard-container">
          <div class="tab">
            <div class="tab-content">
              <h1><center>Data Distribution</center></h1>
              <div class="chart-container">
                <div class="chart">
                  <canvas id="typeDonutChart" width="300" height="300"></canvas>
                </div>
                <div class="chart">
                  <canvas id="totalBarChart" width="300" height="300"></canvas>
                </div>
              </div>
              <script>
                // Get the counts from your PHP code
                var types = <?php echo json_encode($types); ?>;
                var counts = <?php echo json_encode($counts); ?>;
                var totalCount = <?php echo $totalCount; ?>;

                // Create labels with counts
                var labelsWithCounts = types.map((type, index) => `${type} (${counts[index]})`);

                // Create the doughnut chart
                var ctxDonut = document.getElementById("typeDonutChart").getContext("2d");
                var typeDonutChart = new Chart(ctxDonut, {
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

                // Create the bar chart
                var ctxBar = document.getElementById("totalBarChart").getContext("2d");
                var totalBarChart = new Chart(ctxBar, {
                  type: "bar",
                  data: {
                    labels: ["Total Others"],
                    datasets: [{
                      label: 'Total Others (' + totalCount + ')',
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
