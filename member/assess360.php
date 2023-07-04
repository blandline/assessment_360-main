<?
use Mpdf\Tag\Br;
require("../classes/CheckSession.php");
require("../classes/Session.php");
require("../classes/MemberClass.php");
require("../classes/Assess360Class.php");
require("../vendor/autoload.php");
require("../classes/listofratersClass.php");
require("../classes/QuestionsClass.php");
require("../classes/emailClass.php");
// use Spipu\Html2Pdf\Html2Pdf;

$login = new MemberClass();
$competency = new CompetencyClass($login);
$listofratersClass = new listofratersClass($login);
$questionsClass = new QuestionsClass($login);
//$emailClass = new emailClass($login);

if ($login->isLoggedIn()) {
  if ($login->isAdmin()) {
    if (isset($_POST["ac"])) {
      $companyId = $_POST["ac"];
    } else if (!empty(@$_SESSION[$session_admin_temp_compId])) {
      $companyId = $_SESSION[$session_admin_temp_compId];
    } else {
      $companyId = $login->getDefaultCompanyId();
    }
  } else {
    if (!in_array($PACKAGE_ASSESS_360, $_SESSION[$session_package]) || !$login->checkUserPermission($PERMISSION_ASSESS360_VIEW)) {
      header("HTTP/1.0 404 Not Found");
      die();
    }

    $companyId = $login->getCompanyId();
  }

  /* raters*/
  // if(isset($_POST["a"]) && $_POST["a"] == "DataCenter"){
  //   header("Location: DataCenter.php");
  // }
  if(isset($_POST["a"]) && $_POST["a"] == "activate"){
    for($i=0;$i<count($_POST["rows"]);$i++){ 
      // $to = $_POST["rows"][$i]["email"];
      // $subject = "Title";
      // $from = 'do-not-reply@performve.com';
      // $body = "Hi";
      // $headers = "From: Performve <" . $from . ">\r\n";
      // $headers .= "Reply-To: Performve <" . $from . ">\r\n";
      // $headers .= "Return-Path: Performve <" . $from . ">\r\n";
      // $headers .= "MIME-Version: 1.0\r\n";
      // $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
      // mail($to, $subject, $body, $headers, "-f " . $from);
      //$listofratersClass->sendAutomatedEmail($companyId, $i);
        //$listofratersClass->sendAutomatedEmail($companyId, $i);
      if($i == 0){
        $listofratersClass->addFocusData($companyId, $_POST["rows"][$i]["FOCUS_first_name"], $_POST["rows"][$i]["FOCUS_last_name"], $_POST["rows"][$i]["Launch-date"], $_POST["rows"][$i]["End-date"], $_POST["rows"][$i]["Roles"],$_POST["rows"][$i]["Genders"],$_POST["rows"][$i]["position"],$_POST["rows"][$i]["email"]);
      }
      $focusID = $listofratersClass->getFocusId($companyId);
      //$listofratersClass->addRaterData($companyId, $_POST["rows"][$i]["Rater-first-name"],  $_POST["rows"][$i]["Rater-last-name"], $_POST["rows[$i][Roles]"],$position = $_POST["rows[$i][Genders]"],$gender = $_POST["rows[$i][position]"],$email = $_POST["rows[$i][email]"]);
      $listofratersClass->addRaterData($companyId, $_POST["rows"][$i]["Rater-first-name"], $_POST["rows"][$i]["Rater-last-name"], $focusID, $_POST["rows"][$i]["Roles"], $_POST["rows"][$i]["Genders"], $_POST["rows"][$i]["position"], $_POST["rows"][$i]["email"]);
      //$listofratersClass-> insertFocusIdIntoRaterList($companyId);
    }
    header("Location: welcome.php");
    // Data Center
  }

  // add/edit competency framework
  if (isset($_POST["a"]) && $_POST["a"] == "addFramework") {
    if (isset($_POST["id"]) && isset($_POST["value"])) {
      $obj = json_decode($_POST["value"], true);
      $name = "";
      $value = "";
      for ($i = 0; $i < count($obj); $i++) {
        if (isset($obj[$i])) {
          $obj2 = $obj[$i];
          if ($obj2 && count($obj2) > 0) {
            // if ($i == 0) {
            //   $name = $obj2[0];
            // } else {
            for ($j = 0; $j < count($obj2); $j++) {
              if ($value != "") {
                $value .= ",";
              }
              $value .= $obj2[$j];
              //}
            }
          }
        }
      }

      $result = $competency->getCompetencyFrameworkPositionWithId($companyId);
      if ($result->num_rows == 0) {
        $id = $competency->addCompetencyFrameworkPosition($companyId, $name);
        $competency->addCompetencyFramework($companyId, $id, $value);
      } else {
        $competency->updateCompetencyFrameworkPosition($companyId, $name);
        $competency->updateCompetencyFramework($companyId, $value);
      }
    }
    die("");
  }

  // get framework
  if (isset($_POST["a"]) && $_POST["a"] == "getFramework") {
    // cluster
    $clusterArray = [];
    $result = $competency->getCompetencyCluster();
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      array_push($clusterArray, $row["id"]);
    }

    // competency
    $competencyArray = [];
    $result = $login->getCompetency();
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $competencyArray[$row["id"]] = $row["parent_id"];
    }

    // framework
    $frameworkArray = [];
    $result = $competency->getCompetencyFramework($companyId);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $frameworkArray[$row["competency_position_id"]] = $row["competency_id"];
    }

    // position
    $array = [];
    $result = $competency->getCompetencyFrameworkPosition($companyId);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $id = $row["id"];
      $name = $row["name"];

      $tmp = [];

      $tmp[8] = [$id];

      if (isset($frameworkArray[$id])) {
        $tmpArray = explode(",", $frameworkArray[$id]);
        for ($i = 0; $i < count($tmpArray); $i++) {
          $competencyId = $tmpArray[$i];
          if (isset($competencyArray[$competencyId])) {
            $clusterId = $competencyArray[$competencyId];
            $order = array_search($clusterId, $clusterArray);
            if (!isset($tmp[$order])) {
              $tmp[$order] = [];
            }
            array_push($tmp[$order], $competencyId);
          }
        }
      }
      array_push($array, $tmp);
    }
    die(json_encode($array));
  }

  // delete framework
  if (isset($_POST["a"]) && $_POST["a"] == "deleteFramework") {
    if (isset($_POST["id"])) {
      $competency->deleteCompetencyFramework($companyId);
    }
    die();
  }

  // export to pdf
  if (isset($_POST["a"]) && $_POST["a"] == "pdf") {
    // competency
    $competencyArray = [];
    $result = $login->getCompetency();
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $competencyArray[$row["id"]] = [];

      if (isset($_COOKIE['lang']) && $_COOKIE['lang'] == "tc") {
        $competencyArray[$row["id"]]["name"] = $row["tc_name"];
      } else if (isset($_COOKIE['lang']) && $_COOKIE['lang'] == "sc") {
        $competencyArray[$row["id"]]["name"] = $row["sc_name"];
      } else {
        $competencyArray[$row["id"]]["name"] = $row["en_name"];
      }

      $competencyArray[$row["id"]]["parent"] = $row["parent_id"];
    }

    // framework
    $frameworkArray = [];
    $result = $competency->getCompetencyFramework($companyId);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $frameworkArray[$row["competency_position_id"]] = $row["competency_id"];
    }

    $html = "<style>";
    $html .= ".main-table{border-collapse: collapse;border: 1px solid;}";
    $html .= ".main-table, .main-table td {border: 1px solid;padding: 10px;}";
    $html .= "</style>";
    $html .= "<div style='margin-left:20px;'><h4>" . $language["competency_framework_title"] . "</h4></div>";
    $html .= "<table class='main-table'><tr style='background-color:#d0d0d0;'><td><b>" . $language["competency_framework_position"] . "</b></td>";

    // cluster
    $clusterArray = [];
    $result = $competency->getCompetencyCluster();
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      if (isset($_COOKIE['lang']) && $_COOKIE['lang'] == "tc") {
        $html .= "<td style='text-align:center;'><b>" . $row["tc_name"] . "</b></td>";
      } else if (isset($_COOKIE['lang']) && $_COOKIE['lang'] == "sc") {
        $html .= "<td style='text-align:center;'><b>" . $row["sc_name"] . "</b></td>";
      } else {
        $html .= "<td style='text-align:center;'><b>" . $row["en_name"] . "</b></td>";
      }

      array_push($clusterArray, $row["id"]);
    }

    $html .= "</tr>";

    $result = $competency->getCompetencyFrameworkPosition($companyId);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $html .= "<tr><td style='background-color:#fce3d0;'><b>" . wordwrap($row["name"], 15, "<br>", false) . "</b></td>";

      if (isset($frameworkArray[$row["id"]])) {
        $tmpArray = explode(",", $frameworkArray[$row["id"]]);
        for ($i = 0; $i < count($clusterArray); $i++) {
          $html .= "<td style='vertical-align: top;'><table style='border-collapse: collapse;border: 0px;'>";
          for ($j = 0; $j < count($tmpArray); $j++) {
            $competencyId = $tmpArray[$j];
            if (isset($competencyArray[$competencyId])) {
              if ($competencyArray[$competencyId]["parent"] == $clusterArray[$i]) {
                $html .= "<tr><td style='vertical-align: top;border: 0px;padding:5px;'>&bull;</td><td style='border: 0px;padding:5px;'>" . wordwrap($competencyArray[$competencyId]["name"], 24, "<br>", false) . "</td></tr>";
              }
            }
          }
          $html .= "</table></td>";
        }
      }

      $html .= "</tr>";
    }

    $html .= "</table>";

    $mpdfConfig = array(
      'mode' => 'utf-8',
      'format' => 'A4-L',    // format - A4, for example, default ''
      'default_font_size' => 0,     // font size - default 0
      'default_font' => 'Helvetica',    // default font family
      'orientation' => 'P',      // L - landscape, P - portrait
      'tempDir' => '../vendor/mpdf/mpdf/tmp',
      "autoScriptToLang" => true,
      "autoLangToFont" => true,
    );

    $mpdf = new \Mpdf\Mpdf($mpdfConfig);
    $mpdf->WriteHTML($html);
    $mpdf->Output("competency.pdf", "D");
  }

  // export to excel
  if (isset($_POST["a"]) && $_POST["a"] == "excel") {
    $file = "competency.xls";

    // competency
    $competencyArray = [];
    $result = $login->getCompetency();
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $competencyArray[$row["id"]] = [];

      if (isset($_COOKIE['lang']) && $_COOKIE['lang'] == "tc") {
        $competencyArray[$row["id"]]["name"] = $row["tc_name"];
      } else if (isset($_COOKIE['lang']) && $_COOKIE['lang'] == "sc") {
        $competencyArray[$row["id"]]["name"] = $row["sc_name"];
      } else {
        $competencyArray[$row["id"]]["name"] = $row["en_name"];
      }

      $competencyArray[$row["id"]]["parent"] = $row["parent_id"];
    }

    // framework
    $frameworkArray = [];
    $result = $competency->getCompetencyFramework($companyId);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $frameworkArray[$row["competency_position_id"]] = $row["competency_id"];
    }

    header("Content-type: application/excel");
    header("Content-Disposition: attachment; filename=" . $file);

    $data = '<html xmlns:x="urn:schemas-microsoft-com:office:excel">
              <head>
                  <!--[if gte mso 9]>
                  <xml>
                      <x:ExcelWorkbook>
                          <x:ExcelWorksheets>
                              <x:ExcelWorksheet>
                                  <x:Name>Sheet 1</x:Name>
                                  <x:WorksheetOptions>
                                      <x:Print>
                                          <x:ValidPrinterInfo/>
                                      </x:Print>
                                  </x:WorksheetOptions>
                              </x:ExcelWorksheet>
                          </x:ExcelWorksheets>
                      </x:ExcelWorkbook>
                  </xml>
                  <![endif]-->
              </head><body>';

    $data .= "<style>";
    $data .= ".main-table{border-collapse: collapse;border: 1px solid;}";
    $data .= ".main-table, .main-table td {border: 1px solid;padding: 10px;}";
    $data .= "</style>";
    $data .= "<div style='margin-left:20px;'><h4>" . $language["competency_framework_title"] . "</h4></div>";
    $data .= "<table class='main-table'><tr style='background-color:#d0d0d0;'><td><b>" . $language["competency_framework_position"] . "</b></td>";

    // cluster
    $clusterArray = [];
    $result = $competency->getCompetencyCluster();
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      if (isset($_COOKIE['lang']) && $_COOKIE['lang'] == "tc") {
        $data .= "<td style='text-align:center;'><b>" . $row["tc_name"] . "</b></td>";
      } else if (isset($_COOKIE['lang']) && $_COOKIE['lang'] == "sc") {
        $data .= "<td style='text-align:center;'><b>" . $row["sc_name"] . "</b></td>";
      } else {
        $data .= "<td style='text-align:center;'><b>" . $row["en_name"] . "</b></td>";
      }

      array_push($clusterArray, $row["id"]);
    }

    $data .= "</tr>";

    $result = $competency->getCompetencyFrameworkPosition($companyId);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $data .= "<tr><td style='vertical-align: top;background-color:#fce3d0;'><b>" . $row["name"] . "</b></td>";

      if (isset($frameworkArray[$row["id"]])) {
        $tmpArray = explode(",", $frameworkArray[$row["id"]]);
        for ($i = 0; $i < count($clusterArray); $i++) {
          $data .= "<td style='vertical-align: top;'><table style='border-collapse: collapse;border: 0px;'>";
          for ($j = 0; $j < count($tmpArray); $j++) {
            $competencyId = $tmpArray[$j];
            if (isset($competencyArray[$competencyId])) {
              if ($competencyArray[$competencyId]["parent"] == $clusterArray[$i]) {
                $data .= "<tr><td style='vertical-align: top;border: 0px;padding:5px;'>&bull;</td><td style='border: 0px;padding:5px;'>" . $competencyArray[$competencyId]["name"] . "</td></tr>";
              }
            }
          }
          $data .= "</table></td>";
        }
      }

      $data .= "</tr>";
    }

    $data .= "</table>";
    $data .= '</body></html>';

    echo $data;
  }

  $competencyResult = $login->getCompetency();
  $competencyArr = array();
  while ($row = mysqli_fetch_array($competencyResult, MYSQLI_ASSOC)) {
    $competencyArr[$row["id"]]["tc_name"] = rawurlencode($row["tc_name"]);
    $competencyArr[$row["id"]]["sc_name"] = rawurlencode($row["sc_name"]);
    $competencyArr[$row["id"]]["en_name"] = rawurlencode($row["en_name"]);
    $competencyArr[$row["id"]]["tc_desp"] = rawurlencode($row["tc_desp"]);
    $competencyArr[$row["id"]]["sc_desp"] = rawurlencode($row["sc_desp"]);
    $competencyArr[$row["id"]]["en_desp"] = rawurlencode($row["en_desp"]);
    $competencyArr[$row["id"]]["parent"] = $row["parent_id"];
    $competencyArr[$row["id"]]["order_id"] = $row["order_id"];
  }
  $competencyJSON = json_encode($competencyArr);
