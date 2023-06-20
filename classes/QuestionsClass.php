<?
class QuestionsClass
{
    private $memberClass;

    public function __construct(MemberClass $memberClass)
    {
        $this->memberClass = $memberClass;
    }
    public function getQuestions($arr_comp){
            require '../config/dbconnect.php';
            // if ($this->memberClass->isAdmin()) {
            //     $dbName = $this->memberClass->getCompanyDBById($companyId);
            // } else {
            //     $dbName = $this->memberClass->getCompanyDB();
            // }
            $query = "SELECT Questions FROM question_base WHERE sub_headings = ? ORDER BY RAND() LIMIT 3";
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

        public function getsetQuestions($arr_comp) {
            require '../config/dbconnect.php';
            // if ($this->memberClass->isAdmin()) {
            //     $dbName = $this->memberClass->getCompanyDBById($companyId);
            // } else {
            //     $dbName = $this->memberClass->getCompanyDB();
            // }
            
            $query = "SELECT Questions FROM question_base WHERE sub_headings = ? ORDER BY RAND() LIMIT 3";
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
            for ($x = 0 ; $x<3 ;$x++) {
                $stmt->bind_param('ss', $arr_comp, $questions[$x]);
                $stmt->execute();
            }
            $stmt->close();
    
        }

        public function getQuestionsForQuestionnaire()
        {
            require '../config/dbconnect.php';
            $query = "SELECT question FROM competency_questions ORDER BY RAND()";
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

}