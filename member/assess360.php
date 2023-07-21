<?
use Mpdf\Tag\Br;
require("../classes/CheckSession.php");
require("../classes/Session.php");
require("../classes/MemberClass.php");
require("../classes/Assess360Class.php");
require("../vendor/autoload.php");
require("../classes/listofratersClass.php");
require("../classes/QuestionsClass.php");
require("../classes/ReportClass.php");
// use Spipu\Html2Pdf\Html2Pdf;

$login = new MemberClass();
$competency = new CompetencyClass($login);
$listofratersClass = new listofratersClass($login);
$questionsClass = new QuestionsClass();
$reportClass = new ReportClass($login);
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
  if(isset($_POST["a"]) && $_POST["a"] == "activate"){
     for($i=0;$i<count($_POST["rows"]);$i++){ 
     if($i == 0){
       $listofratersClass->addFocusData($companyId, $_POST["rows"][$i]["FOCUS_first_name"], $_POST["rows"][$i]["FOCUS_last_name"], $_POST["rows"][$i]["Launch-date"], $_POST["rows"][$i]["End-date"], $_POST["rows"][$i]["Roles"],$_POST["rows"][$i]["Genders"],$_POST["rows"][$i]["department"],$_POST["rows"][$i]["position"],$_POST["rows"][$i]["email"]);
     }
       $focusID = $listofratersClass->getFocusId($companyId);
       $listofratersClass->addRaterData($companyId, $_POST["rows"][$i]["Rater-first-name"], $_POST["rows"][$i]["Rater-last-name"], $focusID, $_POST["rows"][$i]["Roles"], $_POST["rows"][$i]["Genders"],$_POST["rows"][$i]["department"], $_POST["rows"][$i]["position"], $_POST["rows"][$i]["email"]);
       $listofratersClass->generatePassword($companyId);
   }
   foreach ($_POST["rows"] as $row) {
    $listofratersClass->sendEmail($companyId, $row["email"]);
  };
  header("Location: welcome.php");
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
<?
if(isset($_POST["a"]) && $_POST["a"] == "changestaffinfobox"){
  // Retrieve the staff information based on the rater ID
  $rater_id = isset($_POST['rater_id'])?$_POST['rater_id']:"";
  $staff_info = $reportClass->getStaffInfoByRaterId($rater_id);

  // Generate HTML to display the staff information
  $staffinfo_dialogbox =  $language["report_feedback-openend_staffinfobox_name"] . $staff_info["name"] .'<br>'.
                          $language["report_feedback-openend_staffinfobox_department"] . $staff_info["department"] .'<br>'.
                          $language["report_feedback-openend_staffinfobox_position"] . $staff_info["position"] .'<br>'.
                          $language["report_feedback-openend_staffinfobox_email"]. $staff_info["email"] .'<br>';

  // Return the HTML as a response
  echo $staffinfo_dialogbox;
}
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
if (isset($_POST['comp_arr']) && isset($_POST['focusCompId'])) {
  $comp_arr = $_POST['comp_arr'];
  $focus_comp_add_id = $_POST['focusCompId'];

 
  // Loop through the company names and call the getquestion function on each one
  $questions = $competency->getQuestions($comp_arr);

  // foreach ($comp_arr as $comp) {
  //   $string = print_r($comp,true);
    
  //   //$questions[] = $competency->getQuestions($companyId,$comp);
  // }
  $competency->setQuestions($questions,$focus_comp_add_id);
  // Return the questions as a JSON response
  // echo json_encode($questions);

 
}
?>
<?
  //------------------------------------NEW----------------------------------------
  if (isset($_GET["a"]) && $_GET["a"] == "listofraters") {
    if (!isset($_SESSION[$session_page]) || $_SESSION[$session_page] != $SESSION_PAGE_LIST_OF_RATERS_RATERFORM) {
      $login->insertActionLog($ACTION_LOG_ENTER_ASSESS_360);
    }

    $_SESSION[$session_page] = $SESSION_PAGE_LIST_OF_RATERS_RATERFORM;

    include("../views/member/assess360listofratersView.php");
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


    include("../views/member/assess360datacenterView.php");
  } elseif (isset($_GET["a"]) && $_GET["a"] == "competency") {
    if (!isset($_SESSION[$session_page]) || $_SESSION[$session_page] != $SESSION_PAGE_COMPETENCY_SELECTION) {

      $login->insertActionLog($ACTION_LOG_ENTER_ASSESS_360);
    }

    $_SESSION[$session_page] = $SESSION_PAGE_COMPETENCY_SELECTION;

    include("../views/member/assess360competencybasicView.php");
  } elseif (isset($_GET["a"]) && $_GET["a"] == "focuscompetency") {
    if (!isset($_SESSION[$session_page]) || $_SESSION[$session_page] != $SESSION_PAGE_COMPETENCY_FOCUS_COMPETENCY) {
      $login->insertActionLog($ACTION_LOG_ENTER_ASSESS_360);
    }

    $_SESSION[$session_page] = $SESSION_PAGE_COMPETENCY_FOCUS_COMPETENCY;

    include("../views/member/assess360focuscompetencyView.php"); /////// you changed this from focuscompetencyView(serb)
  } elseif (isset($_GET["a"]) && $_GET["a"] == "questionnaire") {
    if (!isset($_SESSION[$session_page]) || $_SESSION[$session_page] != $SESSION_PAGE_QUESTIONNAIRE) {
      $login->insertActionLog($ACTION_LOG_ENTER_ASSESS_360);
    }

    $_SESSION[$session_page] = $SESSION_PAGE_QUESTIONNAIRE;

    include("../views/member/questionnaireView.php");
  }elseif (isset($_GET["a"]) && $_GET["a"] == "focuscompetencyselection") {
    if (!isset($_SESSION[$session_page]) || $_SESSION[$session_page] != $SESSION_PAGE_FOCUS_COMPETENCY_SELECTION) {
      $login->insertActionLog($ACTION_LOG_ENTER_ASSESS_360);  
    }

    $_SESSION[$session_page] = $SESSION_PAGE_FOCUS_COMPETENCY_SELECTION;

    include("../views/member/focuscompetencyselectionView.php");
  }elseif (isset($_GET["a"]) && $_GET["a"] == "report") {
    if (!isset($_SESSION[$session_page]) || $_SESSION[$session_page] != $SESSION_PAGE_ASSESSMENT_REPORT) {
      $login->insertActionLog($ACTION_LOG_ENTER_ASSESS_360);  
    }

    $_SESSION[$session_page] = $SESSION_PAGE_ASSESSMENT_REPORT;

    $focus_id = isset($_GET["id"])?$_GET["id"]:"";

    include("../views/member/assess360reportView.php");
  }
  //---------------------------------------------------------------------------------
}
else {
  $_SESSION[$session_login_page] = $_SERVER["REQUEST_URI"];
  header('Location: ../login');
}





?>



<!----------------------------------SARBULAND------------------------------------------------>

<!-- <?
  // // Get the company names from the AJAX request
  // if (isset($_POST['comp_arr']) && isset($_POST['focusCompId'])) {
  //   $comp_arr = $_POST['comp_arr'];
  //   $focus_comp_add_id = $_POST['focusCompId'];

  //   $result_arr = $questionsClass->getQuestions($comp_arr);
  //   // Loop through the company names and call the getquestion function on each one
  //   $questions = array();
  //   foreach ($comp_arr as $comp) {
  //     $questionsClass->getsetQuestions($comp,$focus_comp_add_id);
  //     //$questions[] = $competency->getQuestions($companyId,$comp);
  //   }
    
  //   // Return the questions as a JSON response
  //   // echo json_encode($questions);
  //   echo json_encode($questions);
  // } -->
  //-------------------------------------------------------------------------------

?>



<?
  if(isset($_POST["a"]) && $_POST["a"] == "activate");
?>
