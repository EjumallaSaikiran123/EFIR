<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Links and Upload</title>
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

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<h1>File Links and Upload</h1>

<?php
$complaintsFolderPath = 'complaints/';

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

// Display file links and upload forms in tabular form
echo "<table border='1'>";
echo "<thead><tr><th>Serial Number</th><th>File Link</th><th>Upload Form</th></tr></thead>";
echo "<tbody>";

$serialNumber = 1;

foreach ($complaintFiles as $file) {
    $fileContent = file_get_contents($file);
    $complaintData = json_decode($fileContent, true);
    $userFilePath = 'station_details.txt';

    // Read the current police user's station details
    $currentPoliceUser = file_get_contents($userFilePath);
    $currentPoliceUser = trim($currentPoliceUser);

    // Display only files (not directories)
    if (is_file($file) && $complaintData['PoliceStation'] === $currentPoliceUser) {
        // Get the relative path for the link
        $relativePath = str_replace($complaintsFolderPath, '', $file);

        echo "<tr>";
        echo "<td>$serialNumber</td>";
        echo "<td><a href='display_file.php?file=$file' target='pbody'>$relativePath</a></td>";
        echo "<td>";
        // Output the upload form for the current file
        echo "<form action='grant_permission.php' method='post' enctype='multipart/form-data' target='pbody'>";
        echo "<input type='hidden' name='file' value='$file'>";
        echo "<input type='file' name='uploadedFile'>";
        echo "<input type='submit' value='Upload File'>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";

        $serialNumber++;
    }
}

echo "</tbody>";
echo "</table>";

?>

<iframe name="pbody" width="100%" height="400px"></iframe>

</body>
</html>
