<?php
// class emailClass
// {

//     private $memberClass;

//     public function __construct(MemberClass $memberClass)
//     {
//         $this->memberClass = $memberClass;
//     }


//     public function sendAutomatedEmail($companyId, $i){
//         require '../config/dbconnect.php';  
//         if ($this->memberClass->isAdmin()) {
//             $dbName = $this->memberClass->getCompanyDBById($companyId);
//         } else {
//             $dbName = $this->memberClass->getCompanyDB();
//         }
//         $current_date = date('Y-m-d');
      
//         // Loop continuously
        
//             // Get the current date
           
      
//             // Query the database for emails to send today
//             $stmt = $conn->prepare("SELECT start_date FROM " . $dbName . ".focus WHERE start_date = ?");
//             $stmt->bind_param("s", $current_date);
//             $stmt->execute();
//             $result = $stmt->get_result();
      
//             // Send the emails
//             while ($row = $result->fetch_assoc()) {
//                 $to = $_POST["rows"][$i]["email"];
//                 $subject = "Automated Email";    
      
//                 $from = 'do-not-reply@performve.com';        
//                 $headers = "From: Performve <" . $from . ">\r\n";
//                 $headers .= "Reply-To: Performve <" . $from . ">\r\n";
//                 $headers .= "Return-Path: Performve <" . $from . ">\r\n";
//                 $headers .= "MIME-Version: 1.0\r\n";
//                 $headers .= "Content-Type: text/html; charset=UTF-8\r\n";    
//                 $body = "Dear User,\n\nThis is an automated email sent to $to on $current_date.\n\nBest regards,\nYour Name";
              
//                 mail($to, $subject, $body, $headers, "-f " . $from);
//             }
      
//             // Wait for 24 hours before checking again
//             //sleep(24 * 60 * 60);
        
      
//         // Close the database connection
//         $stmt->close();
//         $conn->close();
//     }


// }
require '../config/dbconnect.php';  
        // if ($this->memberClass->isAdmin()) {
        //     $dbName = $this->memberClass->getCompanyDBById($companyId);
        // } else {
        //     $dbName = $this->memberClass->getCompanyDB();
        // }
        $dbName = "assessment360";
        $current_date = date('Y-m-d');
      
        // Loop continuously
        
            // Get the current date
           
      
            // Query the database for emails to send today
            $stmt = $conn->prepare("SELECT email FROM " . $dbName . ".focus WHERE start_date = ?");
            $stmt->bind_param("s", $current_date);
            $stmt->execute();
            $result = $stmt->get_result();
      
            // Send the emails
            while ($row = $result->fetch_assoc()) {
                $to = $row["email"];
                $subject = "Automated Email";    
      
                $from = 'do-not-reply@performve.com';        
                $headers = "From: Performve <" . $from . ">\r\n";
                $headers .= "Reply-To: Performve <" . $from . ">\r\n";
                $headers .= "Return-Path: Performve <" . $from . ">\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=UTF-8\r\n";    
                $body = "Dear User,\n\nThis is an automated email sent to $to on $current_date.\n\nBest regards,\nYour Name";
              
                mail($to, $subject, $body, $headers, "-f " . $from);
            }
      
            // Wait for 24 hours before checking again
            //sleep(24 * 60 * 60);
        
      
        // Close the database connection
        $stmt->close();
        $conn->close();