<?
 include 'Encryption.php';
class listofratersClass
{

    private $memberClass;

    public function __construct(MemberClass $memberClass)
    {
        $this->memberClass = $memberClass;
    }



    /* /// CODE TO GET INFO FROM FOCUS TABLE IN THE DATABASE*/

    // public function getFocus_first_name()
    // {
    //     require '../config/dbconnect.php';
    //     $query = "SELECT focus_first_name FROM focus WHERE focus_first_name IS NOT NULL ORDER BY focus_id";
    //     $stmt = $conn->prepare($query);
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    //     $stmt->close();

    //     return $result;
    // }


    // public function getFocus_last_name()
    // {
    //     require '../config/dbconnect.php';
    //     $query = "SELECT focus_last_name FROM focus WHERE focus_last_name IS NOT NULL ORDER BY focus_id";
    //     $stmt = $conn->prepare($query);
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    //     $stmt->close();

    //     return $result;
    // }



    // public function getFocus_start_date()
    // {
    //     require '../config/dbconnect.php';
    //     $query = "SELECT start_date FROM focus WHERE start_date IS NOT NULL ORDER BY focus_id";
    //     $stmt = $conn->prepare($query);
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    //     $stmt->close();

    //     return $result;
    // }

    // public function getFocus_end_date()
    // {
    //     require '../config/dbconnect.php';
    //     $query = "SELECT end_date FROM focus WHERE end_date IS NOT NULL ORDER BY focus_id";
    //     $stmt = $conn->prepare($query);
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    //     $stmt->close();

    //     return $result;
    // }
    // public function getFocus_gender()
    // {
    //     require '../config/dbconnect.php';
    //     $query = "SELECT gender FROM focus WHERE gender IS NOT NULL ORDER BY focus_id";
    //     $stmt = $conn->prepare($query);
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    //     $stmt->close();

    //     return $result;
    // }



    // public function getFocus_role()
    // {
    //     require '../config/dbconnect.php';
    //     $query = "SELECT roles FROM focus WHERE roles IS NOT NULL ORDER BY focus_id";
    //     $stmt = $conn->prepare($query);
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    //     $stmt->close();

    //     return $result;
    // }



    // public function getFocus_position()
    // {
    //     require '../config/dbconnect.php';
    //     $query = "SELECT position FROM focus WHERE position IS NOT NULL ORDER BY focus_id";
    //     $stmt = $conn->prepare($query);
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    //     $stmt->close();

    //     return $result;
    // }

    // public function getFocus_email()
    // {
    //     require '../config/dbconnect.php';
    //     $query = "SELECT email FROM focus WHERE email IS NOT NULL ORDER BY focus_id";
    //     $stmt = $conn->prepare($query);
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    //     $stmt->close();

    //     return $result;
    // }



    // /* code to get info for the rater_list table in the <database></database*/ 

    // public function getrater_first_name()
    // {
    //     require '../config/dbconnect.php';
    //     $query = "SELECT rater_first_name FROM rater_list WHERE rater_first_name IS NOT NULL ORDER BY rater_id";
    //     $stmt = $conn->prepare($query);
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    //     $stmt->close();

    //     return $result;
    // }

    // public function getrater_last_name()
    // {
    //     require '../config/dbconnect.php';
    //     $query = "SELECT rater_last_name FROM rater_list WHERE rater_last_name IS NOT NULL ORDER BY rater_id";
    //     $stmt = $conn->prepare($query);
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    //     $stmt->close();

    //     return $result;
    // }

    // public function getrater_gender()
    // {
    //     require '../config/dbconnect.php';
    //     $query = "SELECT gender FROM rater_list WHERE gender IS NOT NULL ORDER BY rater_id";
    //     $stmt = $conn->prepare($query);
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    //     $stmt->close();

    //     return $result;
    // }

    // public function getrater_role()
    // {
    //     require '../config/dbconnect.php';
    //     $query = "SELECT roles FROM rater_list WHERE roles IS NOT NULL ORDER BY rater_id";
    //     $stmt = $conn->prepare($query);
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    //     $stmt->close();

    //     return $result;
    // }

    // public function getrater_position()
    // {
    //     require '../config/dbconnect.php';
    //     $query = "SELECT position FROM rater_list WHERE position IS NOT NULL ORDER BY rater_id";
    //     $stmt = $conn->prepare($query);
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    //     $stmt->close();

    //     return $result;
    // }

    // public function getrater_email()
    // {
    //     require '../config/dbconnect.php';
    //     $query = "SELECT email FROM rater_list WHERE email IS NOT NULL ORDER BY rater_id";
    //     $stmt = $conn->prepare($query);
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    //     $stmt->close();

    //     return $result;
    // }

    /* get all info about focus with and without focus id*/

    public function getFocus_role()
    {
        require '../config/dbconnect.php';
        $query = "SELECT roles FROM focus WHERE roles IS NOT NULL ORDER BY focus_id";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result;
    }


    public function getFocus_info($companyId)
    {
        require '../config/dbconnect.php';

        if ($this->memberClass->isAdmin()) {
            $dbName = $this->memberClass->getCompanyDBById($companyId);
        } else {
            $dbName = $this->memberClass->getCompanyDB();
        }
        $query = "SELECT * FROM " . $dbName . ".focus";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result;
    }

    // public function getFocus_Id($companyId)
    // {
    //     require '../config/dbconnect.php';

