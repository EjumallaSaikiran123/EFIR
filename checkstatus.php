<!DOCTYPE html>
<html lang="en">
<head>
    <title>Complaints Status</title>
    <style>
        body {
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
        .file-content {
            margin-top: 20px;
        }
    </style>
    <script>
        function loadFileContent(file) {
            // Use AJAX to dynamically load the content of the file
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Parse JSON content
                    var complaintDetails = JSON.parse(this.responseText);

                    // Generate a table for the content
                    var tableHtml = "<table>";
                    for (var key in complaintDetails) {
                        if (complaintDetails.hasOwnProperty(key)) {
                            tableHtml += "<tr>";
                            tableHtml += "<th>" + key + "</th>";
                            tableHtml += "<td>" + complaintDetails[key] + "</td>";
                            tableHtml += "</tr>";
                        }
                    }
                    tableHtml += "</table>";

                    // Update the file-content div with the generated table
                    document.getElementById("file-content").innerHTML = tableHtml;
                }
            };
            xhttp.open("GET", file, true);
            xhttp.send();
        }
    </script>
</head>
<body>

<h1>Complaints Status</h1>

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

// Variables to count open and close statuses
$openCount = 0;
$closeCount = 0;

// Flag to check if any file with matching username is found
$foundMatchingUsername = false;

// Display a table with the files and their status
echo "<table>";
echo "<tr><th>File</th><th>Status</th></tr>";

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

        // Count the occurrences of open and close statuses
        $status = isset($complaintDetails['Status']) ? $complaintDetails['Status'] : 'N/A';
        if ($status === 'open') {
            $openCount++;
        } elseif ($status === 'closed') {
            $closeCount++;
        }

        // Display the file name and its status with a link to load content
        echo "<tr>";
        echo "<td><a href='javascript:void(0);' onclick='loadFileContent(\"$file\");'>$file</a></td>";
        echo "<td>$status</td>";
        echo "</tr>";
    }
}

echo "</table>";

// Display count of open and close statuses
echo "<p>Open Status Count: $openCount</p>";
echo "<p>Close Status Count: $closeCount</p>";

// Display message if no files with matching username are found
if (!$foundMatchingUsername) {
    echo "<p>No records with matching username to display.</p>";
}
?>

<!-- Container to display file content -->
<div id="file-content" class="file-content"></div>

</body>
</html>
