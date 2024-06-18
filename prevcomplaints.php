<!DOCTYPE html>
<html lang="en">
<head>
    <title>Complaints Information</title>
    <style>
        body{
            background-color: beige;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h1>Complaints Information</h1>

<?php
$complaintsFolderPath = 'complaints/';
$currentUsernameFile = 'current_user.txt';

// Read the desired username from the current_user.txt file
$desiredUsername = file_get_contents($currentUsernameFile);
$desiredUsername = trim($desiredUsername);

// Recursive function to get all files with .json extension in a directory and its subdirectories
function getAllJsonFiles($dir) {
    $files = [];
    $items = scandir($dir);

    foreach ($items as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }

        $path = $dir . '/' . $item;

        if (is_dir($path)) {
            // Recursively get JSON files from subdirectory
            $files = array_merge($files, getAllJsonFiles($path));
        } elseif (pathinfo($path, PATHINFO_EXTENSION) === 'json') {
            $files[] = $path;
        }
    }

    return $files;
}

// Get all JSON files in the complaints folder and its subdirectories
$jsonFiles = getAllJsonFiles($complaintsFolderPath);

// Flag to check if any file with matching username is found
$foundMatchingUsername = false;

// Variables to count open and closed statuses
$openCount = 0;
$closeCount = 0;

// Loop through each JSON file
foreach ($jsonFiles as $file) {
    // Read the content of the file
    $fileContent = file_get_contents($file);

    // Convert the JSON content to an associative array
    $complaintDetails = json_decode($fileContent, true);

    // Check if the "Username" matches the desired username
    if (isset($complaintDetails['Username']) && $complaintDetails['Username'] === $desiredUsername) {
        // Set the flag to true if a file with matching username is found
        $foundMatchingUsername = true;

        // Increment open or closed count based on status value
        if (isset($complaintDetails['Status'])) {
            if ($complaintDetails['Status'] === 'open') {
                $openCount++;
            } elseif ($complaintDetails['Status'] === 'closed') {
                $closeCount++;
            }
        }

        // Display the content in the table
        echo "<table>";
        echo "<tr>";
        echo "<th colspan='2'>File: " . str_replace($complaintsFolderPath, '', $file) . "</th>";
        echo "</tr>";
        foreach ($complaintDetails as $field => $value) {
            echo "<tr>";
            echo "<td>$field</td>";
            echo "<td>$value</td>";
            echo "</tr>";
        }
        echo "<tr><td colspan='2'><hr></td></tr>"; // Add a separator between files
        echo "</table>";
    }
}

// Display counts of open and closed statuses
echo "<p>Open Status Count: $openCount</p>";
echo "<p>Closed Status Count: $closeCount</p>";

// Display message if no files with matching username are found
if (!$foundMatchingUsername) {
    echo "<p>No records with matching username to display.</p>";
}
?>
</body>
</html>