    //     if ($this->memberClass->isAdmin()) {
    //         $dbName = $this->memberClass->getCompanyDBById($companyId);
    //     } else {
    //         $dbName = $this->memberClass->getCompanyDB();
    //     }

    //     // Prepare and execute the query
    //     $query = "SELECT focus_id FROM $dbName.focus";
    //     $stmt = $conn->prepare($query);
    //     $stmt->execute();

    //     // Handle errors that may occur during the query
    //     if ($stmt->error) {
    //         $error = $stmt->error;
    //         $stmt->close();
    //         $conn->close();
    //         return ['error' => $error];
    //     }

    //     $result = $stmt->get_result();
    //     $stmt->close();
    //     $conn->close();

    //     return $result;
    // }

    function getFocusId($companyId)
    {
        // Connect to the database
        require '../config/dbconnect.php';

        if ($this->memberClass->isAdmin()) {
            $dbName = $this->memberClass->getCompanyDBById($companyId);
        } else {
            $dbName = $this->memberClass->getCompanyDB();
        }

        // Execute the SELECT query to retrieve the focus_id value from the focus table
        $query = "SELECT focus_id FROM " . $dbName . ".focus";
        $result = $conn->query($query);

        // Check if the query returned any rows
        if ($result->num_rows > 0) {
            // Fetch the first row from the result set
            for ($i = 0; $i < $result->num_rows; $i++) {
                $row = $result->fetch_assoc();
            }

            // Store the focus_id value in a variable
            $focusId = $row['focus_id'];
        } else {
            // No rows were returned by the query
            $focusId = 0;
        }

        // Close the database connection
        $conn->close();

        // Return the focus_id value
        return $focusId;
    }




    /*get all info about raters with and without id*/

    public function getRater_info($companyId)
    {
        require '../config/dbconnect.php';

        if ($this->memberClass->isAdmin()) {
            $dbName = $this->memberClass->getCompanyDBById($companyId);
        } else {
            $dbName = $this->memberClass->getCompanyDB();
        }
        $query = "SELECT * FROM " . $dbName . ".rater_list";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result;
    }

    public function getRater_info_WithId($companyId)
    {
        require '../config/dbconnect.php';

        if ($this->memberClass->isAdmin()) {
            $dbName = $this->memberClass->getCompanyDBById($companyId);
        } else {
            $dbName = $this->memberClass->getCompanyDB();
        }
        $query = "SELECT * FROM " . $dbName . ".rater_list WHERE rater_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $_POST["rater_id"]);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result;
    }

    /* add values into focus table */

    public function addFocusData($companyId, $FocusfirstName, $FocuslastName, $startDate, $endDate, $roles, $gender, $position, $email)
    {
        require '../config/dbconnect.php';


        if ($this->memberClass->isAdmin()) {
            $dbName = $this->memberClass->getCompanyDBById($companyId);
        } else {
            $dbName = $this->memberClass->getCompanyDB();
        }

        $stmt = $conn->prepare("INSERT INTO " . $dbName . ".focus (focus_first_name, focus_last_name, start_date, end_date, roles, gender, position, email) VALUES (?, ?, ?, ?, ?, ?, ?,?)");
        $stmt->bind_param("ssssssss", $FocusfirstName, $FocuslastName, $startDate, $endDate, $roles, $gender, $position, $email);
        $stmt->execute();
        $id = $stmt->insert_id;
        $stmt->close();

        return $id;
    }

    /* add values into rater_list table */

    public function addRaterData($companyId,  $RaterfirstName, $RaterlastName, $focusID, $roles, $gender, $position, $email)

    {
        

        require '../config/dbconnect.php';

        if ($this->memberClass->isAdmin()) {
            $dbName = $this->memberClass->getCompanyDBById($companyId);
        } else {
            $dbName = $this->memberClass->getCompanyDB();
        }

        $stmt = $conn->prepare("INSERT INTO " . $dbName . ".rater_list (rater_first_name, rater_last_name, focus_id, roles, gender, position, email) VALUES (?, ?,?, ?, ?, ?,?)");
        $stmt->bind_param("sssssss", $RaterfirstName, $RaterlastName, $focusID, $roles, $gender, $position, $email);
        $stmt->execute();
        $id = $stmt->insert_id;
        $stmt->close();

        return $id;
    }

    // public function sendAutomatedEmail($companyId){
    //     require '../config/dbconnect.php';  
    //     if ($this->memberClass->isAdmin()) {
    //         $dbName = $this->memberClass->getCompanyDBById($companyId);
    //     } else {
    //         $dbName = $this->memberClass->getCompanyDB();
    //     }      

    //     // Loop continuously
    //     while (true) {
    //     // Get the current date
    //     $current_date = date('Y-m-d');

    //     // Query the database for emails to send today
    //     //$sql = "SELECT email FROM " . $dbName . ".focus WHERE start_date = ?";
    //     //$sql = "SELECT emails FROM rater_list WHERE desired_send_date = ?";
    //     //$stmt = $conn->prepare($sql);
    //     //$stmt->bind_param("s", $current_date);
    //     //$stmt->execute();
    //     //$result = $stmt->get_result();

    //     $stmt = $conn->prepare("SELECT email FROM " . $dbName . ".focus WHERE start_date = ?");
    //     $stmt->bind_param("s", $current_date);
    //     $stmt->execute();
    //     $result = $stmt->get_result();

    //     // Send the emails
    //         while ($row = $result->fetch_assoc()) {
    //             $to = $_POST["rows"][$i]["email"];
    //             $subject = "Automated Email";    
        
