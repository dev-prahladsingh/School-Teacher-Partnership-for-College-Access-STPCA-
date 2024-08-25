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

   .card {
            text-align: center;
            margin: 20px;
            border-radius: 10px 100px / 120px;; /* Add border-radius */
            box-shadow: 0 4px 8px rgba(0, 1, 1, 1);
            padding: 20px;
            background-color: #fed; /* Light gray background */
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


.link-container {
    width: 80%;
    max-width: 1200px;
    text-align: center;
}

h1 {
    margin-bottom: 20px;
    font-size: 2.5em;
    color: #333;
}

.card-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}

.card {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin: 10px;
    width: 300px;
    transition: transform 0.2s;
}

.card:hover {
    transform: translateY(-10px);
}

.card-content {
    padding: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.card h2 {
    font-size: 1.5em;
    color: #333;
}

.forward-icon {
    color: #007BFF;
    font-size: 1.5em;
    text-decoration: none;
}

.forward-icon:hover {
    color: #0056b3;
}
  </style>
</head>

<body>
    <?php include 'loader.php';?>
  <div class="sidebar">
    <div class="logo-details">

       <span class="logo_name" style="margin-left:1px"><img width="59" height="55" src="kcmtlogos.jpg" alt="d"/></span> &nbsp;<H5 style="color:#fff;text-align:center;">KCMT</H5>
    </div>
   <ul class="nav-links">
        <li>
        <a href="#"class="active" >
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
        <a href="others_user.php" id="redirect-link1">
<i class='bx bx-star'></i>
          <span class="links_name">Others</span>
        </a>
      </li>
       <li>
        <a href="user_dynamic_load.php"id="redirect-link2" >
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

    <div class="home-content">
        <div class="link-container">
        <h1>Quick Links</h1>
        <div class="card-container">
            <?php
            // Sample links array
            $links = [
                ["title" => "Deeksha Form", "url" => "guest_allotment.php"],
                ["title" => "Allotted Deeksha", "url" => "given_allotments.php"],
                ["title" => "Others Form", "url" => "others.php"]
               
            ];

            foreach ($links as $link) {
                echo '
                <div class="card">
                    <div class="card-content">
                        <h2>' . $link["title"] . '</h2>
                        <a href="' . $link["url"] . '" class="forward-icon"><i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                ';
            }
            ?>
        </div>
    </div>
 
    </div>

  </section>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.min.js"></script>
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