<?
class QuestionsClass
{
    // private $memberClass;

    public function __construct()
    {
        // $this->memberClass = $memberClass;
    }
    public function getQuestions($arr_comp)
    {
        require '../config/dbconnect.php';
        // if ($this->memberClass->isAdmin()) {
        //     $dbName = $this->memberClass->getCompanyDBById($companyId);
        // } else {
        //     $dbName = $this->memberClass->getCompanyDB();
        // }
        $query = "SELECT DISTINCT Questions FROM question_base WHERE sub_headings = ? ORDER BY RAND() LIMIT 3";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $arr_comp);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        // Fetch the rows from the result set and store them in an array
        $questions = array();
        while ($row = $result->fetch_assoc()) {
            $questions[] = $row['Questions'];
        }

        return $questions;
    }

    public function getsetQuestions($arr_comp)
    {
        require '../config/dbconnect.php';

        $query = "SELECT DISTINCT Questions FROM question_base WHERE sub_headings = ? ORDER BY RAND() LIMIT 3";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $arr_comp);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        $questions = array();
        while ($row = $result->fetch_assoc()) {
            array_push($questions, $row['Questions']);
        }

        // Insert the questions into the database
        $insertQuery = "INSERT INTO competency_questions (competency, question) VALUES (?, ?)";
        $stmt = $conn->prepare($insertQuery);
        foreach ($questions as $question) {
            $stmt->bind_param('ss', $arr_comp, $question);
            $stmt->execute();
        $stmt->close();
    }
    }

    public function setQuestions($question){
        require '../config/dbconnect.php';
        $stmt = $conn->prepare("SELECT sub_headings FROM question_base WHERE Questions = ?");
        $stmt->bind_param('s', $question);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
    
        $insertQuery = "INSERT INTO competency_questions (competency, question) VALUES (?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param('ss', $result['sub_headings'], $question);
        $stmt->execute();
        $stmt->close();
    }

    public function getQuestionsForQuestionnaire()
    {
        require '../config/dbconnect.php';
        $query = "SELECT question FROM competency_questions";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        $questions = array();
        while ($row = $result->fetch_assoc()) {
            $questions[] = $row['question'];
        }

        return $questions;
    }

    public function getQuestionIdbyQuestion($question)
    {
        require '../config/dbconnect.php';
        $query = "SELECT question_id FROM question_base 
                    JOIN competency_questions ON competency_questions.question = question_base.Questions
                    WHERE competency_questions.question =?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $question);
        $stmt->execute();
        $stmt->bind_result($question_id);
        $stmt->fetch();
        $stmt->close();

        return $question_id;
    }

    public function getCompetencyIdbyQuestionId($question_id)
    {
        require '../config/dbconnect.php';
        $query = "SELECT comp_id FROM question_base WHERE question_id =?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $question_id);
        $stmt->execute();
        $stmt->bind_result($comp_id);
        $stmt->fetch();
        $stmt->close();

        return $comp_id;
    }

    public function getCompetencyForQuestionnaire()
    {
        require '../config/dbconnect.php';
        $query = "SELECT DISTINCT competency FROM competency_questions";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        $competencies = array();
        while ($row = $result->fetch_assoc()) {
            $competencies[] = $row['competency'];
        }

        return $competencies;
    }

    public function getEnDespByCompetency($competency)
    {
        require '../config/dbconnect.php';
        $query = "SELECT c.en_desp
                FROM competency c
                JOIN question_base qb ON c.id = qb.comp_id
                JOIN competency_questions cq ON qb.sub_headings = cq.competency
                WHERE cq.competency = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $competency);
        $stmt->execute();
        $stmt->bind_result($en_desp);
        $stmt->fetch();
        $stmt->close();

        return $en_desp;
    }

    public function getCompetencyForCompetencydb()
    {
        require '../config/dbconnect.php';
        $query = "SELECT DISTINCT competency FROM competency_questions WHERE focus_first_name ='Shadman' ";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        $competencies = array();
        while ($row = $result->fetch_assoc()) {
            $competencies[] = $row['competency'];
        }

        return $competencies;
    }


    public function SumCompTable()
    {
        require '../config/dbconnect.php';
        // Retrieve data from table
        $sql = "SELECT focus_first_name ,focus_last_name, launch_date, end_date, GROUP_CONCAT(DISTINCT competency SEPARATOR ', ') AS competencies FROM competency_questions GROUP BY focus_id";
        $result = $conn->query($sql);

        // Generate HTML table code
        if ($result->num_rows > 0) {
            echo "<table class='competency-frm-table table table-hover' style='width:100%;'><thead class='text-danger'><tr><th>Focus First Name</th><th>Focus Last Name</th><th>Launch Date</th><th>End Date</th><th>Competencies</th></tr></thead><tbody>";
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>".$row["focus_first_name"]."</td><td>".$row["focus_last_name"]."</td><td>".$row["launch_date"]."</td><td>".$row["end_date"]."</td><td>".$row["competencies"]."</td></tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "0 results";
        }
        

        // Close database connection
        $conn->close();
    }

    public function getCompetencyByFocusID($focus_id){
        require '../config/dbconnect.php';
        $query = "SELECT DISTINCT competency 
                    FROM competency_questions
                    WHERE competency_questions.focus_id = ?";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $focus_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $competencies = array();
        while ($row = $result->fetch_assoc()) {
            $competencies[] = $row['competency'];
        }

        $stmt->close();
        $conn->close();
        return $competencies;
    }

    public function getCompetencyIDByFocusID($focus_id){
        require '../config/dbconnect.php';
        $query = "SELECT DISTINCT question_base.comp_id 
                    FROM competency_questions 
                    JOIN question_base ON competency_questions.competency = question_base.sub_headings
                    WHERE competency_questions.focus_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $focus_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $competenciesid_arr = array();
        while ($row = $result->fetch_assoc()) {
            $competenciesid_arr[] = $row['comp_id'];
        }
    
        $stmt->close();
        $conn->close();
        return $competenciesid_arr;
    }

    public function getCompetencyIdByCompetency($competency){
        require '../config/dbconnect.php';
        $query = "SELECT id FROM competency WHERE competency.en_name = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $competency);
        $stmt->execute();
        $stmt->bind_result($competencyid);
        $stmt->fetch();
        $stmt->close();

        return $competencyid;
    }    

    public function getBoolAnswerByQuestionid($dbName, $rater_id, $question_id){
        require '../config/dbconnect.php';

        $stmt = $conn->prepare("SELECT answer FROM " . $dbName . ".questionnaire_result WHERE rater_id = ? AND question_id = ?");
        $stmt->bind_param("ss", $rater_id, $question_id);
        $stmt->execute();
        $stmt->bind_result($result);
        $stmt->fetch();
        $stmt->close();

        return ($result !== null);
    }

    public function getBoolAnswerImportanceOfCompetency($dbName, $rater_id, $competency_id, $question_type_id){
        require '../config/dbconnect.php';
    
        $stmt = $conn->prepare("SELECT answer FROM " . $dbName . ".questionnaire_result WHERE rater_id = ? AND competency_id = ? AND question_type_id = ?");
        $stmt->bind_param("iii", $rater_id, $competency_id, $question_type_id);
        $stmt->execute();
        $stmt->bind_result($result);
        $stmt->fetch();
        $stmt->close();
    
        return $result;
    }

    public function getImportanceOfCompetencyAnswer($dbName, $rater_id, $competency_id, $question_type_id){
        require '../config/dbconnect.php';
    
        $stmt = $conn->prepare("SELECT answer FROM " . $dbName . ".questionnaire_result WHERE rater_id = ? AND competency_id = ? AND question_type_id = ?");
        $stmt->bind_param("iii", $rater_id, $competency_id, $question_type_id);
        $stmt->execute();
        $stmt->bind_result($result);
        $stmt->fetch();
        $stmt->close();
    
        return $result;
    }

    public function getCompetencystatementsAnswer($dbName, $rater_id, $question_type_id, $competency_id, $question_id){
        require '../config/dbconnect.php';
    
        $stmt = $conn->prepare("SELECT answer FROM " . $dbName . ".questionnaire_result WHERE rater_id = ? AND competency_id = ? AND question_type_id = ? AND question_id =?");
        $stmt->bind_param("iiii", $rater_id, $competency_id, $question_type_id, $question_id);
        $stmt->execute();
        $stmt->bind_result($result);
        $stmt->fetch();
        $stmt->close();
    
        return $result;
    }

    public function getAnswerByQuestionid($dbName, $question_id){
        require '../config/dbconnect.php';

        $stmt = $conn->prepare("SELECT answer FROM " . $dbName . ".questionnaire_result WHERE question_id = ?");
        $stmt->bind_param("s", $question_id);
        $stmt->execute();
        $stmt->bind_result($result);
        $stmt->fetch();
        $stmt->close();

        return $result;
    }

    public function getRoleByRaterId($dbName, $rater_id){
        require '../config/dbconnect.php';
        
        $query = "SELECT roles FROM " . $dbName . ".rater_list WHERE rater_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $rater_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        
        $data = "";
        if ($row) {
            $data = $row["roles"];
        }
        return $data;
    }

    public function getFocusIdbyRaterId($dbName, $rater_id){
        require '../config/dbconnect.php';
        
        $query = "SELECT focus_id FROM " . $dbName . ".rater_list WHERE rater_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $rater_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        
        $data = "";
        if ($row) {
            $data = $row["focus_id"];
        }
        return $data;
    }

    public function getLaunchDatebyFocusId($dbName, $focus_id){
        require '../config/dbconnect.php';

        $query = "SELECT start_date FROM " . $dbName . ".focus WHERE focus_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $focus_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        $data = "";
        if ($row) {
            $data = isset($row["start_date"])?$row["start_date"]:"";
        }
        return $data;
    }

    //--------------------------QUESTIONNAIRE DATABASE--------------------------
    public function addQuestionnaireData($dbName, $rater_id, $question_type_id, $competency_id, $question_id, $answer)
    {
        require '../config/dbconnect.php';

        $stmt = $conn->prepare("INSERT INTO " . $dbName . ".questionnaire_result (rater_id, question_type_id, competency_id, question_id, answer) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iiiis", $rater_id, $question_type_id, $competency_id, $question_id, $answer);
        $stmt->execute();
        $stmt->close();
    }

    public function editQuestionnaireData($dbName, $id, $answer) {
        require '../config/dbconnect.php';
        
        $stmt = $conn->prepare("UPDATE " . $dbName . ".questionnaire_result SET answer = ? WHERE id = ?");
        $stmt->bind_param("si", $answer, $id);
        $stmt->execute();
        $stmt->close();
    }

    public function getIdByData($dbName, $rater_id, $question_type_id, $competency_id, $question_id, $answer) {
        require '../config/dbconnect.php';

        $stmt = $conn->prepare("SELECT id FROM " . $dbName . ".questionnaire_result WHERE rater_id = ? AND question_type_id = ? AND competency_id = ? AND question_id = ? AND answer = ?");
        $stmt->bind_param("iiiis", $rater_id, $question_type_id, $competency_id, $question_id, $answer);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id);
            $stmt->fetch();
        } else {
            $id = false;
        }
        $stmt->close();    
        return $id;        
    }

    public function getImportanceOfCompetencyIdByData($dbName, $rater_id, $question_type_id, $competency_id, $answer) {
        require '../config/dbconnect.php';

        $stmt = $conn->prepare("SELECT id FROM " . $dbName . ".questionnaire_result WHERE rater_id = ? AND question_type_id = ? AND competency_id = ? AND answer = ?");
        $stmt->bind_param("iiis", $rater_id, $question_type_id, $competency_id, $answer);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id);
            $stmt->fetch();
        } else {
            $id = false;
        }
        $stmt->close();    
        return $id;        
    }

    public function editQuestionnaireAnswerById($dbName, $id, $answer) {
        require '../config/dbconnect.php';
    
        $stmt = $conn->prepare("UPDATE " . $dbName . ".questionnaire_result SET answer = ? WHERE id = ?");
        $stmt->bind_param("si", $answer, $id);
        $stmt->execute();
        $stmt->close();
    }

    public function getImportanceOfCompetenciesAnswer_arr($dbName, $rater_id) {
        require '../config/dbconnect.php';
    
        $stmt = $conn->prepare("SELECT competency_id, answer FROM " . $dbName . ".questionnaire_result WHERE rater_id = ? AND question_type_id = 0");
        $stmt->bind_param("i", $rater_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        $answers = array();
        while ($row = $result->fetch_assoc()) {
            $answers[$row['competency_id']] = $row['answer'];
        }
        return $answers;
    }

    public function getCompetencyStatementsAnswer_arr($dbName, $raterId) {
        require '../config/dbconnect.php';
    
        $stmt = $conn->prepare("SELECT question_id, answer FROM " . $dbName . ".questionnaire_result WHERE rater_id = ? AND question_type_id = 1");
        $stmt->bind_param("i", $raterId);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
    
        $answers = array();
        while ($row = $result->fetch_assoc()) {
            $answers[$row['question_id']] = $row['answer'];
        }
        return $answers;
    }

    public function getOpenEndAnswer($dbName, $raterId){
        require '../config/dbconnect.php';

        $stmt = $conn->prepare("SELECT answer FROM " . $dbName . ".questionnaire_result WHERE rater_id = ? AND question_type_id = 2");
        $stmt->bind_param("i", $raterId);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $row = $result->fetch_assoc();
        if ($row === null) {
            return null;
        } else {
            return $row['answer'];
        }
    }

    public function getYesNoDiscussAnswer($dbName, $raterId){
        require '../config/dbconnect.php';

        $stmt = $conn->prepare("SELECT answer FROM " . $dbName . ".questionnaire_result WHERE rater_id = ? AND question_type_id = 3");
        $stmt->bind_param("i", $raterId);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $row = $result->fetch_assoc();
        if ($row === null) {
            return null;
        } else {
            return $row['answer'];
        }
    }

    public function getOpenEndIdByData($dbName, $rater_id, $question_type_id, $answer) {
        require '../config/dbconnect.php';

        $stmt = $conn->prepare("SELECT id FROM " . $dbName . ".questionnaire_result WHERE rater_id = ? AND question_type_id = ?  AND answer = ?");
        $stmt->bind_param("iis", $rater_id, $question_type_id, $answer);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id);
            $stmt->fetch();
        } else {
            $id = false;
        }
        $stmt->close();    
        return $id;        
    }    
    //--------------------------------------------------------------------------    
}