    //             $from = 'do-not-reply@performve.com';        
    //             $headers = "From: Performve <" . $from . ">\r\n";
    //             $headers .= "Reply-To: Performve <" . $from . ">\r\n";
    //             $headers .= "Return-Path: Performve <" . $from . ">\r\n";
    //             $headers .= "MIME-Version: 1.0\r\n";
    //             $headers .= "Content-Type: text/html; charset=UTF-8\r\n";    
    //             $body = "Dear User,\n\nThis is an automated email sent to $to on $current_date.\n\nBest regards,\nYour Name";
            
    //             mail($to, $subject, $body, $headers, "-f " . $from);

    //         // Wait for 24 hours before checking again
    //             sleep(24 * 60 * 60);
    //         }

    //     // Close the database connection
    //     $stmt->close();
    //     $conn->close();

    //     }
    // }

    // public function sendAutomatedEmail($companyId, $i){
    //     require '../config/dbconnect.php';  
    //     if ($this->memberClass->isAdmin()) {
    //         $dbName = $this->memberClass->getCompanyDBById($companyId);
    //     } else {
    //         $dbName = $this->memberClass->getCompanyDB();
    //     }
    //     $current_date = date('Y-m-d');
      
        
           
           
      
    //         // Query the database for emails to send today
    //         $stmt = $conn->prepare("SELECT email FROM " . $dbName . ".focus WHERE start_date = ?");
    //         $stmt->bind_param("s", $current_date);
    //         $stmt->execute();
    //         $result = $stmt->get_result();
    //         //$launchDate = $row['start_date'];
      
    //         // Send the emails
    //         while ($row = $result->fetch_assoc()) {
    //             $to = $_POST["rows"][$i]["email"];
    //             $subject = "Automated Email";    
      
    //             $from = 'do-not-reply@performve.com';        
    //             $headers = "From: Performve <" . $from . ">\r\n";
    //             $headers .= "Reply-To: Performve <" . $from . ">\r\n";
    //             $headers .= "Return-Path: Performve <" . $from . ">\r\n";
    //             $headers .= "MIME-Version: 1.0\r\n";
    //             $headers .= "Content-Type: text/html; charset=UTF-8\r\n";    
    //             $body = "Dear User,\n\nThis is an automated email sent to $to on $current_date.\n\nBest regards,\nYour Name"." http://localhost/assessment_360-main/member/assess360?a=questionnaire";
              
    //             mail($to, $subject, $body, $headers, "-f " . $from);
    //         }
      
    //         // Wait for 24 hours before checking again
    //         //sleep(24 * 60 * 60);
        
      
    //     // Close the database connection
    //     $stmt->close();
    //     $conn->close();
    // }

    
    // public function sendEmail($companyId, $i){
    //     require '../config/dbconnect.php';  
    //     if ($this->memberClass->isAdmin()) {
    //         $dbName = $this->memberClass->getCompanyDBById($companyId);
    //     } else {
    //         $dbName = $this->memberClass->getCompanyDB();
    //     }
    //     $current_date = date('Y-m-d');

      
    //     // Loop continuously
        
    //         // Get the current date
           
      
    //         // Query the database for emails to send today
    //         // $stmt = $conn->prepare("SELECT email,password FROM " . $dbName . ".rater_list WHERE start_date = ?");
    //         $stmt = $conn->prepare("SELECT email,password FROM " . $dbName . ".rater_list");            
    //         $stmt->execute();
    //         $result = $stmt->get_result();


    //         // Retrieve the rater's email and password from the `rater_list` table
        
    //         // $stmt->execute([$rater_id]);
    //         // $row = $stmt->fetch();

    //         // $email = $row['email'];
    //         // $password = $row['password'];

    //         // // Construct the link to the questionnaire
    //         // $link = 'https://example.com/questionnaire?' . 'password=' . urlencode($password);




      
    //         // Send the emails
    //         while ($row = $result->fetch_assoc()) {

    //             $email = $row['email'];
    //             $password = $row['password'];
    
    //             // Construct the link to the questionnaire
    //             $link = 'https://example.com/questionnaire?' . 'password=' . urlencode($password);
    
    //             $to = $_POST["rows"][$i]["email"];
    //             $subject = "Automated Email";    
      
    //             $from = 'do-not-reply@performve.com';        
    //             $headers = "From: Performve <" . $from . ">\r\n";
    //             $headers .= "Reply-To: Performve <" . $from . ">\r\n";
    //             $headers .= "Return-Path: Performve <" . $from . ">\r\n";
    //             $headers .= "MIME-Version: 1.0\r\n";
    //             $headers .= "Content-Type: text/html; charset=UTF-8\r\n";    
    //             $body = "Dear". $_POST["rows"][$i]["rater_first_name"] .",\n\nThis is an automated email sent to $to on $current_date.\n\nBest regards,\nYour Name"." http://localhost/assessment_360-main/member/assess360?a=questionnaire. Please click on the link below to access the questionnaire. You will need to enter the password provided below to access the questionnaire. Link:" . $link . "\r\n" .  "Password:" . $password . "\r\n";
                 
              
    //             mail($to, $subject, $body, $headers, "-f " . $from);
    //         }
      
    //         // Wait for 24 hours before checking again
    //         //sleep(24 * 60 * 60);
        
      
    //     // Close the database connection
    //     $stmt->close();
    //     $conn->close();
    // }
    // public function sendEmail($companyId, $i){
    //     require '../config/dbconnect.php';  
    //     if ($this->memberClass->isAdmin()) {
    //         $dbName = $this->memberClass->getCompanyDBById($companyId);
    //     } else {
    //         $dbName = $this->memberClass->getCompanyDB();
    //     }
    
