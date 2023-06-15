<? 
class listofratersClass{

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

    public function getFocus_info_WithId($companyId)
    {
        require '../config/dbconnect.php';

        if ($this->memberClass->isAdmin()) {
            $dbName = $this->memberClass->getCompanyDBById($companyId);
        } else {
            $dbName = $this->memberClass->getCompanyDB();
        }
        $query = "SELECT * FROM " . $dbName . ".focus WHERE focus_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $_POST["focus_id"]);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result;
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
    
    public function addFocusData($companyId, $FocusfirstName, $FocuslastName, $startDate, $endDate, $roles, $gender, $position,$email)
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
    
    public function addRaterData($companyId,  $RaterfirstName, $RaterlastName,$roles, $gender, $position,$email)
    {
        require '../config/dbconnect.php';

        if ($this->memberClass->isAdmin()) {
            $dbName = $this->memberClass->getCompanyDBById($companyId);
        } else {
            $dbName = $this->memberClass->getCompanyDB();
        }

        $stmt = $conn->prepare("INSERT INTO " . $dbName . ".rater_list (rater_first_name, rater_last_name, roles, gender, position, email) VALUES (?, ?, ?, ?, ?,?)");
        $stmt->bind_param("ssssss", $RaterfirstName, $RaterlastName,$roles, $gender, $position,$email);
        $stmt->execute();
        $id = $stmt->insert_id;
        $stmt->close();

        return $id;
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

    public function updateRaterInfo($companyId,  $RaterfirstName, $RaterlastName,$roles, $gender, $position, $email)
    {
        require '../config/dbconnect.php';

        if ($this->memberClass->isAdmin()) {
            $dbName = $this->memberClass->getCompanyDBById($companyId);
        } else {
            $dbName = $this->memberClass->getCompanyDB();
        }
        $stmt = $conn->prepare("UPDATE " . $dbName . ".rater_list SET rater_first_name = ?, rater_last_name = ?,roles = ?, gender = ?, position = ?, email = ? WHERE rater_id = ?");
        $stmt->bind_param("ssssssi", $RaterfirstName, $RaterlastName,$roles, $gender, $position, $email, $_POST["rater_id"]);
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

   

   
}

    

  
  

/* code for what happens after activate button is clicked */







