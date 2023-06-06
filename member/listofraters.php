<? include_once 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rater list</title>
    <script src="rater-list.js"></script>
    <link rel="stylesheet" type="text/css" href="css/rater-list.css">
</head>
    <header>

    </header>
    <main>
        <form id="rateform" action="rater-list.php">
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
                    <td><input type="text" name="FOCUS-first-name"></td>                 
                    <td><input type="text" name="FOCUS-last-name"></td>
                    <td colspan="2"><input type="date" name="Launch-date"></td>
                    <td colspan="2"><input type="date" name="End-date"></td>
                    <td><input type="text" name="Rater-first-name"></td>
                    <td><input type="text" name="Rater-last-name"></td>
                    <td>
                        <select name="Roles" id="roles">
                            <option value="Focus" name>FOCUS</option>
                            <option value="manager" name>Manager</option>
                            <option value="colleague" name>Colleague</option>
                            <option value="direct-report" name>Direct report</option>
                            <option value="other" name>Other</option>
                        </select>
                    </td>
                    <td>
                        <select name="Genders" id="genders">
                            <option value="Focus" name>Male</option>
                            <option value="manager" name>Female</option>
                            <option value="other-gender" name>Other Gender</option>
                            
                        </select>
                    </td>
                    <td><input type="text" name="position"></td>
                    <td><input type="text" name="email"></td>
                </tr>
            </table>
        </form>
    
        <button onclick="addrow()">Add</button>
        <button onclick="deleterow()">Delete</button>
        <br>
        <br>
        <button style="background-color:rgb(210, 56, 56); border-color:rgb(253, 253, 255); color:rgb(0, 0, 0)">Activate
    </main>
    <footer>

    </footer>
<body>
    
</body>
</html>