<?php
session_start();
if (!isset($_SESSION['id'])) {
    // Redirect to login page if user is not logged in
    header("Location: index.php");
    exit();
}
include 'database.php';

// Function to sanitize input data
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$id = $_SESSION['id']; // Retrieve user ID from session
$error_message = "";
$success_message = "";

// Retrieve user details based on the user ID
$query = "SELECT * FROM usersss WHERE id = $id";
$result = mysqli_query($con, $query);

// Process the query result
if ($result && mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);

    // Check if the phone update form is submitted
    if (isset($_POST['update_phone'])) {
        // Sanitize input data
        $phone = sanitizeInput($_POST['phone']);

        // Update user's phone number in the database
        $update_phone_query = "UPDATE usersss SET phone = '$phone' WHERE id = $id";
        if (mysqli_query($con, $update_phone_query)) {
            $success_message = "Phone number updated successfully!";
        } else {
            $error_message = "Error updating phone number: " . mysqli_error($con);
        }
    }

    // Check if the password update form is submitted
    if (isset($_POST['update_password'])) {
        // Sanitize input data
        $password = sanitizeInput($_POST['password']);
        $confirm_password = sanitizeInput($_POST['confirm_password']);

        // Check if password and confirm password match
        if ($password === $confirm_password) {
            // Update user's password in the database
            $update_password_query = "UPDATE usersss SET password = '$password' WHERE id = $id";
            if (mysqli_query($con, $update_password_query)) {
                $success_message = "Password updated successfully!";
            } else {
                $error_message = "Error updating password: " . mysqli_error($con);
            }
        } else {
            $error_message = "Passwords do not match!";
        }
    }
} else {
    // Handle error if user not found
    $error_message = "User not found!";
}

// Close the database connection
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">
    <!-- SweetAlert JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background-color: #f9f9f9;
            color: #333;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        h1 {
            background-color: #ffcccc;
            color: #333;
            padding: 10px;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            margin: 20px auto;
            max-width: 600px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input[type="password"], input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        button[type="submit"] {
            background-color: #ff6666;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button[type="submit"]:hover {
            background-color: #ff4d4d;
        }
        .error {
            color: #ff0000;
        }
        .success {
            color: #006600;
        }
    </style>
</head>
<body>
    <h1><center>Profile</center></h1>
    <div class="container">
        <?php if (isset($user)): ?>
            <p>Name: <b><?php echo $user['name']; ?></b></p>
            <p>Department: <b><?php echo $user['department']; ?></b></p>
            <p>Email: <b><?php echo $user['username']; ?></b></p>
            <p>Role: <b><?php echo $user['role']; ?></b></p>
            <!-- Add other user details here -->

            <!-- Form to update phone number -->
            <form method="post" action="">
                <div>
                    <label for="phone">Phone:</label>
                    <input type="text" id="phone" name="phone" value="<?php echo $user['phone']; ?>" pattern="[0-9]{10}" title="Please enter exactly 10 digits" maxlength="10" >
                </div>
                <button type="submit" name="update_phone">Update Phone Number</button>
                &nbsp;
            </form>

            <!-- Form to update password -->
            <form method="post" action="">
                &nbsp;
                <div>
                    <label for="password">New Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div>
                    <label for="confirm_password">Confirm Password:</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>
                <button type="submit" name="update_password">Update Password</button>
            </form>

            <?php if (!empty($error_message)): ?>
                <script>
                    // Display error message using SweetAlert
                    swal("Error", "<?php echo $error_message; ?>", "error");
                </script>
            <?php endif; ?>
            <?php if (!empty($success_message)): ?>
                <script>
                    var successMessage = "<?php echo $success_message; ?>";
                    var redirectUrl = "Profile.php";

                    // Show success message with SweetAlert2
                    Swal.fire({
                        title: 'Success',
                        text: successMessage,
                        icon: 'success',
                        timer: 2000, // Duration before redirecting in milliseconds (2 seconds)
                        timerProgressBar: true,
                        willClose: () => {
                            // Redirect to the specified URL after the alert closes
                            window.location.href = redirectUrl;
                        }
                    });
                </script>
            <?php endif; ?>
        <?php else: ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
