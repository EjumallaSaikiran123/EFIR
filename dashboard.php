<?php
session_start();

if (!isset($_SESSION['username'])) {
    // User is not logged in; redirect to login page
    header("Location: clogin.php");
    exit();
}


$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
</head>
<body>
    <h2>Welcome, <?php echo htmlspecialchars($username); ?>!</h2>
    <center><img src="cpic.png" height="600px" width="450px"></center>
</body>
</html>
