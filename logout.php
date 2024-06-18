<?php
// Logout logic
$currentPoliceUserFile = 'current_user.txt';

// Clear the name in the current_police_user.txt file
file_put_contents($currentPoliceUserFile, '');

// Redirect to main.php after clearing the username
header("Location: main.php");
exit;
?>
