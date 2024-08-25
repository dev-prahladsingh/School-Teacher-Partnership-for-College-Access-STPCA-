<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $region = $_POST["region"];

  // Connect to your MySQL database
  include 'database.php';

  // Fetch schools and boards based on the selected region
  $schoolResult = $con->query("SELECT DISTINCT schools FROM faculty_fill_data WHERE region = '$region'");
  $boardResult = $con->query("SELECT DISTINCT board FROM faculty_fill_data WHERE region = '$region'");

  $schools = "<option value=''>Select School</option>";
  while ($row = $schoolResult->fetch_assoc()) {
    $schools .= "<option value='{$row["schools"]}'>{$row["schools"]}</option>";
  }

  $boards = "<option value=''>Select Board</option>";
  while ($row = $boardResult->fetch_assoc()) {
    $boards .= "<option value='{$row["board"]}'>{$row["board"]}</option>";
  }

  $response = [
    "schools" => $schools,
    "boards" => $boards
  ];

  echo json_encode($response);

  $con->close();
}
?>
