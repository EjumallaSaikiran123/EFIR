<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body{
            background-image:url(home.jpg);
            background-size: cover;
            background-position: center;
            font-weight: bolder;
            color: black;
        }
        table{
            margin-top: 50px;
            
        }
        tr,td{
            font-size: 20px;
            padding-top: 20px;
            padding-bottom: 20px;
            padding-left: 15px;
            padding-right: 15px;
        }
    </style>
    <title>Police Login</title>
</head>
<body>
    <form action="request_tenant.php" method="post">
        <center>
            <table border="0px" align="center" style="padding-top: 10px;">
                <caption><h1>Register complaint for verification</h1></caption>
                <tr>
                    <td style="font-size: 20px;"><b><label for="Name">Name of the tenant:</label></b></td>
                    <td><input type="text" id="name" name="name" required></td>
                </tr>
                <tr>
                    <td style="font-size: 20px;"><b><label for="number">Number:</label></b></td>
                    <td><input type="text" id="text" name="text" required></td>
                </tr>
                <tr>
                    <td style="font-size: 20px;"><b><label for="station">Station:</label></b></td>
                    <td><select id="station" name="station" required>
                    <option value="abdullapurmet">abdullapurmet</option>
                    <option value="bhadrachalam">bhadrachalam</option>
                    <option value="khammam">khammam</option>
                    </td>
                </tr>
                <tr>
                    <td style="font-size: 20px;"><b><label for="address">Address:</label></b></td>
                    <td><input type="text" id="address" name="address" required>
                    </td>
                </tr>
                <tr>
                    <td align="center"><input type="submit" value="submit" target="main"></td>
                    <td align="center"><input type="reset" value="Clear"></td>
                </tr>
            </table>  
        </center>
        
    </form>
</body>
</html>