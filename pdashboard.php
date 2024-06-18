<?php
session_start();

if (!isset($_SESSION['username'])) {
    // User is not logged in; redirect to login page
    header("Location: plogin.php");
    exit();
}

// Access the username or other stored data
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <h2>Welcome, <?php echo htmlspecialchars($username); ?>!</h2>
    <center><img src="plogin.png" height="600px" width="450px"></center>
</body>
</html>