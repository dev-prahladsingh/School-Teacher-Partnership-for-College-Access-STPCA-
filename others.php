<?php

session_start();
include 'database.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: index.php");
    exit();
}
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Get the user ID from the session
$loggedInUserID = $_SESSION['id'];

// Query the database to fetch user details using the logged-in user ID
$getUserQuery = "SELECT * FROM usersss WHERE id = $loggedInUserID";
$userResult = $con->query($getUserQuery);

// Check if user exists
if ($userResult->num_rows === 0) {
    echo '<script>alert("Invalid user ID.");</script>';
    exit();
}

// Fetch user data
$userData = $userResult->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle file uploads
    $photoPath = ''; // Initialize variables for photo and excel paths
    $excelFilePath = '';

    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . basename($_FILES['photo']['name']);

        if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadFile)) {
            $photoPath = $uploadFile;
        } else {
            echo "Error uploading file.";
            exit();
        }
    }

    // if (isset($_FILES['excel_file']) && $_FILES['excel_file']['error'] == 0) {
    //     $uploadDir = 'uploads/';
    //     $uploadFile = $uploadDir . basename($_FILES['excel_file']['name']);

    //     if (move_uploaded_file($_FILES['excel_file']['tmp_name'], $uploadFile)) {
    //         $excelFilePath = $uploadFile;
    //     } else {
    //         echo "Error uploading Excel file.";
    //         exit();
    //     }
    // }

    // Process form data
    $name = $_POST['name'];
    $department = $_POST['department'];
    $type = $_POST['type'];
    $iname = $_POST['iname'];
    $address = $_POST['address'];
    $date = $_POST['date'];
    $key_name = $_POST['key_name'];
    $key_cont = $_POST['key_cont'];
    $key_email = $_POST['key_email'];
    $key_dob = $_POST['key_dob'];
    $key_doa = $_POST['key_doa'];
    $visit_remark = $_POST['visit_remark'];
    $region = $_POST['region'];

    // Prepare SQL statement for inserting data
    $sql = "INSERT INTO others (user_id, name, department, type,iname, address, date, key_name, key_cont, key_email, key_dob, key_doa, visit_remark,  region, photo_path) VALUES ('$loggedInUserID', '$name', '$department', '$type','$iname', '$address', '$date', '$key_name', '$key_cont', '$key_email', '$key_dob',  '$key_doa', '$visit_remark',  '$region', '$photoPath')";

    if ($con->query($sql) === TRUE) {
      echo "<script>
    alert('Success! Your action was completed.');
    window.location.href='others.php';
</script>";
    } else {
        echo "Error: " . $con->error;
    }

    $con->close();
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  
  <!-- Boxicons CDN Link -->
  <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
 <link href='sidebar.css' rel='stylesheet'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Faculty Panel || Fill Allotment</title>
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

   
   
    .form-group {
      margin: 15px;
    }

    .head {
      position: relative;
      font-size: 30px;
      font-weight: 600;
      color: #333;
      margin: 15px;
      align-items: center;
    }



    .head::before {
      content: "";
      position: relative;
      left: 0;
      bottom: -2px;
      height: 3px;
      width: 50px;
      border-radius: 8px;
      background-color: #4070f4;
    }

    .btn {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 45px;
      max-width: 200px;
      width: 100%;
      border: none;
      outline: none;
      color: #fff;
      border-radius: 5px;
      margin: 25px 10px;
      background-color: #66bfbf;
      transition: all 0.3s linear;
      cursor: pointer;
    }

   #photo-preview {
      width: 200px;
      height: 200px;
      border: 1px solid black;
      margin-top: 10px;
    }
    label {
    font-weight: bold;
}
input[type="text"],
input[type="email"],
input[type="date"],
input[type="number"],
select {
    border: 2px solid; /* Adjust the border width as needed */
}

  </style>
</head>

<body>
  <div class="sidebar">
    <div class="logo-details">

       <span class="logo_name" style="margin-left:1px"><img width="59" height="55" src="kcmtlogos.jpg" alt="d"/></span> &nbsp;<H5 style="color:#fff;text-align:center;">OTHERS</H5>
    </div>
   <ul class="nav-links">
      <li>
        <a href="others_user.php">
<i class='bx bx-grid-alt'></i>
          <span class="links_name">Data Dashboard</span>
        </a>
      </li>
      <li>
        <a href="others.php" class="active">
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
        <a href="user_other_completed.php.php">
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
        <span class="dashboard">Others Form</span>
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
include 'database.php'; // Include the database connection
$loggedInUserID = $_SESSION['id'];

    // Query to fetch a specific user's data
    $sql = "SELECT id, name, department FROM usersss WHERE id = $loggedInUserID";
    $result = $con->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
