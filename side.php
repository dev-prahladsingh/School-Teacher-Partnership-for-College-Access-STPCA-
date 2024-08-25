<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="dashboard.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link href='sidebar.css' rel='stylesheet'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel || Dasboard</title>
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


    .nav-links li .sub-menu {
      display: none;
      padding-left: 20px;
      background: #2e3a46; /* Adjust according to your design */
    }

    .nav-links li.active > .sub-menu {
      display: block;
    }

    .nav-links li .sub-menu li {
      height: auto;
    }

    .nav-links li .sub-menu li a {
      padding-left: 30px;
    }
  </style>
</head>
<body>
  <div class="sidebar">
    <div class="logo-details">
      <span class="logo_name" style="margin-left:1px">
        <img width="59" height="55" src="kcmtlogos.jpg" alt="d"/>
      </span> &nbsp;
      <h5 style="color:#fff;text-align:center;">DEEKSHA</h5>
    </div>
    <ul class="nav-links">
 <div style="background-color: red; color: white; ">
  <center>Deeksha</center>
</div>
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
      <div style="background-color: red; color: white; ">
  <center>Admission</center>
</div>
        <li>
        <a href="students/upload.php">
          <i class='bx bx-bar-chart'></i>
          <span class="links_name">Student Analytics</span>
        </a>
      </li>
      <div style="background-color: red; color: white; ">
  <center>Others</center>
</div>
 <li>
        <a href="#">
           <i class='bx bx-user-plus'></i>
          <span class="links_name">Completed Others</span>
        </a>
      </li>
 <li>
        <a href="admin_dynamic_load.php">
           <i class='bx bx-user-plus'></i>
          <span class="links_name">Analytics</span>
        </a>
      </li>
      <div style="background-color: red; color: white; ">
  <center>Manage</center>
      <li>
        <a href="add_users.php">
           <i class='bx bx-user-plus'></i>
          <span class="links_name">Add Faculty</span>
        </a>
      </li>
       <li>
        <a href="add_schools.php">
           <i class='bx bx-plus'></i>
          <span class="links_name">Add Schools</span>
        </a>
      </li>
       <li>
        <a href="all_users.php" >
                      <i class='bx bx-group'></i>
          <span class="links_name">User Status</span>
        </a>
      </li>
      <li>
        <a href="school_info.php">
           <i class='bx bx-info-circle'></i>
          <span class="links_name">School Info</span>
        </a>
      </li>
     
    </ul>
  </div>
  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Dashboard</span>
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
      <?php include 'admin_data_report.php';?>
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

    document.querySelectorAll('.nav-links li a.dropdown-toggle').forEach(function(item) {
      item.addEventListener('click', function(e) {
        e.preventDefault();
        let parentLi = this.parentElement;
        parentLi.classList.toggle('active');
      });
    });
  </script>
</body>
</html>
