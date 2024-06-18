<!DOCTYPE html>
<html>
<head>
    <style>
        body{
            background-image: url(clogin.png);
            background-repeat: no-repeat;
            background-size: cover;
        }
        tr,td{
            padding-top: 10px;
            padding-left: 20px;
            padding-right: 20px;
            padding-bottom: 10px;
        }
        table{
            margin-top: 200px;
        }

    </style>
    <title>Login</title>
</head>
<body>
    <form action="process_login.php" method="post">
        <center>
            <table border="0px" align="center" style="padding-top: 10px;">
                <caption><h1>Login</h1></caption>
                <tr>
                    <td style="font-size: 20px;"><b><label for="Username">Username:</label></b></td>
                    <td><input type="text" id="username" name="username" required></td>
                </tr>
                <tr>
                    <td style="font-size: 20px;"><b><label for="password">Password:</label></b></td>
                    <td><input type="password" id="password" name="password" required></td>
                </tr>
                <tr>
                    <td align="center"><input type="submit" value="Login" target="main"></td>
                    <td align="center"><input type="reset" value="Clear"></td>
                </tr>
                <tr>
                    <td colspan="2" align="center">Haven't registered with us <a href="registration.php" style="text-decoration-line: none;">Click here</a></td>
                </tr>
            </table>  
        </center>
        
    </form>
</body>
</html>
