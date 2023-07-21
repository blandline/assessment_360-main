<?
class CompetencyClass
{
    private $memberClass;

    public function __construct(MemberClass $memberClass)
    {
        $this->memberClass = $memberClass;
    }


    public function getCompetencyCluster()
    {
        require '../config/dbconnect.php';
        $query = "SELECT * FROM competency WHERE parent_id = -1 ORDER BY order_id";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result;
    }




    public function getCompetencyFrameworkPosition($companyId)
    {
        require '../config/dbconnect.php';

        if ($this->memberClass->isAdmin()) {
            $dbName = $this->memberClass->getCompanyDBById($companyId);
        } else {
            $dbName = $this->memberClass->getCompanyDB();
        }
        $query = "SELECT * FROM " . $dbName . ".competency_frm_position";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result;
    }

    public function getCompetencyFrameworkPositionWithId($companyId)
    {
        require '../config/dbconnect.php';

        if ($this->memberClass->isAdmin()) {
            $dbName = $this->memberClass->getCompanyDBById($companyId);
        } else {
            $dbName = $this->memberClass->getCompanyDB();
        }
        $query = "SELECT * FROM " . $dbName . ".competency_frm_position WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $_POST["id"]);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result;
    }

    public function getCompetencyFramework($companyId)
    {
        require '../config/dbconnect.php';

        if ($this->memberClass->isAdmin()) {
            $dbName = $this->memberClass->getCompanyDBById($companyId);
        } else {
            $dbName = $this->memberClass->getCompanyDB();
        }
        $query = "SELECT * FROM " . $dbName . ".competency_frm";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result;
    }

    public function addCompetencyFrameworkPosition($companyId, $name)
    {
        require '../config/dbconnect.php';

        if ($this->memberClass->isAdmin()) {
            $dbName = $this->memberClass->getCompanyDBById($companyId);
        } else {
            $dbName = $this->memberClass->getCompanyDB();
        }
        $stmt = $conn->prepare("INSERT INTO " . $dbName . ".competency_frm_position (name) VALUES (?)");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $id = $stmt->insert_id;
        $stmt->close();

        return $id;
    }

    public function updateCompetencyFrameworkPosition($companyId, $name)
    {
        require '../config/dbconnect.php';

        if ($this->memberClass->isAdmin()) {
            $dbName = $this->memberClass->getCompanyDBById($companyId);
        } else {
            $dbName = $this->memberClass->getCompanyDB();
        }
        $stmt = $conn->prepare("UPDATE " . $dbName . ".competency_frm_position SET name = ? WHERE id = ?");
        $stmt->bind_param("ss", $name, $_POST["id"]);
        $stmt->execute();
        $stmt->close();
    }

    public function addCompetencyFramework($companyId, $id, $value)
    {
        require '../config/dbconnect.php';

        if ($this->memberClass->isAdmin()) {
            $dbName = $this->memberClass->getCompanyDBById($companyId);
        } else {
            $dbName = $this->memberClass->getCompanyDB();
        }
        $stmt = $conn->prepare("INSERT INTO " . $dbName . ".competency_frm (competency_position_id, competency_id) VALUES (?, ?)");
        $stmt->bind_param("ss", $id, $value);
        $stmt->execute();
        $stmt->close();
    }

    public function updateCompetencyFramework($companyId, $value)
    {
        require '../config/dbconnect.php';

        if ($this->memberClass->isAdmin()) {
            $dbName = $this->memberClass->getCompanyDBById($companyId);
        } else {
            $dbName = $this->memberClass->getCompanyDB();
        }
        $stmt = $conn->prepare("UPDATE " . $dbName . ".competency_frm SET competency_id = ? WHERE competency_position_id = ?");
        $stmt->bind_param("ss", $value, $_POST["id"]);
        $stmt->execute();
        $stmt->close();
    }

