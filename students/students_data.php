<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Student Data</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }
        .container {
            background: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 100%;
            max-width: 400px;
        }
        h2 {
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
            color: #007bff;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        input[type="file"] {
            margin-bottom: 1rem;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .message {
            margin-top: 1rem;
            font-size: 0.9rem;
        }
        .note {
            margin-top: 1rem;
            font-size: 0.9rem;
            color: #ff0000;
        }
        .download-link {
            margin-top: 1rem;
            font-size: 0.9rem;
            color: #007bff;
        }
        .download-link a {
            color: #007bff;
            text-decoration: none;
        }
        .download-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Upload Student Data</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="file" accept=".csv, .xlsx" required>
            <input type="submit" name="submit" value="Upload">
        </form>
        <div class="note">
            Please include these headers in the Excel or CSV file: <br>
            <strong>Name, Mobile Number, School Name, Department, Region, Year</strong>
        </div>
        <div class="download-link">
           <a href="./blnk_csv_with_headers.csv" download="blnk_csv_with_headers.csv"> Download a blank template with defined headers: Blank CSV Template</a>
        </div>
        <div class="message">
            <?php
            if (isset($_POST["submit"])) {
                // Database connection
                
               include 'database.php';

                $file = $_FILES['file']['tmp_name'];

                // Open the file for reading
                if (($handle = fopen($file, "r")) !== FALSE) {
                    fgetcsv($handle); // Skip the header row

                    // Loop through each row of the file
                    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                        $name = $data[0];
                        $mobile_number = $data[1];
                        $school_name = $data[2];
                        $department = $data[3];
                        $region = $data[4];
                        $year = $data[5];

                        // Insert data into database
                        $sql = "INSERT INTO students (name, mobile_number, school_name, department, region, year)
                                VALUES ('$name', '$mobile_number', '$school_name', '$department', '$region', '$year')";

                        if ($con->query($sql) === FALSE) {
                            echo "Error: " . $sql . "<br>" . $con->error;
                        }
                    }

                    fclose($handle);
                    echo "Data successfully imported!";
                } else {
                    echo "Error opening the file.";
                }

                $con->close();
            }
            ?>
        </div>
    </div>
</body>
</html>
