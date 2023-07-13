<?
class ReportClass
{
    private $memberClass;

    public function __construct(MemberClass $memberClass)
    {
        $this->memberClass = $memberClass;
    }
    
    public function getFocusNameByFocusId($companyId, $focus_id){
        require '../config/dbconnect.php';
        if ($this->memberClass->isAdmin()) {
            $dbName = $this->memberClass->getCompanyDBById($companyId);
        } else {
            $dbName = $this->memberClass->getCompanyDB();
        }

        $query = "SELECT focus_first_name, focus_last_name FROM " . $dbName . ".focus WHERE focus_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $focus_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        $data = "";
        if ($row) {
            $data = (isset($row["focus_first_name"]) && isset($row["focus_last_name"])) ? $row["focus_first_name"] . " " . $row["focus_last_name"]:"";
        }
        return $data;
    }

    public function getReportDateByFocusId($companyId, $focus_id){
        require '../config/dbconnect.php';
        if ($this->memberClass->isAdmin()) {
            $dbName = $this->memberClass->getCompanyDBById($companyId);
        } else {
            $dbName = $this->memberClass->getCompanyDB();
        }

        $query = "SELECT end_date FROM " . $dbName . ".focus WHERE focus_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $focus_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        $data = "";
        if ($row) {
            $data = isset($row["end_date"])?$row["end_date"]:"";
        }
        return $data;
    }

    public function getCompetenciesForReportByFocusId($focus_id)
    {
        require '../config/dbconnect.php';

        $query = "SELECT DISTINCT competency FROM competency_questions where focus_id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $focus_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        $competencies = array();
        while ($row = $result->fetch_assoc()) {
            $competencies[] = $row['competency'];
        }

        $result_2d_arr = array();
        for ($i = 0; $i < count($competencies); $i++) {
            $query = "SELECT DISTINCT headings FROM question_base where sub_headings = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $competencies[$i]);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();

            while ($row = $result->fetch_assoc()) {
                $heading = $row['headings'];
                if (!isset($result_2d_arr[$heading])) {
                    $result_2d_arr[$heading] = array();
                }
            }
        }
        for ($i = 0; $i < count($competencies); $i++) {
            $query = "SELECT DISTINCT headings FROM question_base where sub_headings = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $competencies[$i]);
            $stmt->execute();
            $temp = $stmt->get_result();
            $stmt->close();

            while ($row = $temp->fetch_assoc()) {
                $heading = $row['headings'];
                if (!isset($result_2d_arr[$heading])) {
                    $result_2d_arr[$heading] = array();
                }
                $result_2d_arr[$heading][] = $competencies[$i];
            }
        }
        return $result_2d_arr;
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

    public function getRespondentsByFocusId($focus_id){
        require '../config/dbconnect.php';
        if ($this->memberClass->isAdmin()) {
            $dbName = $this->memberClass->getCompanyDBById($companyId);
        } else {
            $dbName = $this->memberClass->getCompanyDB();
        }
    
        $query = "SELECT roles FROM " . $dbName . ".rater_list WHERE focus_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $focus_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $roles = array();
        while ($row = $result->fetch_assoc()) {
            $roles[] = $row['roles'];
        }
    
        return $roles;
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

    public function getImportanceOfCompetencyAnswerByRaterId($rater_id){
        require '../config/dbconnect.php';
        if ($this->memberClass->isAdmin()) {
            $dbName = $this->memberClass->getCompanyDBById($companyId);
        } else {
            $dbName = $this->memberClass->getCompanyDB();
        }

        $query = "SELECT competency_id, answer FROM " . $dbName . ".questionnaire_result WHERE rater_id = ? AND question_type_id = 0";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $rater_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $assoc_arr = array();
        while ($row = $result->fetch_assoc()) {
            $assoc_arr[$row["competency_id"]] = $row['answer'];
        }
        return $assoc_arr;
    }

    public function getCompetencyByCompetencyId($competency_id){
        require '../config/dbconnect.php';
        $query = "SELECT competency.en_name FROM competency WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $competency_id);
        $stmt->execute();
        $stmt->bind_result($competency);
        $stmt->fetch();
        $stmt->close();

        return $competency;
    }

    public function getRaterIdArrayByFocusId($focus_id){
        require '../config/dbconnect.php';
        if ($this->memberClass->isAdmin()) {
            $dbName = $this->memberClass->getCompanyDBById($companyId);
        } else {
            $dbName = $this->memberClass->getCompanyDB();
        }

        $query = "SELECT rater_id FROM " . $dbName . ".rater_list WHERE focus_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $focus_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $rater_id_arr = array();
        while ($row = $result->fetch_assoc()) {
            $rater_id_arr[] = $row['rater_id'];
        }
        return $rater_id_arr;
    }

    public function getRoleByRaterId($rater_id){
        require '../config/dbconnect.php';
        if ($this->memberClass->isAdmin()) {
            $dbName = $this->memberClass->getCompanyDBById($companyId);
        } else {
            $dbName = $this->memberClass->getCompanyDB();
        }
    
        $query = "SELECT roles FROM " . $dbName . ".rater_list WHERE rater_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $rater_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $row = $result->fetch_assoc();
        $role = $row['roles'];
        return $role;
    }

    public function getCompetencyStatementsAnswerByRaterIdAndCompId($rater_id, $comp_id){
        require '../config/dbconnect.php';
        if ($this->memberClass->isAdmin()) {
            $dbName = $this->memberClass->getCompanyDBById($companyId);
        } else {
            $dbName = $this->memberClass->getCompanyDB();
        }

        $query = "SELECT answer FROM " . $dbName . ".questionnaire_result WHERE rater_id = ? AND competency_id = ? AND question_type_id = 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $rater_id, $comp_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $result_arr = array();
        while ($row = $result->fetch_assoc()) {
            $result_arr[] = $row['answer'];
        }
        return $result_arr;
    }
}