?>
      <form method="POST" action="" enctype="multipart/form-data">
        <div class="form-group">
            <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="name">UID:</label>
                    <input type="text" id="name" name="id" value="<?php echo $row["id"]; ?>" class="form-control" readonly>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="name">Faculty Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo $row["name"]; ?>" class="form-control" readonly>
                </div> 
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="name">Department:</label>
                    <input type="text" id="department" name="department" value="<?php echo $row['department']; ?>"class="form-control" readonly>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="name">Select Institute Type:</label>
                    <select id="type" name="type" class="form-control" required>
                        <option value="Bookstore">Bookstore</option>
            <option value="Coaching Centers and Tutoring Services">Coaching Centers and Tutoring Services</option>
            <option value="Libraries and Community Centers">Libraries and Community Centers</option>
            <option value="Career Counseling and Guidance Centers">Career Counseling and Guidance Centers</option>
            <option value="Educational Events and Competitions">Educational Events and Competitions</option>
            <option value="Non-Profit Organizations and NGOs">Non-Profit Organizations and NGOs</option>
        </select>
                </div>
            </div>
             <div class="col-md-3">
                <div class="form-group">
                    <label for="name">Institute Name:</label>
                    <input type="text" id="iname" name="iname" class="form-control" >
                </div>
            </div>
            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="regions">Region:</label>
                                    <select id="regions" name="region" class="form-control">
                                        <!-- Options will be populated here by PHP -->
                                        <?php
                                            include('database.php');
            
                                            $query = "SELECT region_id, region_name FROM regions";
                                            $result = mysqli_query($con, $query);
            
                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo '<option value="'.$row['region_id'].'">'.$row['region_name'].'</option>';
                                                }
                                            } else {
                                                echo '<option value="">No regions available</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
            <!--<div class="col-md-3">-->
            <!--    <div class="form-group">-->
            <!--        <label for="tsdate">Target Start Date:</label>-->
            <!--                               <input type="text" id="tsdate"  name="tsdate" class="form-control" readonly>-->

            <!--    </div>-->
            <!--</div>-->
           
        </div>
            <div class="row">
      <!--      <div class="col-md-3">-->
      <!--          <div class="form-group">-->
      <!--              <label for="tedate">Target End Date:</label>-->
      <!--                                      <input type="text" id="tedate" name="tedate"  class="form-control" readonly>-->

      <!--          </div>-->
      <!--      </div>-->
        
            <div class="col-md-3">
                <div class="form-group">
                    <label for="schools">Address:</label>
                    <input type="text" id="address" name="address"  class="form-control">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="date">Date:</label>
                    <input type="date" id="date" name="date" class="form-control" required>
                </div>
            </div>
            <div class="col-md-3">
            <div class="form-group">
            <label for="photo">Upload Photo:</label>
            <input type="file" id="photo" name="photo" class="form-control-file">
        </div>
            </div>
            
        <!--    <div class="col-md-3">-->
        <!--    <div class="form-group">-->
        <!--    <label for="excel_file">Upload Student Data in Excel Format:</label>-->
        <!--    <input type="file" id="excel_file" name="excel_file" class="form-control-file">-->
        <!--</div>-->
        <!--    </div>-->
          </div>
            <div class="row">
                <div class="col-md-3">
                <div class="form-group">
                    <label for="pname">Name:</label>
                    <input type="text" id="key_name" name="key_name" class="form-control" required>
                </div>
            </div>
               <div class="col-md-3">
    <div class="form-group">
        <label for="pcont"> Contact No.:</label>
        <input type="text" id="key_cont" name="key_cont" class="form-control" placeholder="Enter 10-digit number" required pattern="[0-9]{10}" title="Please enter exactly 10 digits" maxlength="10">
    </div>
</div>

                <!--<div class="col-md-3">-->
                <!--    <div class="form-group">-->
                <!--        <label for="stream">Stream:</label>-->
                <!--        <input type="text" id="stream" name="stream" class="form-control" required>-->
                <!--    </div>-->
                <!--</div>-->
                
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="topic_covered">Email:</label>
                        <input type="text" id="key_email" name="key_email" class="form-control" required>
                    </div>
                </div>
                 <div class="col-md-3">
                    <div class="form-group">
                        <label for="topic_covered">DOB:</label>
                        <input type="date" id="key_dob" name="key_dob" class="form-control" required>
                    </div>
                </div>
                 <div class="col-md-3">
                    <div class="form-group">
                        <label for="topic_covered">DOA:</label>
                        <input type="date" id="key_doa" name="key_doa" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-3">
                <div class="form-group">
                    <label for="visit_remark">Visit Remark:</label>
                    <input type="text" id="visit_remark" name="visit_remark" class="form-control" required>
                </div>
          </div>
            
            <!--<div class="col-md-3">-->
            <!--    <div class="form-group">-->
            <!--        <label for="data_collected">Data Collected:</label>-->
            <!--        <select id="data_collected" name="data_collected" class="form-control" required>-->
            <!--            <option value="Yes">Yes</option>-->
            <!--            <option value="No">No</option>-->
            <!--        </select>-->
            <!--    </div>-->
            <!--</div>-->
           
        </div>
       

        <button type="submit" class="btn btn-primary" style="background:#f96d00">Submit</button>
      </form>
    <?php
            
        } else {
            echo "User ID not set.";
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


    // Function to validate contact numbers
    function validateContactNumber() {
        let contactNumber = this.value;
        let errorElement = document.getElementById(`${this.id}Error`);

        // Use a regular expression to check for a valid 10-digit phone number
        if (/^[0-9]{10}$/.test(contactNumber)) {
            errorElement.innerText = '';
        } else {
            errorElement.innerText = 'Enter a valid 10-digit phone number.';
        }
    }
  </script>
    <script>
        // Get the current date in YYYY-MM-DD format
        const currentDate = new Date().toISOString().split('T')[0];

        // Set the current date as the value for the input fields
        document.getElementById('tsdate').value = currentDate;
        document.getElementById('tedate').value = currentDate;
    </script>
</body>

</html>