<?php
// grant_permission.php

// Assuming $loggedInUserStationDetails contains the station details of the logged-in user

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the file parameter from the query string
    $file = $_POST['file'];

    
    $fileStationDetails = extractStationDetails($file);

    // Read the current police user's station details
    $userFilePath = 'station_details.txt';
    $currentPoliceUser = file_get_contents($userFilePath);
    $currentPoliceUser = trim($currentPoliceUser);

    // Assuming $complaintData contains the complaint data for each file
    $complaintData = getComplaintData($file);

    // Check if the file station details match with the logged-in user's station details
    if (
        isset($complaintData['PoliceStation']) && 
        $complaintData['PoliceStation'] === $currentPoliceUser
    ) {
        // Directory where the files will be uploaded
        $uploadDirectory = dirname($file) . '/uploads/';

        // Create the directory if it doesn't exist
        if (!file_exists($uploadDirectory)) {
            mkdir($uploadDirectory, 0777, true);
        }

        // Process the uploaded file
        $uploadedFile = $_FILES['uploadedFile'];
        $targetFilePath = $uploadDirectory . basename($uploadedFile['name']);

        if (move_uploaded_file($uploadedFile['tmp_name'], $targetFilePath)) {
            echo "File uploaded successfully.";
        } else {
            echo "Error uploading file.";
        }
    } else {
        echo "Permission denied. You do not have access to this case folder.";
    }
} else {
    echo "Invalid request method.";
}

// Function to extract station details from the file name
function extractStationDetails($filePath) {
    // Modify this function based on your actual file naming convention
    // This is just a placeholder, adjust it according to your data structure
    $pathInfo = pathinfo($filePath);
    $fileNameWithoutExtension = $pathInfo['filename'];
    $parts = explode('_', $fileNameWithoutExtension);
    // Assuming the station details are in the first part of the filename
    return $parts[0];
}

// Function to get complaint data for a file
function getComplaintData($filePath) {
    // Modify this function based on your actual method of obtaining complaint data
    // This is just a placeholder, adjust it according to your data structure
    // For example, you might read data from a database or a JSON file associated with each complaint
    $fileContent = file_get_contents($filePath);
    return json_decode($fileContent, true);
}
?>