    public function deleteCompetencyFramework($companyId)
    {
        require '../config/dbconnect.php';

        if ($this->memberClass->isAdmin()) {
            $dbName = $this->memberClass->getCompanyDBById($companyId);
        } else {
            $dbName = $this->memberClass->getCompanyDB();
        }
        $stmt = $conn->prepare("DELETE FROM " . $dbName . ".competency_frm_position WHERE id = ?");
        $stmt->bind_param("s", $_POST["id"]);
        $stmt->execute();
        $stmt->close();

        $stmt = $conn->prepare("DELETE FROM " . $dbName . ".competency_frm WHERE competency_position_id = ?");
        $stmt->bind_param("s", $_POST["id"]);
        $stmt->execute();
        $stmt->close();
    }
    //////////////////////////////////////Sarb///////////////////////////////////////
    // public function getQuestions($companyId, $arr_comp){
    //     require '../config/dbconnect.php';
    //     if ($this->memberClass->isAdmin()) {
    //         $dbName = $this->memberClass->getCompanyDBById($companyId);
    //     } else {
    //         $dbName = $this->memberClass->getCompanyDB();
    //     }
    //     $query = "SELECT Questions FROM `" . $dbName . "`.`question_base` WHERE sub_headings = ? ORDER BY RAND() LIMIT 3";
    //     $stmt = $conn->prepare($query);
    //     $stmt->bind_param('s', $arr_comp);
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    //     $stmt->close();

    //      // Fetch the rows from the result set and store them in an array
    //     $questions = array();
    //         while ($row = $result->fetch_assoc()) {
    //             $questions[] = $row['Questions'];
    //         }

    //     return $questions;
    // }


    // public function getsetQuestions($companyId, $arr_comp) {
    //     require '../config/dbconnect.php';
    //     if ($this->memberClass->isAdmin()) {
    //         $dbName = $this->memberClass->getCompanyDBById($companyId);
    //     } else {
    //         $dbName = $this->memberClass->getCompanyDB();
    //     }
        
    //     $query = "SELECT Questions FROM `" . $dbName . "`.`question_base` WHERE sub_headings = ? ORDER BY RAND() LIMIT 3";
    //     $stmt = $conn->prepare($query);
    //     $stmt->bind_param('s', $arr_comp);
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    //     $stmt->close();

    //     $questions = array();
    //         while ($row = $result->fetch_assoc()) {
    //             array_push($questions, $row['Questions']);
    //         }
    
    //     // Insert the questions into the database
    //     $insertQuery = "INSERT INTO `" . $dbName . "`.`competency_questions` (competency, question) VALUES (?, ?)";
    //     $stmt = $conn->prepare($insertQuery);
    //     for ($x = 0 ; $x<3 ;$x++) {
    //         $stmt->bind_param('ss', $arr_comp, $questions[$x]);
    //         $stmt->execute();
    //     }
    //     $stmt->close();
    
