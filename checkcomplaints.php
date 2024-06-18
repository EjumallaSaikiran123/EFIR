<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaints List</title>
    <style>
        body{
            background-color: beige;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        h2 {
            margin-top: 30px;
        }
    </style>
</head>
<body>

<?php
$complaintsFolderPath = 'complaints/';
$userFilePath = 'station_details.txt';

// Read the current police user's station details
$currentPoliceUser = file_get_contents($userFilePath);
$currentPoliceUser = trim($currentPoliceUser);

// Recursive function to get all files in a directory and its subdirectories
function getAllFiles($dir) {
    $files = [];
    $items = scandir($dir);

    foreach ($items as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }

        $path = $dir . '/' . $item;

        if (is_dir($path)) {
            // Recursively get files from subdirectory
            $files = array_merge($files, getAllFiles($path));
        } else {
            $files[] = $path;
        }
    }

    return $files;
}

// Get all files in the complaints folder and its subdirectories
$complaintFiles = getAllFiles($complaintsFolderPath);

// Loop through each file
foreach ($complaintFiles as $file) {
    // Read the content of the file
    $fileContent = file_get_contents($file);

    // Convert the JSON content to an associative array
    $complaintData = json_decode($fileContent, true);

    // Check if the status is "open" and the station value matches the current police user's station
    if (
        isset($complaintData['Status']) && 
        $complaintData['Status'] === 'open' && 
        isset($complaintData['PoliceStation']) && 
        $complaintData['PoliceStation'] === $currentPoliceUser
    ) {
        // Display the content in a table
        echo "<h2>File: $file</h2>";
        echo "<table border='1'>";
        foreach ($complaintData as $columnName => $columnValue) {
            echo "<tr>";
            echo "<td>$columnName</td>";
            echo "<td>$columnValue</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
}
?>

</body>
</html>
