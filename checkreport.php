<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaints Subdirectories and Images</title>
    <style>
        body{
            background-color: beige;
        }
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px 0;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        img {
            width: 800px;
            height: 400px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<?php
$complaintsFolderPath = 'complaints/';
$currentUsernameFile = 'current_user.txt';

// Read the desired username from the current_user.txt file
$desiredUsername = file_get_contents($currentUsernameFile);
$desiredUsername = trim($desiredUsername);

// Function to get all subdirectories in a given directory
function getAllSubdirectories($dir, $desiredUsername) {
    $subdirectories = [];

    $items = scandir($dir);

    foreach ($items as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }

        $path = $dir . '/' . $item;

        if (is_dir($path)) {
            // Check if the username matches before adding to the list
            $jsonFilePath = $path . '/complaint_data.json';
            if (file_exists($jsonFilePath)) {
                $jsonContent = file_get_contents($jsonFilePath);
                $complaintDetails = json_decode($jsonContent, true);

                if (isset($complaintDetails['Username']) && $complaintDetails['Username'] === $desiredUsername) {
                    $subdirectories[] = $path;
                }
            }
        }
    }

    return $subdirectories;
}

// Function to get all images from the 'uploads' folder in a given directory
function getAllImagesInDirectory($dir) {
    $images = [];

    $uploadsPath = $dir . '/uploads/';
    
    if (is_dir($uploadsPath)) {
        $images = glob($uploadsPath . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
    }

    return $images;
}

// Display subdirectories in the 'complaints' folder
$subdirectories = getAllSubdirectories($complaintsFolderPath, $desiredUsername);
?>

<h2>Complaints Subdirectories for Username: <?php echo $desiredUsername; ?></h2>
<table>
    <tr>
        <th>Folder Name</th>
    </tr>
    <?php foreach ($subdirectories as $subdirectory): ?>
        <tr>
            <td><a href="?dir=<?php echo $subdirectory; ?>"><?php echo $subdirectory; ?></a></td>
        </tr>
    <?php endforeach; ?>
</table>

<!-- Display images from the selected subdirectory -->
<?php if (isset($_GET['dir'])): ?>
    <?php
        $selectedDir = $_GET['dir'];
        $imagesInSelectedDir = getAllImagesInDirectory($selectedDir);
    ?>
    <h2>REPORTS FROM THE SELECTED COMPLAINT:</h2>
    <?php foreach ($imagesInSelectedDir as $image): ?>
        <img src="<?php echo $image; ?>" alt="Image">
    <?php endforeach; ?>
<?php endif; ?>

</body>
</html>
