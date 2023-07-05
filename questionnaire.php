<?
use Mpdf\Tag\Br;
require("classes/MemberClass.php");
require("classes/QuestionsClass.php");
require("vendor/autoload.php");
require("lang/en.php");
include_once ("classes/Encryption.php");
// use Spipu\Html2Pdf\Html2Pdf;
$login = new MemberClass();
$questionsClass = new QuestionsClass($login);

//change this to password checking
// if (isset($_GET["id"])) {
?>
  <script>
    window["currentLang"] = '<?= $_COOKIE['lang'] ?>';
    window["competencyObj"] = JSON.parse('<?= $competencyJSON; ?>');
  </script>

  <script>
    var $_POST = <?php echo json_encode($_POST); ?>;
    var $_GET = <?php echo json_encode($_GET); ?>;
  </script>

<!-- ----------------------------Questionnaire Competency Statements--------------------------- -->
<?
// Get the page number from the query string
$page = isset($_POST['page']) ? $_POST['page'] : 1;
$questions_per_page = isset($_POST['questions_per_page']) ? $_POST['questions_per_page'] : 5;
$total_questions = isset($_POST['total_questions']) ? $_POST['total_questions'] : 0;
$questions_arr = isset($_POST['questions_arr']) ? json_decode($_POST['questions_arr']) : array();

// Calculate the starting and ending index of the questions to display
$start = ($page - 1) * $questions_per_page;
$end = $start + $questions_per_page - 1;