    //     // Query the database for emails to send
    //     $stmt = $conn->prepare("SELECT email,password FROM " . $dbName . ".rater_list");            
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    
    //     // Send the emails
    //     while ($row = $result->fetch_assoc()) {
    //         $email = $row['email'];
    //         $password = $row['password'];
    
    //         // Construct the link to the questionnaire
    //         $link = 'https://example.com/questionnaire?' . 'password=' . urlencode($password);
    
    //         // Construct the email message
    //         $to = $_POST["rows"][$i]["email"];
    //         $subject = "Automated Email";    
    //         $from = 'do-not-reply@performve.com';        
    //         $headers = "From: Performve <" . $from . ">\r\n";
    //         $headers .= "Reply-To: Performve <" . $from . ">\r\n";
    //         $headers .= "Return-Path: Performve <" . $from . ">\r\n";
    //         $headers .= "MIME-Version: 1.0\r\n";
    //         $headers .= "Content-Type: text/html; charset=UTF-8\r\n";    
    //         $body = "Dear ". $_POST["rows"][$i]["rater_first_name"] .",\n\nThis is an automated email sent to $to.\n\nBest regards,\nYour Name"." http://localhost/assessment_360-main/member/assess360?a=questionnaire. Please click on the link below to access the questionnaire. You will need to enter the password provided below to access the questionnaire. Link:" . $link . "\r\n" .  "Password:" . $password . "\r\n";
    
    //         // Send the email
    //         mail($to, $subject, $body, $headers, "-f " . $from);
    //     }
    
    //     // Close the database connection
    //     $stmt->close();
    //     $conn->close();
    // }
    // public function sendEmail($companyId, $rater_email){
    //     require '../config/dbconnect.php';  
    //     if ($this->memberClass->isAdmin()) {
    //         $dbName = $this->memberClass->getCompanyDBById($companyId);
    //     } else {
    //         $dbName = $this->memberClass->getCompanyDB();
    //     }
    
    //     // Query the database for the rater's password
    //     $stmt = $conn->prepare("SELECT password FROM " . $dbName . ".rater_list WHERE email = ?");            
    //     $stmt->bind_param("s", $rater_email);
    //     $stmt->execute();
    //     $stmt->bind_result($password);
    //     $stmt->fetch();
    
    //     if ($password) {
    //         // Construct the link to the questionnaire
    //         $link = 'https://example.com/questionnaire?' . 'password=' . urlencode($password);
    
    //         // Construct the email message
    //         $to = $rater_email;
    //         $subject = "Automated Email";    
    //         $from = 'do-not-reply@performve.com';        
    //         $headers = "From: Performve <" . $from . ">\r\n";
    //         $headers .= "Reply-To: Performve <" . $from . ">\r\n";
    //         $headers .= "Return-Path: Performve <" . $from . ">\r\n";
    //         $headers .= "MIME-Version: 1.0\r\n";
    //         $headers .= "Content-Type: text/html; charset=UTF-8\r\n";    
    //         $body = "Dear ". $rater_email .",\n\nThis is an automated email sent to $to.\n\nBest regards,\nYour Name"." http://localhost/assessment_360-main/member/assess360?a=questionnaire. Please click on the link below to access the questionnaire. You will need to enter the password provided below to access the questionnaire. Link:" . $link . "\r\n" .  "Password:" . $password . "\r\n";
    
    //         // Send the email
    //         mail($to, $subject, $body, $headers, "-f " . $from);
    //     }
    
    //     // Close the database connection
    //     $stmt->close();
    //     $conn->close();
    // }

    // public function sendEmail($companyId, $rater_email){
    //     require '../config/dbconnect.php';  
    //     if ($this->memberClass->isAdmin()) {
    //         $dbName = $this->memberClass->getCompanyDBById($companyId);
    //     } else {
    //         $dbName = $this->memberClass->getCompanyDB();
    //     }
    
    //     // Query the database for the rater's password
    //     $stmt = $conn->prepare("SELECT password FROM " . $dbName . ".rater_list WHERE email = ? ORDER BY rater_id DESC LIMIT 1");            
    //     $stmt->bind_param("s", $rater_email);
    //     $stmt->execute();
    //     $stmt->bind_result($password);
    //     $stmt->fetch();
    
    //     if ($password) {
    //         // Construct the link to the questionnaire
    //         $link = 'http://localhost/assessment_360-main/member/assess360?a=questionnaire';
    
    //         // Construct the email message
    //         $to = $rater_email;
    //         $subject = "Automated Email";    
    //         $from = 'do-not-reply@performve.com';        
    //         $headers = "From: Performve <" . $from . ">\r\n";
    //         $headers .= "Reply-To: Performve <" . $from . ">\r\n";
    //         $headers .= "Return-Path: Performve <" . $from . ">\r\n";
    //         $headers .= "MIME-Version: 1.0\r\n";
    //         $headers .= "Content-Type: text/html; charset=UTF-8\r\n";    
    //         $body = "Dear ". $rater_email .",\n\nThis is an automated email sent to $to.\n\nBest regards,\nYour Name"." http://localhost/assessment_360-main/member/assess360?a=questionnaire.  Please click on the link below to access the questionnaire. You will need to enter the password provided below to access the questionnaire. Link:   " . $link . "\r\n" .  "    Password:   " . $password . "\r\n";
    
