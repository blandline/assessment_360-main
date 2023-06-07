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