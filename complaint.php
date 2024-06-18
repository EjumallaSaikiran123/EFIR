<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        tr,td{
            padding-left: 20px;
            padding-right: 20px;
        }
        body{
            background-color: beige;
        }
    </style>
    <title>Lodge a Complaint</title>
</head>
<body>
    <center><h1>Report a Crime</h1></center>
    <form name="complaintform" action="complaint_process.php" method="post">
        <table align="left">
            <tr>
                <td>1.</td>
                <td><pre>District: <input type="text" name="district"></pre></td>
                <td><pre>Police Station: <select name="police_station">
                <option value="abdullapurmet">abdullapurmet</option>
                <option value="bhadrachalam">bhadrachalam</option>
                <option value="khammam">khammam</option>
                </select></td>
                <td><pre>Date: <input type="date" name="date_of_complaint"></pre></td>
            </tr>
            <tr>
                <td><pre>2.</pre></td>
                <td colspan="3"><pre>Occurence of the offence</pre></td>
            </tr>
            <tr>
                <td></td>
                <td><pre>Day: <select name="day_of_offence">
                    <option>Sunday</option>
                    <option>Monday</option>
                    <option>Tuesday</option>
                    <option>Wednesday</option>
                    <option>Thursday</option>
                    <option>Friday</option>
                    <option>Saturday</option>
                </select></pre></td>
                <td><pre>Date: <input type="date" name="date_of_offence"></pre></td>
                <td><pre>Time: <input type="time" name="time_of_offence"></pre></td>
            </tr>
            <tr>
                <td><pre>3.</pre></td>
                <td colspan="3"><pre>Information about the offence:</pre></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="3"><textarea rows="10" cols="125" name="information">Enter your information Here</textarea></td>
            </tr>
            <tr>
                <td><pre>4.</pre></td>
                <td colspan="3"><pre>Place of the occurence and detailed address:</pre></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="3"><textarea rows="5" cols="125" name="place_of_offence">Enter address and distance from the police station</textarea></td>
            </tr>
            <tr>
                <td><pre>5.</pre></td>
                <td colspan="3"><pre>Contact Information of The reporter</pre></td>
            </tr>
            <tr>
                <td></td>
                <td><pre>Name: <input type="text" name="name_of_complaintgiver"></pre></td>
                <td><pre>Father/Husband Name: <input type="text" name="fhname_of_complaintgiver"></pre></td>
                <td><pre>Date of Birth: <input type="date" name="dob_of_complaintgiver"></pre></td>
            </tr>
            <tr>
                <td></td>
                <td><pre>Nationality: <select name="nationality_of_complaintgiver">
                    <option>Select</option>
                    <option>India</option>
                    <option>USA</option>
                    <option>Canada</option>
                    <option>Brazil</option>
                </select></pre></td>
                <td><pre>Passport Number: <input type="text" name="passport"></pre></td>
                <td><pre>Occupation: <input type="text" name="occupation"></pre></td>
            </tr>
            <tr>
                <td><pre>6.</pre></td>
                <td colspan="3"><pre>Details of suspects/known offenders</pre></td>
            </tr>
            <tr>
                <td></td>
                <td><pre>Name: <input type="text" name="name_of_suspect"></pre></td>
                <td><pre>Age: <input type="Number" name="age_of_suspect"></pre></td>
                <td><pre>Gender: <select name="gender_of_suspect">
                    <option>Select</option>
                    <option>Male</option>
                    <option>Female</option>
                    <option>Others</option>
                </select></pre></td>
            </tr>
            <tr>
                <td></td>
                <td><pre>Occupation: <input type="text" name="occupation_of_suspect"></pre></td>
                <td><pre>Village: <input type="text" name="village_of_suspect"></pre></td>
                <td><pre>Person: <select name="person">
                <option value="Select">Select</option>
                <option value="Adult">Adult</option>
                <option value="Child">Child</option>
                <option value="Senior">Senior</option>
                </select></td>
            </tr>
            <tr>
                <td>7.</td>
                <td colspan="3"><pre style="font-weight: bolder;"><input type="checkbox" name="acceptance" required>  I accept that the above given information is true to my knowledge and i understand that I will hvae to face the penance if the agreed statement is 
                    false</pre></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="3" align="center"><pre><input type="submit" value="Submit">                                       <input type="reset" value="Reset"></pre></td>
            </tr>
        </table>
    </form>
</body>
</html>