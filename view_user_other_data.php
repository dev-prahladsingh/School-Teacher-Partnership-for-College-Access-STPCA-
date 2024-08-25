<?php
session_start();
include 'database.php';
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/css/bootstrap.min.css">

  <!-- Boxicons CDN Link -->
  <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link href='sidebar.css' rel='stylesheet'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel || Dasboard</title>
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
   .card {
            text-align: center;
            margin: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 20px;
            background-color: #f8f9fa; /* Light gray background */
        }
        .card-body {
            font-size: 1.25em; /* Smaller font size */
        }
        .card-title {
            font-size: 1.5em; /* Larger font size for heading */
            font-weight: bold;
            margin-bottom: 10px; /* Space below heading */
        }
        
        @media (max-width: 768px) {
            .card {
                margin: 10px 0;
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

       <span class="logo_name" style="margin-left:1px"><img width="59" height="55" src="kcmtlogos.jpg" alt="d"/></span> &nbsp;<H5 style="color:#fff;text-align:center;">DEEKSHA</H5>
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
        <a href="user_other_filters.php">
<i class='bx bx-line-chart'></i>
          <span class="links_name">Data Analytics</span>
        </a>
      </li>
      <li>
        <a href="user_other_completed.php.php"  class="active">
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
        <span class="dashboard">Completed Data</span>
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
<?php
include 'database.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Fetch data from the others table
   $sql = "SELECT others.*, regions.region_name 
        FROM others 
        LEFT JOIN regions ON others.region = regions.region_id 
        WHERE others.id = $id";

    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

      echo "<table border='1'>
        <tr><th>Name</th><td>" . $row['name'] . "</td></tr>
        <tr><th>Department</th><td>" . $row['department'] . "</td></tr>
        <tr><th>Institute Type</th><td>" . $row['type'] . "</td></tr>
        <tr><th>Institute Name</th><td>" . $row['iname'] . "</td></tr>
        <tr><th>Address</th><td>" . $row['address'] . "</td></tr>
        <tr><th>Date</th><td>" . $row['date'] . "</td></tr>
        <tr><th>Key Name</th><td>" . $row['key_name'] . "</td></tr>
        <tr><th>Key Contact</th><td>" . $row['key_cont'] . "</td></tr>
        <tr><th>Key Email</th><td>" . $row['key_email'] . "</td></tr>
        <tr><th>Key DOB</th><td>" . $row['key_dob'] . "</td></tr>
        <tr><th>Key DOA</th><td>" . $row['key_doa'] . "</td></tr>
        <tr><th>Visit Remark</th><td>" . $row['visit_remark'] . "</td></tr>
        <tr><th>Photo</th><td><img src='" . $row['photo_path'] . "' alt='Photo' style='max-width: 200px; height: auto;'/></td></tr>
        <tr><th>Region</th><td>" . $row['region_name'] . "</td></tr>
        
      </table>";

    } else {
        echo "No data found";
    }
} else {
    echo "Invalid ID";
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
      } else
        sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
    }
  </script>
</body>

</html>