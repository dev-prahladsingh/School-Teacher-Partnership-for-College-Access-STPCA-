<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php"); // Redirect to login page if not logged in or not an admin
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <!-- Boxicons CDN Link -->
  <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<title>Admin Panel || Give Allotment</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='sidebar.css' rel='stylesheet'>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

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
    }

    .head::before {
      content: "";
      position: absolute;
      left: 0;
      bottom: -2px;
      height: 3px;
      width: 147px;
      border-radius: 8px;
      background-color: #4070f4;
    }

    .btn {
      background-color: #ff6666;
      /* Light red background color for button */
      color: #ffffff;
      /* White text color for button */
      padding: 15px;
      /* Increased padding for larger size */
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .btn:hover {
      background-color: #ff3333;
      /* Darker red on hover */
    }

    #photo-upload {
      width: 200px;
      height: 200px;
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

       <span class="logo_name" style="margin-left:1px"><img width="59" height="55" src="kcmtlogos.jpg" alt="d"/></span> &nbsp;<H5 style="color:#fff;text-align:center;">DEEKSHA</H5>
    </div>
  <ul class="nav-links">
      <li>
        <a href="admin.php">
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
        <a href="regi_list.php" class="active" >
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
    </ul> </div>
  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Give Allotment</span>
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
	 <?php
        include 'database.php'; // Include the database connection

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            // Query to fetch a specific user's data
            $sql = "SELECT * FROM usersss WHERE id = $id";
            $result = $con->query($sql);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
        ?>
      <form action="" method="POST">
        <div class="form-group">
          
          
		     <input type="hidden" name="user_id" value="<?php echo $id; ?>">

          

          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="name">Faculty Stream:</label>
               <input type="text" id="facstream" name="facstream" value="<?php  echo $row['department'];?>" class="form-control"readonly>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="name">Faculty Name:</label>
               <input type="text" id="facname" name="facname" value="<?php  echo $row['name'];?>" class="form-control" readonly>
              </div>
            </div>
<?php
// Database connection setup
include 'database.php';

// Retrieve regions froms the database
$region_query = "SELECT * FROM regions";
$region_result = $con->query($region_query);
?>
            <div class="col-md-4">
              <div class="form-group">
                <label for="name">College Region:</label>
                <Select class="form-control" name="region" id="region">
				<option value="" disabled selected>--Select Region--</option>
                  <?php
    while ($row = $region_result->fetch_assoc()) {
        echo "<option value='" . $row['region_id'] . "'>" . $row['region_name'] . "</option>";
    }
    ?>
                </select>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="name" >College Name:</label>
                <Select class="form-control" name="schools[]" id="school" multiple onchange="updateTarget()"> 
				 </select>
              </div>
            </div>
			<div class="col-md-6">
              <div class="form-group">
                <label for="name">Targeted schools:</label>
             <select id="selectedSchools" name="selectedSchools[]" class="form-control" multiple>
			 </select>
              </div>
            </div>

          </div>

          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="name">Target:</label>
                <input type="text" id="target" name="target" class="form-control">
              </div>
            </div>
  

            <div class="col-md-4">
              <div class="form-group">
                <label for="name">Target Start Date:</label>
                <input type="date" id="tsdate" name="tsdate" class="form-control">
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="email">Target End Date:</label>
                <input type="date" id="tedate" name="tedate" class="form-control">
              </div>
            </div>
			 <div class="col-md-4">
              <div class="form-group">
                <input type="hidden" id="hidden" name="status" value="Pending" class="form-control">
                <input type="submit" value="Submit" class="btn">  
              </div>
            </div>
                      

          </div>
		        

        </div>
      </form>

        <?php
            } else {
                echo "User not found.";
            }
        } else {
            echo "Invalid user ID.";
        }

        $con->close();
        ?>
    </div>
  </section>
   <script>
        document.addEventListener('DOMContentLoaded', function() {
            var today = new Date().toISOString().split('T')[0];
            document.getElementById('tsdate').setAttribute('min', today);
            document.getElementById('tedate').setAttribute('min', today);
        });
    </script>
  <script>
function updateTarget() {
    var selectedSchools = document.getElementById('school').selectedOptions;
    var selectedSchoolsDropdown = document.getElementById('selectedSchools');
    var target = document.getElementById('target');

    // Remove existing options in the selectedSchoolsDropdown
    while (selectedSchoolsDropdown.options.length > 0) {
        selectedSchoolsDropdown.remove(0);
    }

    // Initialize an array to store selected school names
    var selectedSchoolNames = [];

    // Loop through selected options to collect names
    for (var i = 0; i < selectedSchools.length; i++) {
        selectedSchoolNames.push(selectedSchools[i].text);

        // Create new options for the selectedSchoolsDropdown
        var option = document.createElement("option");
        option.text = selectedSchools[i].text;
        option.value = selectedSchools[i].value;
        selectedSchoolsDropdown.add(option);
    }

    // Update the "Target" textbox with the count of selected schools
    target.value = selectedSchools.length;
}
</script>


  <script>
    document.getElementById('region').addEventListener('change', function () {
        var regionId = this.value;
        var schoolDropdown = document.getElementById('school');

        // Clear existing options
        schoolDropdown.innerHTML = "<option  value=''>--Select School--</option>";

        if (regionId) {
            // Fetch schools based on the selected region
            <?php
            include 'database.php';
          $school_query = "SELECT school_name, board, address FROM schools WHERE region_id = ?";
$stmt = $con->prepare($school_query);
$stmt->bind_param("i", $region_id);
            ?>

            fetchSchools(regionId);
        }
    });

   // Inside the fetchSchools function
