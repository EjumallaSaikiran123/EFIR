<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File List</title>
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
    </style>
</head>
<body>
    <h2>File List in 'tenant_verification' Folder</h2>

    <?php
    $folder = 'tenant_verification/';
    $files = scandir($folder);

    if (count($files) > 2) {  // Exclude "." and ".."
        echo '<table>';
        echo '<tr><th>File Name</th><th>Content</th><th>Status</th><th>Actions</th></tr>';

        foreach ($files as $file) {
            if ($file != '.' && $file != '..') {
                $filePath = $folder . $file;
                $fileContent = file_get_contents($filePath);

                // Get the current status from the file content
                $status = 'Open';
                if (strpos($fileContent, 'Status: Closed') !== false) {
                    $status = 'Closed';
                }

                echo '<tr>';
                echo '<td>' . htmlspecialchars($file) . '</td>';
                echo '<td>' . nl2br(htmlspecialchars($fileContent)) . '</td>';
                echo '<td>' . $status . '</td>';
                echo '<td>';
                echo '<form action="close_case.php" method="post">';
                echo '<input type="hidden" name="file" value="' . $file . '">';
                echo '<input type="submit" value="Close Case">';
                echo '</form>';
                echo '</td>';
                echo '</tr>';
            }
        }

        echo '</table>';
    } else {
        echo '<p>No files found in the folder.</p>';
    }
    ?>
</body>
</html>