    //         // Send the email
    //         mail($to, $subject, $body, $headers, "-f " . $from);
    //     }
    
    //     // Close the database connection
    //     $stmt->close();
    //     $conn->close();
    // }
    public function sendEmail($companyId, $rater_email){
        require '../config/dbconnect.php';  
        if ($this->memberClass->isAdmin()) {
            $dbName = $this->memberClass->getCompanyDBById($companyId);
        } else {
            $dbName = $this->memberClass->getCompanyDB();
        }
    
        // Query the database for the rater's password
        $stmt = $conn->prepare("SELECT password FROM " . $dbName . ".rater_list WHERE email = ? ORDER BY rater_id DESC LIMIT 1");            
        $stmt->bind_param("s", $rater_email);
        $stmt->execute();
        $stmt->bind_result($password);
        $stmt->fetch();
    
        if ($password) {
            // Construct the link to the questionnaire
            $link = 'http://localhost/assessment_360-main/member/assess360?a=questionnaire';
    
            // Construct the email message
            $to = $rater_email;
            $subject = "Automated Email";    
            $from = 'do-not-reply@performve.com';        
            $headers = "From: Performve <" . $from . ">\r\n";
            $headers .= "Reply-To: Performve <" . $from . ">\r\n";
            $headers .= "Return-Path: Performve <" . $from . ">\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";    
            $body = "Dear ". $rater_email .",<br><br>This is an automated email sent to $to.<br><br>Best regards,<br>Your Name<br><br>Please click on the link below to access the questionnaire. You will need to enter the password provided below to access the questionnaire.<br><br><a href='" . $link . "'>" . $link . "</a><br><br>Password: " . $password;
    
            // Send the email
            mail($to, $subject, $body, $headers, "-f " . $from);
        }
    
        // Close the database connection
        $stmt->close();
        $conn->close();
    }


   



    // public function generatePassword($companyId){
    //     require '../config/dbconnect.php';  
    //     if ($this->memberClass->isAdmin()) {
    //         $dbName = $this->memberClass->getCompanyDBById($companyId);
    //     } else {
    //         $dbName = $this->memberClass->getCompanyDB();
    //     }

    //             // Generate a random password for each rater in the `rater_list` table
    //     $stmt = $conn->prepare("SELECT rater_id FROM ".$dbName. ".rater_list");
    //     $stmt->execute();

    //     while ($row = $stmt->fetch()) {
    //         // Generate a random password
    //         $password = bin2hex(random_bytes(8));

    //         // Hash the password using the bcrypt algorith
    //         $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    //         // Update the `password` column in the `rater_list` table for the current rater
    //         $stmt2 = $conn->prepare("UPDATE " .$dbName. ".rater_list SET password = ? WHERE rater_id = ?");
    //         $stm2->bind_param("ss",$password,[$hashed_password, $row['rater_id']]);
    //         $stmt2->execute();
    //     }

    //     $email = $_POST['email'];
    //     $password = $_POST['password'];

    //     // Connect to the database
    //     //$pdo = new PDO('mysql:host=localhost;dbname=your_database_name', 'your_username', 'your_password');

    //     // Retrieve the hashed password from the database for the given email
    //     $stmt = $conn->prepare("SELECT password FROM " . $dbName . ".rater_list WHERE email = ?");
    //     $stm2->bind_param("s",$password,$email);
    //     $stmt->execute();
    //     $row = $stmt->fetch();

    //     // Verify the password
    //     if (password_verify($password, $row['password'])) {
    //         // Display the questionnaire
    //         // ...
    //         header("Location: questionnaireView.php");
    //     } else {
    //         // Display an error message
    //         echo 'Invalid password.';
    //     }
    //     $stmt->close();
    //     $conn->close();
    // }

    // public function generatePassword($companyId){
    //     require '../config/dbconnect.php';  
    //     if ($this->memberClass->isAdmin()) {
    //         $dbName = $this->memberClass->getCompanyDBById($companyId);
    //     } else {
    //         $dbName = $this->memberClass->getCompanyDB();
    //     }
    
    //     // Generate a random password for each rater in the `rater_list` table
    //     $stmt = $conn->prepare("SELECT rater_id FROM ".$dbName. ".rater_list");
    //     $stmt->execute();
    
    //     while ($row = $stmt->fetch()) {
    //         // Generate a random password
    //         $password = bin2hex(random_bytes(8));
    
    //         // Hash the password using the bcrypt algorithm
    //         $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    //         // Update the `password` column in the `rater_list` table for the current rater
    //         $stmt2 = $conn->prepare("UPDATE " .$dbName. ".rater_list SET password = ? WHERE rater_id = ?");
    //         $stmt2->bind_param("ss", $hashed_password, $row['rater_id']);
    //         $stmt2->execute();
    //     }
    
    //     $email = $_POST['email'];
    //     $password = $_POST['password'];
    
    //     // Connect to the database
    //     //$pdo = new PDO('mysql:host=localhost;dbname=your_database_name', 'your_username', 'your_password');
    
    //     // Retrieve the hashed password from the database for the given email
    //     $stmt = $conn->prepare("SELECT password FROM " . $dbName . ".rater_list WHERE email = ?");
    //     $stmt->bind_param("s", $email);
    //     $stmt->execute();
    //     $row = $stmt->fetch_assoc();
    
