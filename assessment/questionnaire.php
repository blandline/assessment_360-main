<?
use Mpdf\Tag\Br;
require("../classes/MemberClass.php");
require("../classes/QuestionsClass.php");
require("../vendor/autoload.php");
require("../lang/en.php");
require("../classes/Constant.php");
require("../classes/Encryption.php");
// use Spipu\Html2Pdf\Html2Pdf;
$questionsClass = new QuestionsClass();

//change this to password checking
if (isset($_GET["id"]) && isset($_GET["password"])) {
  $rater_id = $_GET["id"];
  $password = $_GET["password"];
  $decryptedpassword = Mcrpty::_decrypt($_GET["password"]);
  $dbName = substr($decryptedpassword, 4, -4);
  
  $role = $questionsClass->getRoleByRaterId($dbName, $rater_id);
  $focus_id = $questionsClass->getFocusIdbyRaterId($dbName, $rater_id);
  $launch_date = $questionsClass->getLaunchDatebyFocusId($dbName, $focus_id);
  $current_date = date('Y-m-d');

  $focus_full_name = $questionsClass->getFocusNameByFocusId($dbName, $focus_id);
?>
  <script>
    window["currentLang"] = '<?= $_COOKIE['lang'] ?>';

  </script>

  <script>
    var $_POST = <?php echo json_encode($_POST); ?>;
    var $_GET = <?php echo json_encode($_GET); ?>;
  </script>

<!-- ----------------------------Questionnaire Competency Statements--------------------------- -->
<?
if(isset($_POST["a"]) && $_POST["a"] == "changePage"){
  // Get the page number from the query string
  $page = isset($_POST['page']) ? $_POST['page'] : 1;
  $questions_per_page = isset($_POST['questions_per_page']) ? $_POST['questions_per_page'] : 5;
  $total_questions = isset($_POST['total_questions']) ? $_POST['total_questions'] : 0;
  $questions_arr = isset($_POST['questions_arr']) ? json_decode($_POST['questions_arr']) : array();

  // Calculate the starting and ending index of the questions to display
  $start = ($page - 1) * $questions_per_page;
  $end = $start + $questions_per_page - 1;

  for($i=0; $i<count($questions_arr); $i++){
    $question_id_arr[$i] = $questionsClass->getQuestionIdbyQuestion($questions_arr[$i]);
  }
  $competencystatements_assocarr = $questionsClass->getCompetencyStatementsAnswer_arr($dbName, $rater_id);
  $competencystatements_previousanswers = array();
  if(isset($competencystatements_assocarr)){
    for($i=0; $i<count($questions_arr); $i++){
        $competencystatements_previousanswers[$i] = isset($competencystatements_assocarr[$question_id_arr[$i]]) ? $competencystatements_assocarr[$question_id_arr[$i]] : "";
    }
  }
  // Check if there are any competency statements to display on the current page
  if ($start < $total_questions) {
    // Build the competency statements table HTML
    $table = '<table id="competency-statements-table" style="border: 1px solid black; width: 100%;">
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
      $table .=
      "<tr style='font-size: 14px;'>
          <td style='border: 1px solid black; padding-left: 5px;'>{$questions_arr[$i]}</td>
          <td style='border: 1px solid black; padding-right: 15px; padding-left: 15px;'><input type='radio' name='competencystatements[{$i}]' value='1'" . (isset($competencystatements_previousanswers[$i]) && $competencystatements_previousanswers[$i] == 1 ? ' checked' : '') . "></td>
          <td style='border: 1px solid black; padding-right: 15px; padding-left: 15px;'><input type='radio' name='competencystatements[{$i}]' value='2'" . (isset($competencystatements_previousanswers[$i]) && $competencystatements_previousanswers[$i] == 2 ? ' checked' : '') . "></td>
          <td style='border: 1px solid black; padding-right: 15px; padding-left: 15px;'><input type='radio' name='competencystatements[{$i}]' value='3'" . (isset($competencystatements_previousanswers[$i]) && $competencystatements_previousanswers[$i] == 3 ? ' checked' : '') . "></td>
          <td style='border: 1px solid black; padding-right: 15px; padding-left: 15px;'><input type='radio' name='competencystatements[{$i}]' value='4'" . (isset($competencystatements_previousanswers[$i]) && $competencystatements_previousanswers[$i] == 4 ? ' checked' : '') . "></td>
          <td style='border: 1px solid black; padding-right: 15px; padding-left: 15px;'><input type='radio' name='competencystatements[{$i}]' value='5'" . (isset($competencystatements_previousanswers[$i]) && $competencystatements_previousanswers[$i] == 5 ? ' checked' : '') . "></td>
          <td style='border: 1px solid black; padding-right: 15px; padding-left: 15px; margin-left:10px;'><input type='radio' name='competencystatements[{$i}]' value='X'" . (isset($competencystatements_previousanswers[$i]) && $competencystatements_previousanswers[$i] == 'X' ? ' checked' : '') . "></td>
      </tr>";
    }
    $table .= '</tbody>';
    $table .= '</table>';

    // Return the competency statements table HTML
    echo $table;
  }
}
?>
<!-- ------------------------------------------------------------------------------------------ -->
<?
//---------------------------------Questionnaire Submit---------------------------------
  if(isset($_POST["a"]) && $_POST["a"] == "submitImportanceOfCompetencies"){
    //Importance of Competencies
    $competency_arr = isset($_POST['competency_arr']) ? json_decode($_POST['competency_arr']) : array();
    $importance_of_competencies = isset($_POST['importance_of_competencies']) ? $_POST['importance_of_competencies'] : array();
    $competency_id_arr = array();
    for($i=0;$i<count($competency_arr);$i++){ 
      $competency_id_arr[$i] = $questionsClass->getCompetencyIdByCompetency($competency_arr[$i]);
      //if there is no answer for the question in the database yet, INSERT
      if(isset($importance_of_competencies[$i]) && (!$questionsClass->getBoolAnswerImportanceOfCompetency($dbName, $rater_id, $competency_id_arr[$i], $QUESTIONNAIRE_IMPORTANCE_OF_COMPETENCY))){
        if(isset($importance_of_competencies[$i]) && $importance_of_competencies[$i] != ""){
          $questionsClass->addQuestionnaireData($dbName, $rater_id, $QUESTIONNAIRE_IMPORTANCE_OF_COMPETENCY, $competency_id_arr[$i], NULL, $importance_of_competencies[$i]);
        }
        else{
          $questionsClass->addQuestionnaireData($dbName, $rater_id, $QUESTIONNAIRE_IMPORTANCE_OF_COMPETENCY, $competency_id_arr[$i], NULL, NULL);
        }
      }
      //if there is already an answer for the question, EDIT
      else{
        // $temp_id = 315;
        $prev_importanceofcompetencies_answer = $questionsClass->getImportanceOfCompetencyAnswer($dbName, $rater_id, $competency_id_arr[$i], $QUESTIONNAIRE_IMPORTANCE_OF_COMPETENCY);
        if(isset($importance_of_competencies[$i]) && ($importance_of_competencies[$i] != $prev_importanceofcompetencies_answer)){
          $questionsClass->editQuestionnaireData($dbName, $questionsClass->getImportanceOfCompetencyIdByData($dbName, $rater_id, $QUESTIONNAIRE_IMPORTANCE_OF_COMPETENCY, $competency_id_arr[$i], $prev_importanceofcompetencies_answer),  $importance_of_competencies[$i]);
        }
      }
    }
  }
  if(isset($_POST["a"]) && $_POST["a"] == "submitCompetencyStatements"){
    //Competency Statements
    $competency_statements = isset($_POST['competency_statements']) ? $_POST['competency_statements'] : array();
    $questions_arr = isset($_POST['questions_arr']) ? json_decode($_POST['questions_arr']) : array();
    $competency_statements_id_arr = array();
    for($i=0;$i<count($questions_arr);$i++){ 
      $question_id_arr[$i] = $questionsClass->getQuestionIdbyQuestion($questions_arr[$i]);
      $competency_statements_id_arr[$i] = $questionsClass->getCompetencyIdbyQuestionId($question_id_arr[$i]);
      if(!isset($competency_statements[$i])){
        continue;
      };
      //if there is no answer for the question in the database yet, INSERT
      if(isset($competency_statements[$i]) && (!$questionsClass->getBoolanswerByQuestionid($dbName, $rater_id, $question_id_arr[$i]))){
        if(isset($competency_statements[$i]) && $competency_statements[$i] != ""){
          $questionsClass->addQuestionnaireData($dbName, $rater_id, $QUESTIONNAIRE_COMPETENCY_STATEMENTS, $competency_statements_id_arr[$i], $question_id_arr[$i], $competency_statements[$i]);
        }
        else{
          $questionsClass->addQuestionnaireData($dbName, $rater_id, $QUESTIONNAIRE_COMPETENCY_STATEMENTS, $competency_statements_id_arr[$i], $question_id_arr[$i], NULL);
        }
      }
      //if there is already an answer for the question, EDIT
      else{
        $prev_competencystatements_answer = $questionsClass->getCompetencystatementsAnswer($dbName, $rater_id, $QUESTIONNAIRE_COMPETENCY_STATEMENTS, $competency_statements_id_arr[$i],  $question_id_arr[$i]);
        if(isset($competency_statements[$i]) && ($competency_statements[$i] != $prev_competencystatements_answer)){
          $id_tobe_edited = $questionsClass->getIdByData($dbName, $rater_id, $QUESTIONNAIRE_COMPETENCY_STATEMENTS, $competency_statements_id_arr[$i], $question_id_arr[$i], $prev_competencystatements_answer);
          $questionsClass->editQuestionnaireAnswerById($dbName, $id_tobe_edited, $competency_statements[$i]);
        }
      }
    }
  }
  if(isset($_POST["a"]) && $_POST["a"] == "submitopenendquestion"){
      $openend_question_result = isset($_POST['openend_question_result']) ? $_POST['openend_question_result'] : NULL;
      $questionnaire_yesno_discuss = isset($_POST['questionnaire_yesno_discuss']) ? $_POST['questionnaire_yesno_discuss'] : NULL;
      $prev_openend_answer = ($questionsClass->getOpenEndAnswer($dbName, $rater_id))? $questionsClass->getOpenEndAnswer($dbName, $rater_id) : "";
      if($openend_question_result != NULL){
        if(!$prev_openend_answer){
          $questionsClass->addQuestionnaireData($dbName, $rater_id, $QUESTIONNAIRE_OPEN_END_QUESTION, NULL, NULL, $openend_question_result);
        }
        else{
          if(($prev_openend_answer)&& ($prev_openend_answer != $openend_question_result)){
            $id_tobe_edited = $questionsClass->getOpenEndIdByData($dbName, $rater_id, $QUESTIONNAIRE_OPEN_END_QUESTION, $prev_openend_answer);
            $questionsClass->editQuestionnaireData($dbName, $id_tobe_edited, $openend_question_result);
          }
        }
      }
      $prev_yesno_discuss = $questionsClass->getYesNoDiscussAnswer($dbName, $rater_id)? $questionsClass->getYesNoDiscussAnswer($dbName, $rater_id): "";
      if($questionnaire_yesno_discuss != NULL){
        if(!$prev_yesno_discuss){
          $questionsClass->addQuestionnaireData($dbName, $rater_id, $QUESTIONNAIRE_YESNO_DISCUSS, NULL, NULL, $questionnaire_yesno_discuss);
        }
        else{
          if(($prev_yesno_discuss)&& ($prev_yesno_discuss != $questionnaire_yesno_discuss)){
            $id_tobe_edited = $questionsClass->getOpenEndIdByData($dbName, $rater_id, $QUESTIONNAIRE_YESNO_DISCUSS, $prev_yesno_discuss);
            $questionsClass->editQuestionnaireData($dbName, $id_tobe_edited, $questionnaire_yesno_discuss);
          }
        }
      }
  }
  //-------------------------------------------------------------------------------------
?>
<?
  include("../views/member/assess360questionnaireView.php");
}
else {
  $_SESSION[$session_login_page] = $_SERVER["REQUEST_URI"];
  header('Location: ../login');
}
?>
