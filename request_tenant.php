<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming you have form fields like 'name', 'text', 'station', 'address', etc.
    $name = $_POST['name'];
    $text = $_POST['text'];
    $station = $_POST['station'];
    $address = $_POST['address'];

    // Read the current username from the file
    $userFilePath = 'current_user.txt';
    $currentUsername = file_get_contents($userFilePath);
    $currentUsername = trim($currentUsername);

    // Create the 'tenant_verification' directory if it doesn't exist
    $tenantDirectory = 'tenant_verification/';
    if (!file_exists($tenantDirectory)) {
        mkdir($tenantDirectory, 0777, true);
    }

    // Generate a unique filename based on the current username and timestamp
    $filename = $tenantDirectory . $currentUsername . '_complaint_' . time() . '.txt';

    // Store form details in a text file
    $formData = "Name: $name\n";
    $formData .= "Number: $text\n";
    $formData .= "Station: $station\n";
    $formData .= "Address: $address\n";

    file_put_contents($filename, $formData);

    echo "Complaint details stored successfully for username: $currentUsername";
} else {
    echo "Invalid request method.";
}
?>
