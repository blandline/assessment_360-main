<!-- <? include_once 'header.php'; ?> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rater list</title>
    <script src="../js/rater-list.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/rater-list.css">
</head>
   
<body>

<header>

</header>
<main>
    <div id="allcontainer">
    <div id="topbar">
    <?php
if (isset($_GET['submit']))
{
        $firstname = $_GET['focus_first_name'];
       
       
}
?>

</div>
<div id="formcontainer">
<form method="get" id="rateform" action="listofraters.php">


    <table id="raterlisttable">
        <tr>
            <th colspan="2"><p>FOCUS Name</p></th>
            <th colspan="2" rowspan="2"><p>Launch on</p></th>
            <th colspan="2" rowspan="2"><p>Ended on</p></th>
            <th colspan="2"><p>Raters</p></th>
            <th rowspan="2"><p>Role</p></th>
            <th rowspan="2"><p>Gender</p></th>
            <th rowspan="2"><p>Position</p></th>
            <th rowspan="2"><p>Email</p></th>
        </tr>

        <tr>
            <th><p>First</p></th>
            <th><p>Last</p></th>
            <th><p>First</p></th>
            <th><p>Last</p></th>
        </tr>

        <tr>
            <td><input type="text" name="FOCUS_first_name"></td>              
            <td><input type="text" name="FOCUS_last_name"></td>
            <td colspan="2"><input type="date" name="Launch-date"></td>
            <td colspan="2"><input type="date" name="End-date"></td>
            <td><input type="text" name="Rater-first-name"></td>
            <td><input type="text" name="Rater-last-name"></td>
            <td>
                <select name="Roles" id="roles">
                    <option value="FOCUS" name='focus_role'>FOCUS</option>
                    <option value="Manager" name='manager_role'>Manager</option>
                    <option value="Colleague" name='colleague_role'>Colleague</option>
                    <option value="Direct report" name='direct_report_role'>Direct report</option>
                    <option value="Other" name='other_role'>Other</option>
                </select>
            </td>
            <td>
                <select name="Genders" id="genders">
                    <option value="Male" name='male_gender'>Male</option>
                    <option value="Female" name='female_gender'>Female</option>
                    <option value="Other Gender" name='other_gender'>Other Gender</option>
                    
                </select>
            </td>
            <td><input type="text" name="position"></td>
            <td><input type="text" name="email"></td>
        </tr>
    </table> 
    <input type="submit" style="background-color:rgb(210, 56, 56); border-color:rgb(253, 253, 255); color:rgb(0, 0, 0)" value="Activate">
</form>

</div>
    </div>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // extract the form data using the $_GET superglobal variable
    $FOCUS_first_name = $_GET['FOCUS_first_name'];
    $FOCUS_last_name = $_GET['FOCUS_last_name'];
    $Launch_date = $_GET['Launch-date'];
    $End_date = $_GET['End-date'];
    $Rater_first_name = $_GET['Rater-first-name'];
    $Rater_last_name = $_GET['Rater-last-name'];
    $Roles = $_GET['Roles'];
    $Genders = $_GET['Genders'];
    $position = $_GET['position'];
    $email = $_GET['email'];

    // output the form data
    echo "<p>FOCUS Name: {$FOCUS_first_name} {$FOCUS_last_name}</p>";
    echo "<p>Launch Date: {$Launch_date}</p>";
    echo "<p>End Date: {$End_date}</p>";
    echo "<p>Rater Name: {$Rater_first_name} {$Rater_last_name}</p>";
    echo "<p>Role: {$Roles}</p>";
    echo "<p>Gender: {$Genders}</p>";
    echo "<p>Position: {$position}</p>";
    echo "<p>Email: {$email}</p>";
    }
?>
    

    <button onclick="addrow()">Add</button>
    <button onclick="deleterow()">Delete</button>
    <br>
    <br>
    
</main>
<footer>

</footer>
</body>
</html>