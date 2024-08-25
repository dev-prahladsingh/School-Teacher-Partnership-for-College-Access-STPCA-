
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  <!-- Boxicons CDN Link -->
  <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOM9+5iX4i8Y4qpsyybHI5G09KEXGweBf5l3K0W4" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <link href='sidebar.css' rel='stylesheet'>

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel || Add Scholls</title>
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
   
        .container {
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            max-width: 400px;
            width: 100%;
            text-align: center;
        }
        .container h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }
        .container form {
            display: flex;
            flex-direction: column;
        }
        .container form input[type="text"] {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        .container form input[type="submit"] {
            padding: 15px;
            background-color: #385170;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .container form input[type="submit"]:hover {
            background-color: #0056b3;
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
        <a href="admin.php" >
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
        <a href="add_schools.php" >
           <i class='bx bx-plus'></i>
          <span class="links_name">Add Schools</span>
        </a>
      </li>

<li>
        <a href="add_region.php" class="active">
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
    </ul></div>
  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Add Schools</span>
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
 <div class="container">
        <h2>ADD New Region</h2>
        <form id="registrationForm" method="post">
            <input type="text" name="region_name" placeholder="Enter Region Name" required>
            <input type="submit" value="ADD">
        </form>
    </div>
    </div>
  </section>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('registrationForm').addEventListener('submit', function(e) {
            e.preventDefault();
            var form = e.target;

            var formData = new FormData(form);

            fetch('region_add', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        title: 'Success!',
                        text: data.message,
                        icon: 'success'
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: data.message,
                        icon: 'error'
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    title: 'Error!',
                    text: 'An error occurred while submitting the form.',
                    icon: 'error'
                });
            });
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