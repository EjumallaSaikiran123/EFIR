<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the username from the session
    $username = $_SESSION['username'] ?? '';

    // Only proceed if the username is available
    if (!empty($username)) {
       
        $complaintData = array(
            'Username' => $username,
            'District' => $_POST['district'],
            'PoliceStation' => $_POST['police_station'],
            'Date' => $_POST['date_of_complaint'],
            'Day_of_offence'=> $_POST['day_of_offence'],
            'Date_of_offence'=> $_POST['date_of_offence'],
            'Time_of_offence'=> $_POST['time_of_offence'] ?? '',
            'Info_of_offence'=> $_POST['information'] ?? '',
            'Place_of_offence'=> $_POST['place_of_offence'] ?? '',
            'Name_of_complainer'=> $_POST['name_of_complaintgiver'] ?? '',
            'FHname_of_complainer'=> $_POST['fhname_of_complaintgiver'] ?? '',
            'DOB_of_complainer'=> $_POST['dob_of_complaintgiver'] ?? '',
            'Nation_of_complainer'=> $_POST['nationality_of_complaintgiver'] ?? '',
            'Passport_of_complainer'=> $_POST['passport'] ?? '',
            'Occupation_of_complainer'=> $_POST['occupation'] ?? '',
            'Name_of_suspect'=> $_POST['name_of_suspect'] ?? '',
            'Age_of_suspect'=> $_POST['age_of_suspect'] ?? '',
            'Gender_of_suspect'=> $_POST['gender_of_suspect'] ?? '',
            'Occupation_of_suspect'=> $_POST['occupation_of_suspect'] ?? '',
            'Village_of_suspect'=> $_POST['village_of_suspect'] ?? '',
            'Acceptance'=> $_POST['acceptance'] ?? '',
            'Person' => $_POST['person'],
            'Status' => 'open'
        );

        // Convert the data to JSON format
        $jsonData = json_encode($complaintData);

        // Define the complaints directory
        $userDirectory = 'complaints/';

        // Create a subdirectory with a unique identifier (e.g., timestamp)
        $subdirectory = $userDirectory . $username . '_' . time() . '/';
        
        // Check if the subdirectory exists, if not, create it
        if (!is_dir($subdirectory)) {
            mkdir($subdirectory, 0755, true);
        }

        // Create a filename within the subdirectory
        $filename = $subdirectory . 'complaint_data.json';

        // Write the JSON data to a file
        if (file_put_contents($filename, $jsonData)) {
            echo "Complaint successfully lodged.";
        } else {
            echo "Error while saving the complaint.";
        }
    } else {
        echo "User session not found. Please log in.";
    }
}
?>
