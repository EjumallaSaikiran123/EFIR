<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $station = $_POST['station'] ?? ''; // Assuming 'station' is part of your form

    // Define the directory where user data is stored
    $directory = 'police_data/';
    $filename = $directory . $username . '.json';

    // Check if both username, password, and station are provided
    if (!empty($username) && !empty($password) && !empty($station)) {
        if (file_exists($filename)) {
            // Read the file content
            $json_data = file_get_contents($filename);

            // Decode JSON data to an associative array
            $data = json_decode($json_data, true);

            // Check if the username and password match
            if ($data['Username'] === $username && $data['Password'] === $password) {
                // Start session and save username and station
                $_SESSION['username'] = $username;
                $_SESSION['station'] = $station;

                // Save username to current_police_user.txt
                $currentPoliceUserFilename = 'current_police_user.txt';
                file_put_contents($currentPoliceUserFilename, "Username: $username");

                // Save station details to station_details.txt
                $stationDetailsFilename = 'station_details.txt';
                file_put_contents($stationDetailsFilename, "$station");

                // Redirect to pmain.php after successful login
                echo '<script>
                        window.open("pmain.php", "_blank");
                     </script>';
                exit();
            } else {
                echo "Invalid username or password.";
            }
        } else {
            echo "User does not exist.";
        }
    } else {
        echo "Both username, password, and station are required.";
    }
}
?>
