<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Define the directory where user data is stored
    $directory = 'user_data/';
    $filename = $directory . $username . '.json';

    // Check if both username and password are provided
    if (!empty($username) && !empty($password)) {
        if (file_exists($filename)) {
            // Read the file content
            $json_data = file_get_contents($filename);

            // Decode JSON data to an associative array
            $data = json_decode($json_data, true);

            // Check if the username and password match
            if ($data['Username'] === $username && $data['Password'] === $password) {
                // Start session and save username
                $_SESSION['username'] = $username;

                // Save username to a file in the current directory
                $filename = 'current_user.txt'; // File to store the current username

                // Write the username to the file
                file_put_contents($filename, $username);

                // Redirect to cmain.html in a new tab
                echo '<script>
                        window.open("cmain.php", "_blank");
                     </script>';
                exit();
            } else {
                echo "Invalid username or password.";
            }
        } else {
            echo "User does not exist.";
        }
    } else {
        echo "Both username and password are required.";
    }
}
?>
