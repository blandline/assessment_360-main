<?php
    // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // // extract the form data using the $_POST superglobal variable
    // $FOCUS_first_name = $_POST['FOCUS_first_name'];
    // $FOCUS_last_name = $_POST['FOCUS_last_name'];
    // $Launch_date = $_POST['Launch-date'];
    // $End_date = $_POST['End-date'];
    // $Rater_first_name = $_POST['Rater-first-name'];
    // $Rater_last_name = $_POST['Rater-last-name'];
    // $Roles = $_POST['Roles'];
    // $Genders = $_POST['Genders'];
    // $position = $_POST['position'];
    // $email = $_POST['email'];

    // // output the form data
    // echo "<p>FOCUS Name: {$FOCUS_first_name} {$FOCUS_last_name}</p>";
    // echo "<p>Launch Date: {$Launch_date}</p>";
    // echo "<p>End Date: {$End_date}</p>";
    // echo "<p>Rater Name: {$Rater_first_name} {$Rater_last_name}</p>";
    // echo "<p>Role: {$Roles}</p>";
    // echo "<p>Gender: {$Genders}</p>";
    // echo "<p>Position: {$position}</p>";
    // echo "<p>Email: {$email}</p>";
    //}

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // initialize an array to hold the form data
        $form_data = array();
      
        // iterate over the form data using a foreach loop
        foreach ($_POST['rows'] as $row) {
          // create a new associative array for each row
          $row_data = array(
            'FOCUS_first_name' => $row['FOCUS_first_name'],
            'FOCUS_last_name' => $row['FOCUS_last_name'],
            'Launch_date' => $row['Launch-date'],
            'End_date' => $row['End-date'],
            'Rater_first_name' => $row['Rater-first-name'],
            'Rater_last_name' => $row['Rater-last-name'],
            'Roles' => $row['Roles'],
            'Genders' => $row['Genders'],
            'position' => $row['position'],
            'email' => $row['email']
          );
      
          // add the row data to the form data array
          $form_data[] = $row_data;
        }
      // output the form data
        //output the form data array for testing
        print_r($form_data);
      }
?>