// Check if there are any competency statements to display on the current page
if ($start < $total_questions) {
  // Build the competency statements table HTML
  $table = '<table style="border: 1px solid black; width: 100%;">
            <thead style="text-align:center; background-color: #59A5CB; color:white; font-size: 14px;">
                <tr>
                    <th style="width:80%">' . $language["questionnaire_questions"] . '</th>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>5</th>
                    <th style="margin-left:10px;">X</th>
                </tr>
            </thead>';
  $table .= '<tbody>';
  for ($i = $start; $i <= $end && $i < $total_questions; $i++) {
    $table .= '<tr style="font-size: 14px;">
                  <td style="border: 1px solid black; padding-left: 5px;">' . $questions_arr[$i] . '</td>
                  <td style="border: 1px solid black; padding-right: 15px; padding-left: 15px;"><input type="radio" name="competencystatements[' . $i . ']" value="1"></td>
                  <td style="border: 1px solid black; padding-right: 15px; padding-left: 15px;"><input type="radio" name="competencystatements[' . $i . ']" value="2"></td>
                  <td style="border: 1px solid black; padding-right: 15px; padding-left: 15px;"><input type="radio" name="competencystatements[' . $i . ']" value="3"></td>
                  <td style="border: 1px solid black; padding-right: 15px; padding-left: 15px;"><input type="radio" name="competencystatements[' . $i . ']" value="4"></td>
                  <td style="border: 1px solid black; padding-right: 15px; padding-left: 15px;"><input type="radio" name="competencystatements[' . $i . ']" value="5"></td>
                  <td style="border: 1px solid black; padding-right: 15px; padding-left: 15px; margin-left:10px;"><input type="radio" name="competencystatements[' . $i . ']" value="X"></td>
              </tr>';
  }
  $table .= '</tbody>';
  $table .= '</table>';

  // Return the competency statements table HTML
  echo $table;
}
?>
<!-- ------------------------------------------------------------------------------------------ -->
<?
//---------------------------------Questionnaire Submit---------------------------------
  $questions_arr = isset($_POST['questions_arr']) ? json_decode($_POST['questions_arr']) : array();
  $competency_arr = isset($_POST['competency_arr']) ? json_decode($_POST['competency_arr']) : array();
  $competency_id_arr = array();
  $competency_statements_id_arr = array();

  if(isset($_POST["a"]) && $_POST["a"] == "submitImportanceOfCompetencies"){
    //Importance of Competencies
    $importance_of_competencies = isset($_POST['importance_of_competencies']) ? $_POST['importance_of_competencies'] : array();
    for($i=0; $i<count($competency_arr); $i++){
      $competency_id_arr[$i] = $questionsClass->getCompetencyIdByCompetency($competency_arr[$i]);
    }
    for($i=0;$i<count($competency_arr);$i++){ 
      $rater_id = 0; //TEMP, LATER CHANGE THIS TO GETRATERIDBYPWD
      if(isset($importance_of_competencies[$i]) && !$importance_of_competencies[$i]){
        continue;
      };
      if(isset($importance_of_competencies[$i])){
        $questionsClass->addQuestionnaireData($companyId, $rater_id, $QUESTIONNAIRE_IMPORTANCE_OF_COMPETENCY, $competency_id_arr[$i], NULL, $importance_of_competencies[$i]);
      }
    }
  }
  if(isset($_POST["a"]) && $_POST["a"] == "submitCompetencyStatements"){
    //Competency Statements
    $competency_statements = isset($_POST['competency_statements']) ? $_POST['competency_statements'] : array();
    $rater_id = 0; //TEMP, LATER CHANGE THIS TO GETRATERIDBYPWD
    for($i=0;$i<count($questions_arr);$i++){ 
      $question_id_arr[$i] = $questionsClass->getQuestionIdbyQuestion($questions_arr[$i]);
      $competency_statements_id_arr[$i] = $questionsClass->getCompetencyIdbyQuestionId($question_id_arr[$i]);
      if(!isset($competency_statements[$i])){
        continue;
      };
      //if there is no answer for the question in the database yet, INSERT
      if(isset($competency_statements[$i]) && (!$questionsClass->getBoolanswerByQuestionid($question_id_arr[$i]))){
        $questionsClass->addQuestionnaireData($companyId, $rater_id, $QUESTIONNAIRE_COMPETENCY_STATEMENTS, $competency_statements_id_arr[$i], $question_id_arr[$i], $competency_statements[$i]);
      }
      //if there is already an answer for the question, EDIT
      else{
        if(isset($competency_statements[$i]) && (intval($competency_statements[$i]) != intval($questionsClass->getAnswerByQuestionid($question_id_arr[$i])))){
          $id_tobe_edited = $questionsClass->getIdByData($companyId, $rater_id, $QUESTIONNAIRE_COMPETENCY_STATEMENTS, $competency_statements_id_arr[$i], $question_id_arr[$i], $competency_statements[$i]);
          //$questionsClass->editQuestionnaireData($companyId, $id_tobe_edited, $rater_id, $QUESTIONNAIRE_COMPETENCY_STATEMENTS, $competency_statements_id_arr[$i], $question_id_arr[$i], $competency_statements[$i]);
          $questionsClass->editQuestionnaireAnswerById($companyId, $id_tobe_edited, $competency_statements[$i]);
        }
      }
    }
  }
  if(isset($_POST["a"]) && $_POST["a"] == "submitopenendquestion"){
      $rater_id = 0; //TEMP, LATER CHANGE THIS TO GETRATERIDBYPWD
      $openend_question_result = isset($_POST['openend_question_result']) ? $_POST['openend_question_result'] : NULL;
      $questionnaire_yesno_discuss = isset($_POST['questionnaire_yesno_discuss']) ? (int)$_POST['questionnaire_yesno_discuss'] : NULL;
      $questionsClass->addQuestionnaireData($companyId, $rater_id, $QUESTIONNAIRE_OPEN_END_QUESTION, NULL, NULL, $openend_question_result);
      $questionsClass->addQuestionnaireData($companyId, $rater_id, $QUESTIONNAIRE_YESNO_DISCUSS, NULL, NULL, $questionnaire_yesno_discuss);
  }
  //-------------------------------------------------------------------------------------
?>
<?
  //------------------------------------NEW----------------------------------------
  if (isset($_GET["a"]) && $_GET["a"] == "questionnaire") {
    if (!isset($_SESSION[$session_page]) || $_SESSION[$session_page] != $SESSION_PAGE_QUESTIONNAIRE) {
      $login->insertActionLog($ACTION_LOG_ENTER_ASSESS_360);
    }

    $_SESSION[$session_page] = $SESSION_PAGE_QUESTIONNAIRE;

    include("../views/member/questionnaireView.php");
  }
  //---------------------------------------------------------------------------------

// }
// else {
//   $_SESSION[$session_login_page] = $_SERVER["REQUEST_URI"];
//   header('Location: ../login');
// }
?>