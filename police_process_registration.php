<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['firstname'] ?? '';
    $lastname = $_POST['lastname'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $mobile = $_POST['mobile'] ?? '';
    $address = $_POST['address'] ?? '';
    $dob = $_POST['dob'] ?? '';
    $station = $_POST['ps'] ??'';
    // Create an array with the form data
    $data = [
        'First Name' => $firstname,
        'Last Name' => $lastname,
        'Username' => $username,
        'Password' => $password,
        'Gender' => $gender,
        'Mobile' => $mobile,
        'Address' => $address,
        'Date of Birth' => $dob,
        'Station' => $station
    ];
    // Convert the array to a JSON string
    $json_data = json_encode($data);
    // Define the directory to save the files
    $directory = 'police_data/';
    // Create the directory if it doesn't exist
    if (!is_dir($directory)) {
        mkdir($directory, 0777, true);
    }
    // Define the filename based on the username
    $filename = $directory . $username . '.json';
    // Write the JSON data to a file
    file_put_contents($filename, $json_data);
    // Redirect to login page after successful registration
    echo "Registration complete please login from the main portal";
    exit();
}
?>