    //     //return $questions;
    // }

//     public function getsetQuestions($comp_arr, $focus_id)
// {
//     require '../config/dbconnect.php';

//     if ($this->memberClass->isAdmin()) {
//         $dbName = $this->memberClass->getCompanyDBById($companyId);
//     } else {
//         $dbName = $this->memberClass->getCompanyDB();
//     }

//     // Check if data for this focus_id already exists in the competency_questions table
//     $checkQuery = "SELECT id FROM competency_questions WHERE focus_id = ?";
//     $stmt = $conn->prepare($checkQuery);
//     $stmt->bind_param('i', $focus_id);
//     $stmt->execute();
//     $result = $stmt->get_result();
//     $stmt->close();

//     if ($result->num_rows > 0) {
//         // Data for this focus_id already exists, so delete the existing data before inserting the new data
//         $deleteQuery = "DELETE FROM competency_questions WHERE focus_id = ?";
//         $stmt = $conn->prepare($deleteQuery);
//         $stmt->bind_param('i', $focus_id);
//         $stmt->execute();
//         $stmt->close();
//     }

//     foreach ($comp_arr as $comp) {
//         // Get focus information from the database
//         $focusQuery = "SELECT focus_first_name, focus_last_name, start_date , end_date FROM `$dbName`.`focus` WHERE focus_id = ?";
//         $stmt = $conn->prepare($focusQuery);
//         $stmt->bind_param('i', $focus_id);
//         $stmt->execute();
//         $result = $stmt->get_result();
//         $stmt->close();

//         // Get focus information from the first row of the result set
//         $focusInfo = $result->fetch_assoc();
//         $focus_first_name = $focusInfo['focus_first_name'];
//         $focus_last_name = $focusInfo['focus_last_name'];
//         $start_date = $focusInfo['start_date'];
//         $end_date = $focusInfo['end_date'];

//         // Get questions from the database
//         $query = "SELECT Questions FROM question_base WHERE sub_headings = ? ORDER BY RAND() LIMIT 3";
//         $stmt = $conn->prepare($query);
//         $stmt->bind_param('s', $comp);
//         $stmt->execute();
//         $result = $stmt->get_result();
//         $stmt->close();

//         $questions = array();
//         while ($row = $result->fetch_assoc()) {
//             array_push($questions, $row['Questions']);
//         }
        
//         // Insert questions and focus information into the database
//         $insertQuery = "INSERT INTO competency_questions (competency, question, focus_first_name, focus_last_name, focus_id, launch_date, end_date) VALUES (?, ?, ?, ?, ?, ?, ?)";
//         $stmt = $conn->prepare($insertQuery);
//         foreach ($questions as $question) {
//             $stmt->bind_param('ssssiss', $comp, $question, $focus_first_name, $focus_last_name, $focus_id, $start_date, $end_date);
//             $stmt->execute();
//         }
//         $stmt->close();
//     }
// }

public function getQuestions($comp_arr) {
    require '../config/dbconnect.php';

    $questions = array();

    foreach ($comp_arr as $comp) {
        // Get 3 random questions for this competency from the database
        $query = "SELECT qb.Questions
        FROM question_base AS qb
        JOIN competency AS c ON qb.comp_id = c.id
        WHERE c.en_name = ?
        ORDER BY RAND() LIMIT 3";
        //$query = "SELECT Questions FROM question_base WHERE sub_headings = ? ORDER BY RAND() LIMIT 3";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $comp);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        // Add the questions to the result array
        while ($row = $result->fetch_assoc()) {
            array_push($questions, $row['Questions']);
        }
    }

    // Shuffle the questions to ensure they are in a random order
    shuffle($questions);

    return $questions;
}

public function setQuestions($questions, $focus_id) {
    require '../config/dbconnect.php';

    if ($this->memberClass->isAdmin()) {
        $dbName = $this->memberClass->getCompanyDBById($companyId);
    } else {
        $dbName = $this->memberClass->getCompanyDB();
    }

    // Check if data for this focus_id already exists in the competency_questions table
    $checkQuery = "SELECT id FROM competency_questions WHERE focus_id = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param('i', $focus_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows > 0) {
        // Data for this focus_id already exists, so delete the existing data before inserting the new data
        $deleteQuery = "DELETE FROM competency_questions WHERE focus_id = ?";
        $stmt = $conn->prepare($deleteQuery);
        $stmt->bind_param('i', $focus_id);
        $stmt->execute();
        $stmt->close();
    }

    // Get focus information from the database
    $focusQuery = "SELECT focus_first_name, focus_last_name, start_date, end_date FROM `$dbName`.`focus` WHERE focus_id = ?";
    $stmt = $conn->prepare($focusQuery);
    $stmt->bind_param('i', $focus_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    // Get focus information from the first row of the result set
    $focusInfo = $result->fetch_assoc();
    $focus_first_name = $focusInfo['focus_first_name'];
    $focus_last_name = $focusInfo['focus_last_name'];
    $start_date = $focusInfo['start_date'];
    $end_date = $focusInfo['end_date'];

    // Insert questions and focus information into the database
    $insertQuery = "INSERT INTO competency_questions (competency, question, focus_first_name, focus_last_name, focus_id, launch_date, end_date) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);
    foreach ($questions as $question) {
        // Get the competencies corresponding to this question from the question_base table
        $compQuery = "SELECT c.en_name
        FROM competency AS c
        JOIN question_base AS qb ON c.id = qb.comp_id
        WHERE qb.Questions = ?";
        $stmt2 = $conn->prepare($compQuery);
        $stmt2->bind_param('s', $question);
        $stmt2->execute();
        $result2 = $stmt2->get_result();
        $stmt2->close();

        // Insert the question and focus information into the database for each competency
        while ($row = $result2->fetch_assoc()) {
            $competency = $row['en_name'];
            $stmt->bind_param('ssssiss', $competency, $question, $focus_first_name, $focus_last_name, $focus_id, $start_date, $end_date);
            $stmt->execute();
        }
    }
    $stmt->close();
}



    /////////////////////////////////////Sarb///////////////////////////////////////
}
?>