
<?php
// Define database connection variables
// $servername = "localhost";
// $username = "username";
// $password = "password";
// $dbname = "database_name";

// // Create database connection
// $conn = new mysqli($servername, $username, $password, $dbname);

// // Check if the connection is successful
// if ($conn->connect_error) {
//   die("Connection failed: " . $conn->connect_error);
// }

// Get form data
$focus_first_name = $_POST['FOCUS_first_name'];
$focus_last_name = $_POST['FOCUS_last_name'];
// $start_date = $_POST['Launch-date'];
// $end_date = $_POST['End-date'];
// $roles = $_POST['roles'];
// $genders = $_POST['genders'];
// $position = $_POST['position'];
// $employee_id = $_POST['employee_id'];
// $employee_first_name = $_POST['Rater_first_name'];
// $employee_last_name = $_POST['Rater_last_name'];

// Prepare SQL statement to insert data into FOCUS table
//$sql_FOCUS = "INSERT INTO FOCUS (FOCUS_first_name, FOCUS_last_name, start_date, end_date, roles, genders, position, employee_id) VALUES ('$FOCUS_first_name', '$FOCUS_last_name', '$start_date', '$end_date', '$roles', '$genders', '$position', '$employee_id')";

// Execute SQL statement to insert data into FOCUS table
// if ($conn->query($sql_FOCUS) === TRUE) {
//   echo "Data added to FOCUS table successfully.";
// } else {
//   echo "Error: " . $sql_FOCUS . "<br>" . $conn->error;
// }
echo $focus_first_name;
// Prepare SQL statement to insert data into employee table
// $sql_employee = "INSERT INTO employee (employee_first_name, employee_last_name, employee_id, roles, genders, position) VALUES ('$employee_first_name', '$employee_last_name', '$employee_id', '$roles', '$genders', '$position')";

// Execute SQL statement to insert data into employee table
// if ($conn->query($sql_employee) === TRUE) {
//   echo "Data added to employee table successfully.";
// } else {
//   echo "Error: " . $sql_employee . "<br>" . $conn->error;
// }

// Close database connection
// $conn->close();
?>
