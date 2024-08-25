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
<style>
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

/* Style for the select wrapper */
.select-wrapper {
  position: relative;
  display: inline-block;
  width: 100%;
  max-width: 400px;
  margin: 20px 0;
}

/* Style for the select element */
.select-wrapper select {
  width: 100%;
  padding: 12px 16px;
  appearance: none;
  background: #f9f9f9;
  border: 1px solid #ccc;
  border-radius: 4px;
  font-size: 16px;
  color: #333;
  outline: none;
  cursor: pointer;
  transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

.select-wrapper select:focus {
  border-color: #007bff;
  box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
}

/* Style for the custom dropdown arrow */
.select-wrapper::after {
  content: '';
  position: absolute;
  top: 50%;
  right: 16px;
  width: 10px;
  height: 10px;
  background: #007bff;
  clip-path: polygon(50% 100%, 0 0, 100% 0);
  transform: translateY(-50%);
  pointer-events: none;
  transition: transform 0.3s ease;
}

.select-wrapper select:focus + .select-wrapper::after {
  transform: translateY(-50%) rotate(180deg);
}

/* Responsive styles */
@media (max-width: 768px) {
  .select-wrapper {
    max-width: 100%;
  }
}

  </style>
</head>

<body>
      <?php include 'loader.php'; ?>

  <div class="sidebar">
    <div class="logo-details">

       <span class="logo_name" style="margin-left:1px"><img width="59" height="55" src="kcmtlogos.jpg" alt="d"/></span> &nbsp;<H5 style="color:#fff;text-align:center;">KCMT</H5>
    </div>
   <ul class="nav-links">
        <li>
        <a href="user_main">
          <i class='bx bx-home'></i>
          <span class="links_name">Home</span>
        </a>
      </li>
      <li>
        <a href="user_dash.php" id="redirect-link">
          <i class='bx bx-envelope'></i>
          <span class="links_name">Deeksha</span>
        </a>
      </li>
        <li>
        <a href="others_user.php" id="redirect-link2">
<i class='bx bx-star'></i>
          <span class="links_name">Others</span>
        </a>
      </li>
       <li>
        <a href="user_dynamic_load.php"class="active" >
          <i class='bx bx-calendar-check'></i>
          <span class="links_name">Analytics</span>
        </a>
      </li>
       
    </ul>
  </div>
  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">User Module</span>
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
<center>
    <div class="home-content">
        <div class="select-wrapper">
 <select id="contentSelector" onchange="redirectToPage()">
        <option value="">Select a Option</option>
        <option value="user_other_filters">Others</option>
        <option value="analytics_user">Deeksha</option>
    </select>
    </div>
 </div>
 </center>
  </section>
   <script>
        function redirectToPage() {
            var selectedValue = document.getElementById('contentSelector').value;
            if (selectedValue) {
                window.location.href = selectedValue + '.php';
            }
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

</html>