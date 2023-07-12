<?

use Mpdf\Tag\IndexEntry;

include_once '../config/config.php'; ?>
<? include_once '../member/header.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assessment Report</title>
</head>
<?
    //------------------TEMP-------------------
    $focus_id = 244;
    $focus_full_name = $reportClass->getFocusNameByFocusId($companyId, $focus_id);
    $report_date = $reportClass->getReportDateByFocusId($companyId, $focus_id);
?>
<body class="report-body">
    <section id="report-cover-page" class="report-page report-page-active">
        <div class= "report-header">
            <div class= "report-header-line"></div>
        </div>
        <div class="report-cover-container">
            <div class= "report-cover-title"><?= $language["report_cover_title"] ?></div>
            <br><br>
            <div class= "report-cover-focusname"><?= $focus_full_name ?></div>
            <div class = "report-cover-date"><?= $report_date ?></div>
            <a href="#report-intro-page">Next</a>
            <a href="#report-important-of-competencies-page">TEMP</a>
        </div>
    </section>
    <section id="report-intro-page" class="report-page">
        <div class= "report-header">
            <?=$language["report_header_title"]?>
            <div class= "report-header-line"></div>
            <?= $focus_full_name ?>
        </div>
        <div class="report-pages-title"><?= $language["report_introduction_title"] ?></div>
        <br>
        <div class="report-intro-paragraph">
            <?= $language["report_introduction_paragraph1"] ?>
            <?= $language["report_introduction_paragraph2"] ?>
            <?= $language["report_introduction_paragraph3"] ?>
            <?= $language["report_introduction_paragraph4"] ?>
            <?= $language["report_introduction_paragraph5"] ?>
        </div>
        <a href="#report-cover-page">Previous</a>
        <a href="#report-competencies-page">Next</a>
    </section>
    <section id="report-competencies-page" class="report-page">
        <div class= "report-header">
            <?=$language["report_header_title"]?>
            <div class= "report-header-line"></div>
            <?= $focus_full_name ?>
        </div>
        <div class="report-pages-title"><?= $language["report_competencies_title"] ?></div>
        <br>
        <?= $language["report_competencies_paragraph"] ?>
        <br>
        <?
            $report_comp_arr = $reportClass->getCompetenciesForReportByFocusId($focus_id);
            foreach ($report_comp_arr as $heading => $competencies) {
                echo "<table id=report-competencies-table>
                        <tr><th class= 'report-competencies-table-header'>". $heading ."</th></tr>";
                for ($j = 0; $j < count($competencies); $j++) {
                    echo "<tr><td style= 'border: 1px solid black; font-size:14px;'>"
                            . "<div class='report-competencies-table-title'>" . $competencies[$j] . "</div>" 
                            . "<div class='report-competencies-table-content'>" . $reportClass->getEnDespByCompetency($competencies[$j]) . "</div>" . 
                        "</td></tr>";
                }
                echo "</table><br>";
            }
        ?>
        <a href="#report-intro-page">Previous</a>
        <a href="#report-respondent-overview-page">Next</a>
    </section>
    <section id="report-respondent-overview-page" class="report-page">
        <div class= "report-header">
            <?=$language["report_header_title"]?>
            <div class= "report-header-line"></div>
            <?= $focus_full_name ?>
        </div>
        <div class="report-pages-title"><?= $language["report_respondent_title"] ?></div>
        <br>
        <?= $language["report_respondent_paragraph1"] ?>
        <?
        $respondent_arr = $reportClass->getRespondentsByFocusId($focus_id);
        $counted_respondent_arr = array_count_values($respondent_arr);
        $max_label_length = max(
            strlen($language["report_respondent_self"]),
            strlen($language["report_respondent_managers"]),
            strlen($language["report_respondent_colleagues"]),
            strlen($language["report_respondent_directreports"]),
            strlen($language["report_respondent_others"])
        );

        echo "<span class='label' style='width:" . $max_label_length ."ch;'>" . $language["report_respondent_self"] . "</span><span class='colon'>:</span><span class='count'>" . (array_key_exists("FOCUS", $counted_respondent_arr) ? $counted_respondent_arr["FOCUS"] : "0") . "</span><br>";
        echo "<span class='label' style='width:" . $max_label_length ."ch;'>" . $language["report_respondent_managers"] . "</span><span class='colon'>:</span><span class='count'>" . (array_key_exists("Manager", $counted_respondent_arr) ? $counted_respondent_arr["Manager"] : "0") . "</span><br>";
        echo "<span class='label' style='width:" . $max_label_length ."ch;'>" . $language["report_respondent_colleagues"] . "</span><span class='colon'>:</span><span class='count'>" . (array_key_exists("Colleague", $counted_respondent_arr) ? $counted_respondent_arr["Colleague"] : "0") . "</span><br>";
        echo "<span class='label' style='width:" . $max_label_length ."ch;'>" . $language["report_respondent_directreports"] . "</span><span class='colon'>:</span><span class='count'>" . (array_key_exists("Direct report", $counted_respondent_arr) ? $counted_respondent_arr["Direct report"] : "0") . "</span><br>";
        echo "<span class='label' style='width:" . $max_label_length ."ch;'>" . $language["report_respondent_others"] . "</span><span class='colon'>:</span><span class='count'>" . (array_key_exists("Other", $counted_respondent_arr) ? $counted_respondent_arr["Other"] : "0") . "</span><br>";
        ?>
        <br>
        <?= $language["report_respondent_paragraph2"] ?>
        <a href="#report-competencies-page">Previous</a>
        <a href="#report-important-of-competencies-page">Next</a>
    </section>
    <section id="report-important-of-competencies-page" class="report-page">
        <div class= "report-header">
            <?=$language["report_header_title"]?>
            <div class= "report-header-line"></div>
            <?= $focus_full_name ?>
        </div>
        <div class="report-pages-title"><?= $language["report_importance_of_competencies_title"] ?></div>
        <br>
        <?= $language["report_importance_of_competencies_paragraph"] ?>
        <?
        $report_competency_id_arr = $reportClass->getCompetencyIDByFocusID($focus_id);
        $report_competency_arr = array();
        for($i=0; $i<count($report_competency_id_arr); $i++){
            $report_competency_arr[$i] = $reportClass->getCompetencyByCompetencyId( $report_competency_id_arr[$i]);
        }
        $rater_id_arr = $reportClass->getRaterIdArrayByFocusId($focus_id);
        $focus_answers_assoc_arr = array();
        $focus_answers_arr = array();
        $manager_answers_assoc_arr = array();
        $manager_answers_arr = array();
        $manager_count = 0;
        foreach($rater_id_arr as $rater_id){
            if($reportClass->getRoleByRaterId($rater_id) == "FOCUS"){
                $focus_answers_assoc_arr = $reportClass->getImportanceOfCompetencyAnswerByRaterId($rater_id);
                foreach($report_competency_id_arr as $comp_id){
                    $focus_answers_arr[] = $focus_answers_assoc_arr[$comp_id];
                }
            }
            else if($reportClass->getRoleByRaterId($rater_id) == "Manager"){
                $manager_count++;
                $manager_answers_assoc_arr = $reportClass->getImportanceOfCompetencyAnswerByRaterId($rater_id);
                if(count($manager_answers_arr)== 0){
                    foreach($report_competency_id_arr as $comp_id){
                        $manager_answers_arr[] = $manager_answers_assoc_arr[$comp_id];
                    }
                }
                else{
                    for($i=0; $i<count($report_competency_id_arr); $i++){
                        $manager_answers_arr[$i] += $manager_answers_assoc_arr[$report_competency_id_arr[$i]];
                    }
                }
            }
        }
        foreach ($manager_answers_arr as &$answer) {
            $answer = floatval($answer) / $manager_count;
        }
        ?>
        <div id="report-importanceofcompetencies-graph" style="width: 50%; height: 400px; margin: 0 auto;"></div>
        <a href="#report-respondent-overview-page">Previous</a>
        <a href="#report-overall-result-page">Next</a>
    </section>
    <section id="report-overall-result-page" class="report-page">
        <div class= "report-header">
            <?=$language["report_header_title"]?>
            <div class= "report-header-line"></div>
            <?= $focus_full_name ?>
        </div>
        <div class="report-pages-title"><?= $language["report_overall_result_title"] ?></div>
        <br>
        <?= $language["report_overall_result_paragraph1"] ?>
        <?= $language["report_overall_result_paragraph2"] ?>
        <?= $language["report_overall_result_paragraph3"] ?>
        <a href="#report-important-of-competencies-page">Previous</a>
        <a href="#report-ranking-statements-page">Next</a>
    </section>
    <section id="report-ranking-statements-page" class="report-page">
        <div class= "report-header">
            <?=$language["report_header_title"]?>
            <div class= "report-header-line"></div>
            <?= $focus_full_name ?>
        </div>
        <div class="report-pages-title"><?= $language["report_overall_result_title"] ?></div>
        <br>
    </section>

    <script src="../assets/js/core/jquery.min.js"></script>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap-material-design.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <script src="../assets/js/plugins/moment.min.js"></script>
    <script src="../assets/js/plugins/sweetalert2.js"></script>
    <script src="../assets/js/plugins/jquery.validate.min.js"></script>
    <script src="../assets/js/plugins/jquery.bootstrap-wizard.js"></script>
    <script src="../assets/js/plugins/bootstrap-selectpicker.js"></script>
    <script src="../assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
    <script src="../assets/js/plugins/bootstrap-datetimepicker-zh.js"></script>
    <script src="../assets/js/plugins/bootstrap-tagsinput.js"></script>
    <script src="../assets/js/plugins/jasny-bootstrap.min.js"></script>
    <script src="../assets/js/plugins/fullcalendar.min.js"></script>
    <script src="../assets/js/plugins/jquery-jvectormap.js"></script>
    <script src="../assets/js/plugins/nouislider.min.js"></script>
    <script src="../assets/js/plugins/arrive.min.js"></script>
    <script src="../assets/js/plugins/chartist.min.js"></script>
    <script src="../assets/js/plugins/bootstrap-notify.js"></script>
    <script src="../assets/js/material-dashboard.js?v=2.1.1"></script>
    <script src="../lib/dataTables/js/dataTables.min.js"></script>
    <script src="../js/lang/<?= $_COOKIE['lang'] ?>.js?v=<?= $jsVersion; ?>"></script>
    <script src="../<?= $jspath; ?>/assess360.js?v=<?= $jsVersion; ?>"></script>
    <script src="../echarts/echarts.min.js"></script>
    <script>
        var AssessmentReport = new AssessmentReport();
    </script>
    <script>
        var report_competency_arr = <? echo json_encode($report_competency_arr) ?>;
        var focus_answers_arr = <? echo json_encode($focus_answers_arr) ?>;
        var manager_answers_arr = <? echo json_encode($manager_answers_arr) ?>;
        var ImportanceOfCompetenciesGraph = new ImportanceOfCompetenciesGraph();
    </script>
</body>

</html>