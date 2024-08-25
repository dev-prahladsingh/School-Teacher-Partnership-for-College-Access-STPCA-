<?php
session_start();
 if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
        header("Location: index.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Faculty Panel || View Data Report</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
            color: #333;
            text-align: center;
        }

        h1 {
            color: #ff6666;
            margin-bottom: 20px;
        }

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

        a {
            text-decoration: none;
 background-color: #ff6666;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease-in-out;
    font-size: 16px;
    margin-top: 20px;
        }

        a:hover {
            background-color: #cc5252;
            color: #fff;
        }

        div.container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffe6e6;
            border: 1px solid #ffcccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        @media print {
            body {
                background-color: #ffffff;
            }

            a {
                display: none;
            }

            div.container {
                background-color: #ffffff;
                border: none;
                box-shadow: none;
            }
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        button {
    background-color: #ff6666;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease-in-out;
    font-size: 16px;
    margin-top: 20px;
}

button:hover {
    background-color: #cc5252;
}


/* Modal styles */
.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.4);
}

.modal-content {
    background-color: #fefefe;
    margin: 10% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 90%;
    max-width: 600px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    animation: fadeIn 0.5s;
}

@keyframes fadeIn {
    from {opacity: 0;}
    to {opacity: 1;}
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

form {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
}

form label {
    margin-top: 10px;
}

form input {
    margin-bottom: 10px;
    padding: 8px;
    width: 100%;
    max-width: 100%;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

form button[type="submit"] {
    background-color: #ff6666;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease-in-out;
    font-size: 16px;
    margin-top: 20px;
}

form button[type="submit"]:hover {
    background-color: #cc5252;
}

/* Responsive styling */
@media screen and (max-width: 600px) {
    .modal-content {
        width: 95%;
    }
}

    </style>
</head>

<body>
    <?php
    ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    include('database.php');
    

   

    if (isset($_GET['id'])) {
        $userID = $_SESSION['id'];
        $dataID = $_GET['id'];

        $sql = "SELECT * FROM faculty_fill_data WHERE user_id = $userID AND id = $dataID";
        $result = $con->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            echo "<div class='container'>";
            echo "<h1>".$row["schools"]."</h1>";

            echo "<table>";
            echo "<tr><th>Field</th><th>Value</th></tr>";
            echo "<tr><td>Faculty Name</td><td>" . $row["name"] . "</td></tr>";
            echo "<tr><td>Department</td><td>" . $row["department"] . "</td></tr>";
            echo "<tr><td>Alloted School</td><td>" . $row["schools"] . "</td></tr>";
             echo "<tr><td>School Address</td><td>" . $row["address"] . "</td></tr>";
            echo "<tr><td>Board</td><td>" . $row["board"] . "</td></tr>";
            echo "<tr><td>Date</td><td>" . $row["date"] . "</td></tr>";
            echo "<tr><td>Principal Name</td><td>" . $row["pname"] . "</td></tr>";
            echo "<tr><td>Principal Contact No.</td><td>" . $row["pcont"] . "</td></tr>";
            echo "<tr><td>12th Strength</td><td>" . $row["twelve"] . "</td></tr>";
            echo "<tr><td>Topic Covered</td><td>" . $row["topic_covered"] . "</td></tr>";
            echo "<tr><td>Visit Remark</td><td>" . $row["visit_remark"] . "</td></tr>";

            if (!empty($row['excel_path'])) {
                echo "<tr><td>Student Data</td><td><a href='{$row['excel_path']}' download>Download</a></td></tr>";
            } else {
                echo "<tr><td>Student Data</td><td>No file</td></tr>";
            }

            echo "<tr><td>Image</td><td>";
            if (!empty($row["photo_path"])) {
                echo "<img src='" . $row["photo_path"] . "' alt='Image' style='max-width: 200px; max-height: 200px;'>";
            } else {
                echo "No Image";
            }
            echo "</td></tr>";
            echo "</table>";

            // Fetch and display TGT info
            $sql_tgt = "SELECT * FROM tgt_info WHERE faculty_fill_data_id = $dataID";
            $result_tgt = $con->query($sql_tgt);

            echo "<h2>UG Teacher Information</h2>";
            echo "<table>";
            echo "<tr><th>Name</th><th>Contact No.</th><th>DOB</th><th>DOA</th><th>Subject</th><th>Email</th></tr>";

            while ($tgt_row = $result_tgt->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $tgt_row["tgt_name"] . "</td>";
                echo "<td>" . $tgt_row["tgt_contact"] . "</td>";
                echo "<td>" . $tgt_row["dob"] . "</td>";
                echo "<td>" . $tgt_row["doa"] . "</td>";
                echo "<td>" . $tgt_row["subject"] . "</td>";
                echo "<td>" . $tgt_row["email"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";

            // Fetch and display PGT info
            $sql_pgt = "SELECT * FROM pgt_info WHERE faculty_fill_data_id = $dataID";
            $result_pgt = $con->query($sql_pgt);
            echo "<h2>PG Teacher Information</h2>";
            echo "<table>";
            echo "<tr><th>Name</th><th>Contact No.</th><th>DOB</th><th>DOA</th><th>Subject</th><th>Email</th></tr>";

            while ($pgt_row = $result_pgt->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $pgt_row["pgt_name"] . "</td>";
                echo "<td>" . $pgt_row["pgt_contact"] . "</td>";
                echo "<td>" . $pgt_row["dob"] . "</td>";
                echo "<td>" . $pgt_row["doa"] . "</td>";
                echo "<td>" . $pgt_row["subject"] . "</td>";
                echo "<td>" . $pgt_row["email"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";

            echo "<a href='javascript:void(0);' onclick='window.print();'>Print</a> &nbsp; ";
            echo "<button onclick='openModal()'>Edit</button>";  // Add this line
            echo "</div>";
        } else {
            echo "<div class='container'>";
            echo "<h1>Data not found</h1>";
            echo "<a href=''>Print</a>";
            echo "</div>";
        }
    } else {
        echo "<div class='container'>";
        echo "<h1>Invalid data ID</h1>";
        echo "<a href=''>Print</a>";
        echo "</div>";
    }
    ?>

    <!-- Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <form id="editForm" action="update_data" method="POST">
                <input type="hidden" name="id" value="<?php echo $dataID; ?>">
                <label for="name">Faculty Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" readonly><br>
                <label for="department">Department:</label>
                <input type="text" id="department" name="department" value="<?php echo $row['department']; ?>"readonly><br>
                <label for="schools">Alloted School:</label>
                <input type="text" id="schools" name="schools" value="<?php echo $row['schools']; ?>"><br>
                <label for="board">Board:</label>
                <input type="text" id="board" name="board" value="<?php echo $row['board']; ?>"><br>
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" value="<?php echo $row['date']; ?>"><br>
                <label for="pname">Principal Name:</label>
                <input type="text" id="pname" name="pname" value="<?php echo $row['pname']; ?>"><br>
                <label for="pcont">Principal Contact No.:</label>
                <input type="text" id="pcont" name="pcont" value="<?php echo $row['pcont']; ?>"><br>
                <label for="twelve">12th Strength:</label>
                <input type="number" id="twelve" name="twelve" value="<?php echo $row['twelve']; ?>"><br>
                <label for="topic_covered">Topic Covered:</label>
                <input type="text" id="topic_covered" name="topic_covered" value="<?php echo $row['topic_covered']; ?>"><br>
                <label for="visit_remark">Visit Remark:</label>
                <input type="text" id="visit_remark" name="visit_remark" value="<?php echo $row['visit_remark']; ?>"><br>
                <button type="submit">Update</button>
            </form>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('editModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('editModal').style.display = 'none';
        }

        window.onclick = function (event) {
            if (event.target == document.getElementById('editModal')) {
                closeModal();
            }
        }
    </script>
</body>

</html>