function fetchSchools(regionId) {
    var schoolDropdown = document.getElementById('school');
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'get_schools.php?region_id=' + regionId, true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            var schools = JSON.parse(xhr.responseText);

            schools.forEach(function (school) {
                schoolDropdown.innerHTML += "<option value='" + school.school_name + "' data-board='" + school.board + "' data-address='" + school.address + "'>" + school.school_name + " (" + school.board + ") - " + school.address + "</option>";
            });
        }
    };

    xhr.send();
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

  <script>
    document.getElementById('photo').addEventListener('change', function(e) {
      var file = e.target.files[0];
      var reader = new FileReader();

      reader.onload = function(e) {
        var imgSrc = e.target.result;
        document.getElementById('photo-preview').innerHTML = '<img src="' + imgSrc + '" width="200" height="200">';
      }

      reader.readAsDataURL(file);
    });
  </script>
</body>

</html>
<?php
// Include the database connection
include 'database.php';

// Function to sanitize input data
function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include the PHPMailer autoloader
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the user ID from the form and sanitize input
    $loggedInUserId = intval($_POST['user_id']);
    $department = sanitizeInput($_POST['facstream']);
    $name = sanitizeInput($_POST['facname']);
    $regionId = intval($_POST['region']);
    $target = sanitizeInput($_POST['target']);
    $tsdate = sanitizeInput($_POST['tsdate']);
    $tedate = sanitizeInput($_POST['tedate']);
    $status = sanitizeInput($_POST['status']);
    $selectedSchools = $_POST['schools']; // Assuming this is already sanitized properly

    // Basic validation
    if (empty($loggedInUserId) || empty($department) || empty($name) || empty($regionId) || empty($target) || empty($tsdate) || empty($tedate) || empty($status) || empty($selectedSchools)) {
        echo "<script>
                Swal.fire({
                    title: 'Error!',
                    text: 'All fields are required.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
              </script>";
        exit;
    }

    // Fetch the region name based on region_id
    $getRegionNameQuery = "SELECT region_name FROM regions WHERE region_id = ?";
    $getRegionNameStmt = $con->prepare($getRegionNameQuery);
    $getRegionNameStmt->bind_param("i", $regionId);
    $getRegionNameStmt->execute();
    $getRegionNameStmt->bind_result($regionName);
    $getRegionNameStmt->fetch();
    $getRegionNameStmt->close();

    // Loop through selected schools and insert a row for each school
    foreach ($selectedSchools as $school) {
        $school = sanitizeInput($school);

        // Fetch the board information for the current school
        $getBoardQuery = "SELECT board, address FROM schools WHERE school_name = ?";
        $getBoardStmt = $con->prepare($getBoardQuery);
        $getBoardStmt->bind_param("s", $school);
        $getBoardStmt->execute();
        $getBoardStmt->bind_result($board, $address);
        $getBoardStmt->fetch();
        $getBoardStmt->close();

        // Insert the form data into the MySQL table, including the user ID, current school, and board
        $sql = "INSERT INTO faculty_data (user_id, department, name, region_id, schools, address, board, target, tsdate, tedate, status)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ississsssss", $loggedInUserId, $department, $name, $regionId, $school, $address, $board, $target, $tsdate, $tedate, $status);

        if ($stmt->execute()) {
            // Fetch the email and phone number of the logged-in user
            $getUserInfoQuery = "SELECT username, phone FROM usersss WHERE id = ?";
            $getUserInfoStmt = $con->prepare($getUserInfoQuery);
            $getUserInfoStmt->bind_param("i", $loggedInUserId);
            $getUserInfoStmt->execute();
            $getUserInfoStmt->bind_result($userEmail, $userPhone);
            $getUserInfoStmt->fetch();
            $getUserInfoStmt->close();

            // Compose email and WhatsApp message body with all POST details, region name, and a link
            $subject = 'Allotment Details';
            $message = "<html><body style='color: #000000;'>";
            $message .= "<p>Dear $userEmail, your allotment details are as follows:</p>";
            $message .= "<table style='width:100%; border-collapse: collapse;'>";
            $message .= "<tr style='color: #ffffff;'>";
            $message .= "<th style='background-color: #cc0000; color: #ffffff; border: 1px solid #ffffff; padding: 8px;'>Department</th>";
            $message .= "<td style='color: #000000; border: 1px solid #ffffff; padding: 8px;'>$department</td>";
            $message .= "</tr>";
            $message .= "<tr>";
            $message .= "<th style='background-color: #cc0000; color: #ffffff; border: 1px solid #ffffff; padding: 8px;'>Name</th>";
            $message .= "<td style='border: 1px solid #ffffff; padding: 8px;'>$name</td>";
            $message .= "</tr>";
            $message .= "<tr>";
            $message .= "<th style='background-color: #cc0000; color: #ffffff; border: 1px solid #ffffff; padding: 8px;'>Region</th>";
            $message .= "<td style='border: 1px solid #ffffff; padding: 8px;'>$regionName</td>";
            $message .= "</tr>";
            $message .= "<tr>";
            $message .= "<th style='background-color: #cc0000; color: #ffffff; border: 1px solid #ffffff; padding: 8px;'>Start Date</th>";
            $message .= "<td style='border: 1px solid #ffffff; padding: 8px;'>$tsdate</td>";
            $message .= "</tr>";
            $message .= "<tr>";
            $message .= "<th style='background-color: #cc0000; color: #ffffff; border: 1px solid #ffffff; padding: 8px;'>End Date</th>";
            $message .= "<td style='border: 1px solid #ffffff; padding: 8px;'>$tedate</td>";
            $message .= "</tr>";
            $message .= "<tr>";
            $message .= "<th style='background-color: #cc0000; color: #ffffff; border: 1px solid #ffffff; padding: 8px;'>School</th>";
            $message .= "<td style='border: 1px solid #ffffff; padding: 8px;'>$school</td>";
            $message .= "</tr>";
            $message .= "<tr>";
            $message .= "<th style='background-color: #cc0000; color: #ffffff; border: 1px solid #ffffff; padding: 8px;'>Board</th>";
            $message .= "<td style='border: 1px solid #ffffff; padding: 8px;'>$board</td>";
            $message .= "</tr>";
            $message .= "</table>";
            $message .= "<p>Please kindly visit the website: <a href='https://kcmtdeeksha.ktoiaap.in/'>https://kcmtdeeksha.ktoiaap.in/</a></p>";
            $message .= "</body></html>";

            // Send email using PHPMailer
            $mail = new PHPMailer(true);
            try {
                // Server settings
                $mail->isSMTP();
                $mail->Host = 'smtp.hostinger.com'; // Hostinger SMTP server
                $mail->SMTPAuth = true;
                $mail->Username = 'admin@kcmtdeeksha.ktoiaap.in'; // Hostinger email address
                $mail->Password = 'Xingh7512@'; // Hostinger email password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // Recipients
                $mail->setFrom('admin@kcmtdeeksha.ktoiaap.in', 'Admin'); // Sender's email and name
                $mail->addAddress($userEmail); // Add recipient

                // Content
                $mail->isHTML(true);
                $mail->Subject = $subject;
                $mail->Body    = $message;

                $mail->send();

                // Send WhatsApp message using UltraMsg API
                $instanceId = 'instance89991';
                $token = '2pkbltwir038x9p8';
               $whatsappMessage = strip_tags(str_replace(["<p>", "</p>", "<th>", "</th>", "<td>", "</td>", "<tr>", "</tr>", "<table>", "</table>"], ["", "\n", "", ":", "", "\n", "", "\n", "", "\n"], $message));
                $whatsappMessage = html_entity_decode($whatsappMessage); // Decode HTML entities

                $url = 'https://api.ultramsg.com/' . $instanceId . '/messages/chat';
                $data = array(
                    'token' => $token,
                    'to' => $userPhone,
                    'body' => $whatsappMessage
                );

                $options = array(
                    'http' => array(
                        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                        'method'  => 'POST',
                        'content' => http_build_query($data),
                    ),
                );

                $context  = stream_context_create($options);
                $result = file_get_contents($url, false, $context);

                if ($result === FALSE) {
                    // Handle WhatsApp message send failure
                    echo "<script>
                            Swal.fire({
                                title: 'Success!',
                                text: 'Allotmnet has been given successfully, and messages sent.',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });
                          </script>";
                } else {
                    // Success message
                    echo "<script>
                            Swal.fire({
                                title: 'Success!',
                                text: 'Form data has been inserted successfully, and messages sent.',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });
                          </script>";
                }
            } catch (Exception $e) {
                echo "<script>
                        Swal.fire({
                            title: 'Error!',
                            text: 'Message could not be sent. Mailer Error: {$mail->ErrorInfo}',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                      </script>";
            }
        } else {
            echo "<script>
                    Swal.fire({
                        title: 'Error!',
                        text: 'Failed to insert data into the database.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                  </script>";
        }
    }
}
?>
