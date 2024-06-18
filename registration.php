<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
    <style>
         body{
            background-image: url(clogin.png);
         }
         tr,td{
            padding: 10px 20px 10px 20px;
            font-size: 20px;
            font-weight: bold;
         }
         table{
            text-align: center;
            margin-top: 80px;
         }
    </style>
</head>
<body>
    <center>
<table border="0">
    <caption><h1><b>Registration</b></h1></caption>
<form action="process_registration.php" method="post">
<tr>
    <td><label for="firstname">First Name:</label></td>
    <td><input type="text" id="firstname" name="firstname"></td>
</tr>
<tr>
    <td><label for="lastname">Last Name:</label></td>
    <td><input type="text" id="lastname" name="lastname"></td>
</tr>
<tr>
    <td><label for="username">Username:</label></td>
    <td><input type="text" id="username" name="username"></td>
</tr>
<tr>
    <td><label for="password">Password:</label></td>
    <td> <input type="password" id="password" name="password"></td>
</tr>
<tr>
    <td><label for="gender">Gender:</label></td>
    <td><input type="radio" id="male" name="gender" value="male">
        <label for="male">Male</label>
        <input type="radio" id="female" name="gender" value="female">
        <label for="female">Female</label></td>
</tr>
<tr>
    <td><label for="dob">Date of Birth:</label></td>
    <td><input type="date" id="dob" name="dob"></td>
</tr>
<tr>
    <td><label for="mobile">Mobile Number:</label></td>
    <td><input type="number" id="mobile" name="mobile"></td>
</tr>
<tr>
    <td><label for="address">Address:</label></td>
    <td><textarea id="address" name="address"></textarea></td>
</tr>
<tr>
    <td align="center"><input type="submit" value="Submit"></td>
    <td align="center"><input type="reset" value="Clear"></td>
</tr>
</form>
</table>
</center>
</body>
</html>