    //     if ($row !== false) {
    //         // Verify the password
    //         if (password_verify($password, $row['password'])) {
    //             // Display the questionnaire
    //             // ...
    //             header("Location: questionnaireView.php");
    //         } else {
    //             // Display an error message
    //             echo 'Invalid password.';
    //         }
    //     } else {
    //         // Display an error message
    //         echo 'Email address not found.';
    //     }
    
    //     $stmt->close();
    //     $conn->close();
    // }

    // public function generatePassword($companyId) {
    //     require '../config/dbconnect.php';  
    //     if ($this->memberClass->isAdmin()) {
    //         $dbName = $this->memberClass->getCompanyDBById($companyId);
    //     } else {
    //         $dbName = $this->memberClass->getCompanyDB();
    //     }
    
    //     // Generate a random password for each rater in the `rater_list` table
    //     $stmt = $conn->prepare("SELECT rater_id FROM ".$dbName. ".rater_list");
    //     $stmt->execute();
    
    //     while ($row = $stmt->fetch()) {
    //         // Generate a random password
    //         $password = bin2hex(random_bytes(8));
    
    //         // Hash the password using the bcrypt algorithm
    //         $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    //         // Update the `password` column in the `rater_list` table for the current rater
    //         $stmt2 = $conn->prepare("UPDATE " .$dbName. ".rater_list SET password = ? WHERE rater_id = ?");
    //         $stmt2->bind_param("ss", $hashed_password, $row['rater_id']);
    //         $stmt2->execute();
    //         $stmt2->close(); // Close the result set of the second prepared statement
    //     }

    //     $stmt->close();
    //     $conn->close();
    // }
    // public function generatePassword($companyId) {
        
    //     require '../config/dbconnect.php';
    // if ($this->memberClass->isAdmin()) {
    //     $dbName = $this->memberClass->getCompanyDBById($companyId);
    // } else {
    //     $dbName = $this->memberClass->getCompanyDB();
    // }

  

    // // Check for errors
    // if ($conn->connect_error) {
    //     die("Connection failed: " . $conn->connect_error);
    // }

    // // Prepare the SQL statement
    // $stmt = $conn->prepare("SELECT rater_id FROM ".$dbName. ".rater_list");
    // $stmt->execute();
    // $result = $stmt->get_result();

    // // Loop through the results and generate a random password for each rater
    // while ($row = $result->fetch_assoc()) {
    //     // Generate a random password
    //     $password = bin2hex(random_bytes(8));

    //     // Hash the password using the bcrypt algorithm
    //     $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    //     // Update the password for the current rater
    //     $stmt2 = $conn->prepare("UPDATE " .$dbName. ".rater_list SET password=? WHERE rater_id=?");
    //     $stmt2->bind_param("si", $hashed_password, $row['rater_id']);
    //     $stmt2->execute();
    //     $stmt2->close();
    // }

    // // Close the database connection
    // $stmt->close();
    // $conn->close();
  
       
    // }

    public function generatePassword($companyId) {
        require '../config/dbconnect.php';
        
        if ($this->memberClass->isAdmin()) {
            $dbName = $this->memberClass->getCompanyDBById($companyId);
        } else {
            $dbName = $this->memberClass->getCompanyDB();
        }
      
        // Check for errors
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    
        // Prepare the SQL statement
        $stmt = $conn->prepare("SELECT rater_id FROM ".$dbName. ".rater_list");
        $stmt->execute();
        $result = $stmt->get_result();
    
        // Loop through the results and generate a random password for each rater
        while ($row = $result->fetch_assoc()) {
            // Generate a random password
            $random_chars = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 4);
            $password = $random_chars . $dbName . $random_chars;
    
            // Hash the password using the bcrypt algorithm
            //$hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $hashed_password = encrypt($password);
            

    
            // Update the password for the current rater
            $stmt2 = $conn->prepare("UPDATE " .$dbName. ".rater_list SET password=? WHERE rater_id=?");
            $stmt2->bind_param("si", $hashed_password, $row['rater_id']);
            $stmt2->execute();
            $stmt2->close();
        }
    
