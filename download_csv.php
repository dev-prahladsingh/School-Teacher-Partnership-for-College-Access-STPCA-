<?php
if (isset($_POST['csvData'])) {
  $csvData = json_decode($_POST['csvData'], true);

  header('Content-Type: text/csv');
  header('Content-Disposition: attachment;filename=filtered_data.csv');

  $output = fopen('php://output', 'w');

  foreach ($csvData as $row) {
    fputcsv($output, $row);
  }

  fclose($output);
  exit();
} else {
  echo "No data to download.";
}
?>