?>
  <script>
    window["currentLang"] = '<?= $_COOKIE['lang'] ?>';
    window["competencyObj"] = JSON.parse('<?= $competencyJSON; ?>');
  </script>

  <script>
    var $_POST = <?php echo json_encode($_POST); ?>;
    var $_GET = <?php echo json_encode($_GET); ?>;
  </script>

<!----------------------------------SARBULAND------------------------------------------------>
<?
// Get the company names from the AJAX request
if (isset($_POST['comp_arr'])) {
  $comp_arr = $_POST['comp_arr'];

  $result_arr = $questionsClass->getQuestions($comp_arr);
  // Loop through the company names and call the getquestion function on each one
  $questions = array();
  foreach ($comp_arr as $comp) {
    $questionsClass->getsetQuestions($comp);
    //$questions[] = $competency->getQuestions($companyId,$comp);
  }

  // Return the questions as a JSON response
  // echo json_encode($questions);
  echo json_encode($questions);
}
?>
<!------------------------------------------------------------------------------------------->
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
  if (isset($_GET["a"]) && $_GET["a"] == "listofraters") {
    if (!isset($_SESSION[$session_page]) || $_SESSION[$session_page] != $SESSION_PAGE_LIST_OF_RATERS_RATERFORM) {
      $login->insertActionLog($ACTION_LOG_ENTER_ASSESS_360);
    }

    $_SESSION[$session_page] = $SESSION_PAGE_LIST_OF_RATERS_RATERFORM;

    include("../views/member/listofratersView.php");
  } elseif (isset($_GET["a"]) && $_GET["a"] == "assess360") {
    if (!isset($_SESSION[$session_page]) || $_SESSION[$session_page] != $SESSION_PAGE_ASSESS_360) {
      $login->insertActionLog($ACTION_LOG_ENTER_ASSESS_360);
    }

    $_SESSION[$session_page] = $SESSION_PAGE_ASSESS_360;

    include("../views/member/assess360View.php");
  } elseif (isset($_GET["a"]) && $_GET["a"] == "datacenter") {
    if (!isset($_SESSION[$session_page]) || $_SESSION[$session_page] != $SESSION_PAGE_LIST_OF_RATERS_DATA_CENTER) {
      $login->insertActionLog($ACTION_LOG_ENTER_ASSESS_360);
    }


    $_SESSION[$session_page] = $SESSION_PAGE_LIST_OF_RATERS_DATA_CENTER;


    include("../views/member/datacenterView.php");
  } elseif (isset($_GET["a"]) && $_GET["a"] == "competency") {
    if (!isset($_SESSION[$session_page]) || $_SESSION[$session_page] != $SESSION_PAGE_COMPETENCY_SELECTION) {

      $login->insertActionLog($ACTION_LOG_ENTER_ASSESS_360);
    }

    $_SESSION[$session_page] = $SESSION_PAGE_COMPETENCY_SELECTION;

    include("../views/member/competencyView.php");
  } elseif (isset($_GET["a"]) && $_GET["a"] == "focuscompetency") {
    if (!isset($_SESSION[$session_page]) || $_SESSION[$session_page] != $SESSION_PAGE_COMPETENCY_FOCUS_COMPETENCY) {
      $login->insertActionLog($ACTION_LOG_ENTER_ASSESS_360);
    }

    $_SESSION[$session_page] = $SESSION_PAGE_COMPETENCY_FOCUS_COMPETENCY;

    include("../views/member/focuscompetencyView.php"); /////// you changed this from focuscompetencyView(serb)
  } elseif (isset($_GET["a"]) && $_GET["a"] == "questionnaire") {
    if (!isset($_SESSION[$session_page]) || $_SESSION[$session_page] != $SESSION_PAGE_QUESTIONNAIRE) {
      $login->insertActionLog($ACTION_LOG_ENTER_ASSESS_360);
    }

    $_SESSION[$session_page] = $SESSION_PAGE_QUESTIONNAIRE;

    include("../views/member/questionnaireView.php");
  }
  //---------------------------------------------------------------------------------

}
else {
  $_SESSION[$session_login_page] = $_SERVER["REQUEST_URI"];
  header('Location: ../login');
}
?>