        // Close the database connection
        $stmt->close();
        $conn->close();
    }
   
       
        
    

       


   

            


    // function printTable($companyId){

    //     require '../config/dbconnect.php';

    //     if ($this->memberClass->isAdmin()) {
    //         $dbName = $this->memberClass->getCompanyDBById($companyId);
    //     } else {
    //         $dbName = $this->memberClass->getCompanyDB();
    //     }


    //     // Select data from the table
    //     $query = "SELECT * FROM " . $dbName . ".rater_list";
    //     $result = $conn->query($query);
    //     // Check if there are any rows returned
    //     if ($result->num_rows > 0) {
    //         // Output data of each row in a table format
    //         // echo "<table border='1'>";            
    //         // echo "<tr><th>First Name</th><th>Last Name</th><th>Role</th><th>Gender</th><th>Position</th><th>Email</th></tr>";
    //         echo "<table style='border-collapse: collapse;'>";
    //     echo "<tr style='background-color: white; color: red;'><th style='padding: 10px;'>First Name</th><th style='padding: 10px;'>Last Name</th><th style='padding: 10px;'>Role</th><th style='padding: 10px;'>Gender</th><th style='padding: 10px;'>Position</th><th style='padding: 10px;'>Email</th></tr>";
    //         while ($row = $result->fetch_assoc()) {
    //         //     echo "<tr><td>" . $row["rater_first_name"] . "</td><td>" . $row["rater_last_name"] ."</td><td>" . $row["roles"] . "</td><td>" . $row["gender"] . "</td><td>" . $row["position"] . "</td><td>" . $row["email"] . "</td></tr>";
    //         // }
    //         // echo "</table>";
    //         echo "<tr style='background-color: #fff; color: #333;'><td style='padding: 10px;'>" . $row["rater_first_name"] . "</td><td style='padding: 10px;'>" . $row["rater_last_name"] ."</td><td style='padding: 10px;'>" . $row["roles"] . "</td><td style='padding: 10px;'>" . $row["gender"] . "</td><td style='padding: 10px;'>" . $row["position"] . "</td><td style='padding: 10px;'>" . $row["email"] . "</td></tr>";
    //     }
    //     echo "</table>";
    //     } else {
    //         echo "No data found in the table.";
    //     }

    //     // Close the database connection
    //     $conn->close();

    // }

    //     public function printTabletwo($companyId)
    // {
    //     require '../config/dbconnect.php';
    //     if ($this->memberClass->isAdmin()) {
    //         $dbName = $this->memberClass->getCompanyDBById($companyId);
    //     } else {
    //         $dbName = $this->memberClass->getCompanyDB();
    //     }

    //     $query = "SELECT *
    //             FROM ". $dbName. ".focus f
    //             JOIN ". $dbName. ".rater_list rl ON f.focus_id = rl.focus_id";
    //     $result = $conn->query($query);
    //     if ($result->num_rows > 0) {
    //         echo "<table style='border-collapse: collapse;'>";
    //        echo "<tr style='background-color: white; color: #f44336; font-size: 300;'><th style='padding: 10px; font-size: 15; font-weight: 4;'>Focus first Name</th><th style='padding: 10px; font-size: 15; font-weight: 4;'>Focus Last Name</th><th style='padding: 10px; font-size: 15; font-weight: 4;'>Focus ID</th><th style='padding: 10px; font-size: 15; font-weight: 4;'>Start Date</th><th style='padding: 10px; font-size: 15;font-weight: 4;'>End Date</th><th style='padding: 10px; font-size: 15; font-weight: 4;'>Rater First Name</th><th style='padding: 10px; font-size: 15; font-weight: 4;'>RaterLast Name</th><th style='padding: 10px; font-size: 15; font-weight: 4;'>Role</th><th style='padding: 10px; font-size: 15; font-weight: 4;'>Gender</th><th style='padding: 10px; font-size: 15; font-weight: 4;'>Position</th><th style='padding: 10px; font-size: 15; font-weight: 4;'>Email</th></tr>";
    //         while ($row = $result->fetch_assoc()) {
    //             echo "<tr style='background-color: #fff; color: #333; font-size: 15; font-weight:4;'><td style='padding: 10px;'>" . $row["focus_first_name"] . "</td><td style='padding: 10px;'>" . $row["focus_last_name"] ."</td><td style='padding: 10px;'>" . $row["focus_id"]. "</td><td style='padding: 10px;'>" . $row["start_date"] . "</td><td style='padding: 10px;'>" . $row["end_date"]."</td><td style='padding: 10px;'>" . $row["rater_first_name"] ."</td><td style='padding: 10px;'>" . $row["rater_last_name"] ."</td><td style='padding: 10px;'>" . $row["roles"] . "</td><td style='padding: 10px;'>" . $row["gender"] . "</td><td style='padding: 10px;'>" . $row["position"] . "</td><td style='padding: 10px;'>" . $row["email"] . "</td></tr>";
    //         }
    //         echo "</table>";
    //     } else {
    //         echo "No data found in the table.";
    //     }

    //     // Close the database connection
    //     $conn->close();
    // }
    public function printTabletwo($companyId)
    {
        require '../config/dbconnect.php';
        if ($this->memberClass->isAdmin()) {
            $dbName = $this->memberClass->getCompanyDBById($companyId);
        } else {
            $dbName = $this->memberClass->getCompanyDB();
        }

        $query = "SELECT *
              FROM " . $dbName . ".focus f
              JOIN " . $dbName . ".rater_list rl ON f.focus_id = rl.focus_id
              ORDER BY f.focus_id";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $currentFocusId = null;
        echo "<table style='border-collapse: collapse;'>";
        while ($row = $result->fetch_assoc()) {
            if ($currentFocusId !== $row['focus_id']) {
                // Start new table for different focus_id value
                if ($currentFocusId !== null) {
                    echo "</table><br><br>";
                }
                $currentFocusId = $row['focus_id'];
                //echo "<h3> Focus ID: $currentFocusId</h3>";
                
                echo "<table style='border-collapse: collapse;'>";
                echo "<tr style='background-color: white; color: #f44336;'><th style='padding: 10px;'>Focus first Name</th><th style='padding: 10px;'>Focus Last Name</th><th style='padding: 10px;'>Start Date</th><th style='padding: 10px;'>End Date</th><th style='padding: 10px;'>Rater First Name</th><th style='padding: 10px;'>RaterLast Name</th><th style='padding: 10px;'>Role</th><th style='padding: 10px;'>Gender</th><th style='padding: 10px;'>Position</th><th style='padding: 10px;'>Email</th></tr>";
            }
            echo "<tr style='background-color: #fff; color: #333;'><td style='padding: 10px;'>" . $row["focus_first_name"] . "</td><td style='padding: 10px;'>" . $row["focus_last_name"] ."</td><td style='padding: 10px;'>" . $row["start_date"] . "</td><td style='padding: 10px;'>" . $row["end_date"]."</td><td style='padding: 10px;'>" . $row["rater_first_name"] ."</td><td style='padding: 10px;'>" . $row["rater_last_name"] ."</td><td style='padding: 10px;'>" . $row["roles"] . "</td><td style='padding: 10px;'>" . $row["gender"] . "</td><td style='padding: 10px;'>" . $row["position"] . "</td><td style='padding: 10px;'>" . $row["email"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "No data found in the table.";
    }

        // Close the database connection
        $conn->close();
    }














    /* update focus and rater info */


    public function updateFocusInfo($companyId,  $FocusfirstName, $FocuslastName, $startDate, $endDate, $roles, $gender, $position, $email)
    {
        require '../config/dbconnect.php';

        if ($this->memberClass->isAdmin()) {
            $dbName = $this->memberClass->getCompanyDBById($companyId);
        } else {
            $dbName = $this->memberClass->getCompanyDB();
        }
        $stmt = $conn->prepare("UPDATE " . $dbName . ".focus SET focus_first_name = ?, focus_last_name = ?, start_date = ?, end_date = ?, roles = ?, gender = ?, position = ?, email = ? WHERE focus_id = ?");
        $stmt->bind_param("ssssssssi", $FocusfirstName, $FocuslastName, $startDate, $endDate, $roles, $gender, $position, $email, $_POST["focus_id"]);
        $stmt->execute();
        $stmt->close();
    }

    public function updateRaterInfo($companyId,  $RaterfirstName, $RaterlastName, $roles, $gender, $position, $email)
    {
        require '../config/dbconnect.php';

        if ($this->memberClass->isAdmin()) {
            $dbName = $this->memberClass->getCompanyDBById($companyId);
        } else {
            $dbName = $this->memberClass->getCompanyDB();
        }
        $stmt = $conn->prepare("UPDATE " . $dbName . ".rater_list SET rater_first_name = ?, rater_last_name = ?,roles = ?, gender = ?, position = ?, email = ? WHERE rater_id = ?");
        $stmt->bind_param("ssssssi", $RaterfirstName, $RaterlastName, $roles, $gender, $position, $email, $_POST["rater_id"]);
        $stmt->execute();
        $stmt->close();
    }




    /* Delete focus and rater info */

    public function deleteFocusInfo($companyId)
    {
        require '../config/dbconnect.php';

        if ($this->memberClass->isAdmin()) {
            $dbName = $this->memberClass->getCompanyDBById($companyId);
        } else {
            $dbName = $this->memberClass->getCompanyDB();
        }

        $stmt = $conn->prepare("DELETE FROM " . $dbName . ".focus WHERE focus_id = ?");
        $stmt->bind_param("i", $_POST["focus_id"]);
        $stmt->execute();
        $stmt->close();
    }

    public function deleteRaterInfo($companyId)
    {
        require '../config/dbconnect.php';

        if ($this->memberClass->isAdmin()) {
            $dbName = $this->memberClass->getCompanyDBById($companyId);
        } else {
            $dbName = $this->memberClass->getCompanyDB();
        }

        $stmt = $conn->prepare("DELETE FROM " . $dbName . ".rater_list WHERE rater_id = ?");
        $stmt->bind_param("i", $_POST["rater_id"]);
        $stmt->execute();
        $stmt->close();
    }

    public function getrater_email()
    {
        require '../config/dbconnect.php';
        $query = "SELECT email FROM rater_list WHERE email IS NOT NULL ORDER BY rater_id";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result;
    }

    public function getFocus_email()
    {
        require '../config/dbconnect.php';
        $query = "SELECT email FROM focus WHERE email IS NOT NULL ORDER BY focus_id";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result;
    }


    public function print_comp_selection_tb()
    {
        require '../config/dbconnect.php';

        if ($this->memberClass->isAdmin()) {
            $dbName = $this->memberClass->getCompanyDBById($companyId);
        } else {
            $dbName = $this->memberClass->getCompanyDB();
        }
        // Fetch data from the database
        $sql = "SELECT * FROM " . $dbName . ".focus";
        $result = $conn->query($sql);

        // Generate the HTML table
        echo '<table id="raterlisttable" class="table table-hover" style="width:100%;">
        <thead class="text-danger">
          <tr>
          <th><?= $language["competency_focus_selection_firstname"]?></th>
          <th><?= $language["competency_focus_selection_lastname"]?></th>
          <th><?= $language["competency_focus_selection_position"]?></th>
          <th><?= $language["competency_focus_selection_launchdate"]?></th>
          <th><?= $language["competency_focus_selection_enddate"]?></th>
          <th><?= $language["competency_focus_selection_action"]?></th>
          <th style="display:none"><?= $language["competency_focus_selection_focusid"]?></th>
          </tr>
        </thead>
        <tbody>';

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<tr>
                <td>' . $row["focus_first_name"] . '</td>
                <td>' . $row["focus_last_name"] . '</td>
                <td>' . $row["position"] . '</td>
                <td>' . $row["start_date"] . '</td>
                <td>' . $row["end_date"] . '</td>
                <td><button class="btn btn-primary btn-sm goto-competency-selection" data-id="' . $row["focus_id"] . '">Competency Selection</button></td>
                <td style="display:none">' . $row["focus_id"] . '</td>
              </tr>';
            }
        } else {
            echo '<tr><td colspan="7">No data available</td></tr>';
        }

        echo '</tbody></table>';

        // Close the database connection
        $conn->close();
    }
}

    

  
  

/* code for what happens after activate button is clicked */
