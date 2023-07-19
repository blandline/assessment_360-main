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
    $focus_full_name = $reportClass->getFocusNameByFocusId($companyId, $focus_id);
    $report_date = $reportClass->getReportDateByFocusId($companyId, $focus_id);
?>
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
            <!-- <button class="btn btn-primary to-report-intro-page"><?=$language["report_text_next"]?></button> -->
        </div>
        <button class="btn btn-primary btn-sm to-report-intro-page"><?=$language["report_text_next"]?></button>
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
        <div style="display: flex; justify-content: space-between;">
            <button class="btn btn-primary btn-sm to-report-cover-page" style="margin-right: auto;"><?=$language["report_text_previous"]?></button>
            <button class="btn btn-primary btn-sm to-report-competencies-page" style="margin-left: auto;"><?=$language["report_text_next"]?></button>
        </div>
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
        <div style="display: flex; justify-content: space-between;">
            <button class="btn btn-primary btn-sm to-report-intro-page" style="margin-right: auto;"><?=$language["report_text_previous"]?></button>
            <button class="btn btn-primary btn-sm to-report-respondent-overview-page" style="margin-left: auto;"><?=$language["report_text_next"]?></button>
        </div>
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

        echo "<span class='report-respondent-label' style='width:" . $max_label_length ."ch;'>" . $language["report_respondent_self"] . "</span><span class='report-respondent-colon'>:</span><span class='report-respondent-count'>" . (array_key_exists("FOCUS", $counted_respondent_arr) ? $counted_respondent_arr["FOCUS"] : "0") . "</span><br>";
        echo "<span class='report-respondent-label' style='width:" . $max_label_length ."ch;'>" . $language["report_respondent_managers"] . "</span><span class='report-respondent-colon'>:</span><span class='report-respondent-count'>" . (array_key_exists("Manager", $counted_respondent_arr) ? $counted_respondent_arr["Manager"] : "0") . "</span><br>";
        echo "<span class='report-respondent-label' style='width:" . $max_label_length ."ch;'>" . $language["report_respondent_colleagues"] . "</span><span class='report-respondent-colon'>:</span><span class='report-respondent-count'>" . (array_key_exists("Colleague", $counted_respondent_arr) ? $counted_respondent_arr["Colleague"] : "0") . "</span><br>";
        echo "<span class='report-respondent-label' style='width:" . $max_label_length ."ch;'>" . $language["report_respondent_directreports"] . "</span><span class='report-respondent-colon'>:</span><span class='report-respondent-count'>" . (array_key_exists("Direct report", $counted_respondent_arr) ? $counted_respondent_arr["Direct report"] : "0") . "</span><br>";
        echo "<span class='report-respondent-label' style='width:" . $max_label_length ."ch;'>" . $language["report_respondent_others"] . "</span><span class='report-respondent-colon'>:</span><span class='report-respondent-count'>" . (array_key_exists("Other", $counted_respondent_arr) ? $counted_respondent_arr["Other"] : "0") . "</span><br>";
        ?>
        <br>
        <?= $language["report_respondent_paragraph2"] ?>
        <div style="display: flex; justify-content: space-between;">
            <button class="btn btn-primary btn-sm to-report-competencies-page" style="margin-right: auto;"><?=$language["report_text_previous"]?></button>
            <button class="btn btn-primary btn-sm to-report-important-of-competencies-page" style="margin-left: auto;"><?=$language["report_text_next"]?></button>
        </div>
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
                    if(isset($focus_answers_assoc_arr[$comp_id])){
                        $focus_answers_arr[] = $focus_answers_assoc_arr[$comp_id];
                    }
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
        <div style="display: flex; justify-content: space-between;">
            <button class="btn btn-primary btn-sm to-report-respondent-overview-page" style="margin-right: auto;"><?=$language["report_text_previous"]?></button>
            <button class="btn btn-primary btn-sm to-report-overall-result-page" style="margin-left: auto;"><?=$language["report_text_next"]?></button>
        </div>
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
        <?
        $roles_arr = array("FOCUS", "Manager", "Colleague", "Direct report", "Other");
        $seriesdata = array_fill_keys($roles_arr, 0);
        foreach($report_competency_id_arr as $comp_id) {
            $competency = $reportClass->getCompetencyByCompetencyId($comp_id);
            $competencyDef = $reportClass->getEnDespByCompetency($competency);
            $graph_id = "report_overall_result_graph_" . $comp_id;
            $seriesdata = array();
        
            $raters_by_role = array();
            foreach($rater_id_arr as $rater_id) {
                $rater_role = $reportClass->getRoleByRaterId($rater_id);
                if (!isset($raters_by_role[$rater_role])) {
                    $raters_by_role[$rater_role] = array();
                }
                $raters_by_role[$rater_role][] = $rater_id;
            }
        
            foreach($roles_arr as $role) {
                if (isset($raters_by_role[$role])) {
                    $role_ratings = array();
                    foreach ($raters_by_role[$role] as $rater_id) {
                        $comp_answer_arr = $reportClass->getCompetencyStatementsAnswerByRaterIdAndCompId($rater_id, $comp_id);
                        $answer_count = 0;
                        $final_answer = 0;
                        for ($i = 0; $i < count($comp_answer_arr); $i++) {
                            if ($comp_answer_arr[$i] != 'X') {
                                $final_answer += $comp_answer_arr[$i];
                                $answer_count++;
                            }
                        }
                        if ($final_answer != 0) {
                            $final_answer = floatval($final_answer) / $answer_count;
                            $final_answer = number_format($final_answer, 2);
                        }
                        $role_ratings[] = $final_answer;
                    }
        
                    $role_rating_avg = array_sum($role_ratings) / count($role_ratings);
                    $seriesdata[$role] = $role_rating_avg;
                }
            }
            $average_score_count = 0;
            $total_score = 0;
            foreach($roles_arr as $role) {
                if($role === "FOCUS"){
                    continue;
                }
                $average_score_count++;
                if(isset($seriesdata[$role])){
                    $total_score += $seriesdata[$role];
                }
            }
            $average_score = 0; 
            if($total_score != 0) {
                $average_score = floatval($total_score) / $average_score_count;
                $average_score = number_format($average_score, 2);
            }
            $summary_average_score_assoc_arr[$comp_id] = $average_score; //TO BE USED LATER IN SUMMARY

            //Render the table
            echo "<div class='report-overall-result-comp-title'>". $competency ."</div>".
                 "<div style='display:flex; width:100%'>".
                 "<div class='report-overall-result-comp-def'>". $competencyDef ."</div>".
                 "<div id='". $graph_id ."' style='width:60%; height: 200px'></div>".
                 "</div><br>";
            echo "<script>render_overall_result_Chart('". $graph_id ."', ". json_encode(array_values($seriesdata)) . ",". $average_score .");</script>";
        }
        ?>
        <div style="display: flex; justify-content: space-between;">
            <button class="btn btn-primary btn-sm to-report-important-of-competencies-page" style="margin-right: auto;"><?=$language["report_text_previous"]?></button>
            <button class="btn btn-primary btn-sm to-ranking-statements-page" style="margin-left: auto;"><?=$language["report_text_next"]?></button>
        </div>
    </section>
    <section id="report-ranking-statements-page" class="report-page">
        <div class= "report-header">
            <?=$language["report_header_title"]?>
            <div class= "report-header-line"></div>
            <?= $focus_full_name ?>
        </div>
        <div class="report-pages-title"><?= $language["report_statement_ranking_title"] ?></div>
        <br>
        <?= $language["report_statement_ranking_paragraph1"] ?>
        <?= $language["report_statement_ranking_paragraph2"] ?>
        <?
        $focus_score_assoc_arr = array();
        $questions_arr = $reportClass->getAllQuestionId($focus_id);
        $average_score_assoc_arr = array_fill_keys($questions_arr, 0);
        foreach($rater_id_arr as $rater_id){
            $rater_role = $reportClass->getRoleByRaterId($rater_id);
            if($rater_role == "FOCUS"){
                $focus_score_assoc_arr = $reportClass->getQuestionAnswersByRaterId($rater_id);
            }
            else{
                $temp_assoc_arr = $reportClass->getQuestionAnswersByRaterId($rater_id);
                foreach(array_keys($temp_assoc_arr) as $question_id){
                    if($temp_assoc_arr[$question_id] == "X"){
                        continue;
                    }
                    $average_score_assoc_arr[$question_id] += intval($temp_assoc_arr[$question_id]);
                }
            }
        }
        foreach(array_keys($average_score_assoc_arr) as $question_id){
            $other_than_focus_count = $reportClass->getNumberOfRatersOtherThanFocusByQuestionId($question_id);
            if($other_than_focus_count != 0){
                $average_score_assoc_arr[$question_id] = floatval($average_score_assoc_arr[$question_id]) / $other_than_focus_count;
            }
        }
        $highest_score_assoc_arr = $average_score_assoc_arr;
        arsort($highest_score_assoc_arr);
        $lowest_score_assoc_arr = $average_score_assoc_arr;
        asort($lowest_score_assoc_arr);
        //HIGHEST SCORES TABLE
        echo "<table id = 'report-overall-result-highest-table'>
                <tr>
                <th colspan=5 style='border-bottom: 1px solid black; width:100%'>". $language["report_statement_ranking_highest_scores"]. "</th>
                </tr>
                <tr>
                    <td>No.</td>
                    <td>Statement</td>
                    <td>Competency</td>
                    <td>Average Score</td>
                    <td>Focus Score</td>
                </tr>";
        for($i=0; $i<5; $i++){
            $highest_table_competency = $reportClass->getCompetencyByCompetencyId($reportClass->getCompetencyIdByQuestionId(array_keys($highest_score_assoc_arr)[$i]));
            $highest_table_avg_score = array_values($highest_score_assoc_arr)[$i];
            $highest_table_avg_score = number_format($highest_table_avg_score, 2);
            if(isset($focus_score_assoc_arr[array_keys($highest_score_assoc_arr)[$i]])){
                $highest_table_focus_score = $focus_score_assoc_arr[array_keys($highest_score_assoc_arr)[$i]];
            }
            $highest_table_question_statement = $reportClass->getQuestionByRaterId(array_keys($highest_score_assoc_arr)[$i]);
            echo "<tr>
                    <td>". $i + 1 ."</td>
                    <td style='text-align:left;'>". $highest_table_question_statement ."</td>
                    <td style='text-align:left;'>". $highest_table_competency ."</td>
                    <td>". $highest_table_avg_score ."</td>
                    <td>". (isset($highest_table_focus_score)?$highest_table_focus_score:"") ."</td>
                </tr>";
        }
        echo "</table>";
        echo "<br>";
        //LOWEST SCORES TABLE
        echo "<table id = 'report-overall-result-lowest-table'>
                <tr>
                <th colspan=5 style='border-bottom: 1px solid black; width:100%'>". $language["report_statement_ranking_lowest_scores"]. "</th>
                </tr>
                <tr>
                    <td>No.</td>
                    <td>Statement</td>
                    <td>Competency</td>
                    <td>Average Score</td>
                    <td>Focus Score</td>
                </tr>";
        for($i=0; $i<5; $i++){
            $lowest_table_competency = $reportClass->getCompetencyByCompetencyId($reportClass->getCompetencyIdByQuestionId(array_keys($lowest_score_assoc_arr)[$i]));
            $lowest_table_avg_score = array_values($lowest_score_assoc_arr)[$i];
            $lowest_table_avg_score = number_format($lowest_table_avg_score, 2);
            if(isset($focus_score_assoc_arr[array_keys($lowest_score_assoc_arr)[$i]])){
                $lowest_table_focus_score = $focus_score_assoc_arr[array_keys($lowest_score_assoc_arr)[$i]];
            }
            $lowest_table_question_statement = $reportClass->getQuestionByRaterId(array_keys($lowest_score_assoc_arr)[$i]);
            echo "<tr>
                    <td>". $i + 1 ."</td>
                    <td style='text-align:left;'>". $lowest_table_question_statement ."</td>
                    <td style='text-align:left;'>". $lowest_table_competency ."</td>
                    <td>". $lowest_table_avg_score ."</td>
                    <td>". (isset($lowest_table_focus_score)?$lowest_table_focus_score:"") ."</td>
                </tr>";
        }
        echo "</table>";
        ?>
        <div style="display: flex; justify-content: space-between;">
            <button class="btn btn-primary btn-sm to-report-overall-result-page" style="margin-right: auto;"><?=$language["report_text_previous"]?></button>
            <button class="btn btn-primary btn-sm to-report-summary-page" style="margin-left: auto;"><?=$language["report_text_next"]?></button>
        </div>
    </section>
    <section id="report-summary-page" class="report-page">
        <div class= "report-header">
            <?=$language["report_header_title"]?>
            <div class= "report-header-line"></div>
            <?= $focus_full_name ?>
        </div>
        <div class="report-pages-title"><?= $language["report_summary_title"] ?></div>
        <br>
        <?= $language["report_summary_paragraph1"] ?>
        <?= $language["report_summary_paragraph2"] ?>
        <?
        // print_r($summary_average_score_assoc_arr); echo "<br>";
        $degree_of_importance_arr = array_fill_keys($report_competency_id_arr, 0);
        for ($i = 0; $i < count($report_competency_id_arr); $i++) {
            if(isset($degree_of_importance_arr[$report_competency_id_arr[$i]], $focus_answers_arr[$i], $manager_answers_arr[$i])){
                $degree_of_importance_arr[$report_competency_id_arr[$i]] = (float) $focus_answers_arr[$i] + $manager_answers_arr[$i];
            }
        }
        // print_r($degree_of_importance_arr);

        $unused_strength_arr = array();
        $competent_high_arr = array();
        $strength_arr = array();
        $opportunity_arr = array();
        $competent_average_arr = array();
        $development_need_average_arr = array();
        $latent_need_arr = array();
        $development_need_low = array();
        $critical_need_arr = array();

        foreach($report_competency_id_arr as $comp_id){
            $temp_score = floatval($summary_average_score_assoc_arr[$comp_id]);
            $temp_importance_score = $degree_of_importance_arr[$comp_id];
            if($temp_score >= 3.6 &&  $temp_importance_score < 5){
                $unused_strength_arr[] = $comp_id;
            }
            else if($temp_score >= 3.6 &&  $temp_importance_score >= 5 && $temp_importance_score < 7){
                $competent_high_arr[] = $comp_id;
            }
            else if($temp_score >= 3.6 && $temp_importance_score >= 7){
                $strength_arr[] = $comp_id;
            }
            else if($temp_score > 2.9 && $temp_score < 3.6 && $temp_importance_score < 5){
                $opportunity_arr[] = $comp_id;
            }
            else if($temp_score > 2.9 && $temp_score < 3.6 && $temp_importance_score >= 5 && $temp_importance_score < 7){
                $competent_average_arr[] = $comp_id;
            }
            else if($temp_score > 2.9 && $temp_score < 3.6 && $temp_importance_score >= 7){
                $development_need_average_arr[] = $comp_id;
            }
            else if($temp_score <= 2.9 && $temp_importance_score < 5){
                $latent_need_arr[] = $comp_id;
            }
            else if($temp_score <= 2.9 && $temp_importance_score >= 5 && $temp_importance_score < 7){
                $development_need_low[] = $comp_id;
            }
            else if($temp_score <= 2.9 && $temp_importance_score < 5){
                $critical_need_arr[] = $comp_id;
            }
        }
        echo "<table id='report-summary-table'>
                <tr>
                    <th rowspan= 3>". $language["report_table_scores"] ."</th>
                    <td style='font-weight:bold;'>". $language["report_table_high"] ."</td>
                    <td>" . $language["report_table_unused_strength"];
                    foreach($unused_strength_arr as $comp_id){
                        echo "<div class='report_summary_table_answer'>" . $reportClass->getCompetencyByCompetencyId($comp_id) . "</div>";
                    }
        echo        "</td>
                    <td>". $language["report_table_competent"];
                    foreach($competent_high_arr as $comp_id){
                        echo "<div class='report_summary_table_answer'>" . $reportClass->getCompetencyByCompetencyId($comp_id) . "</div>";
                    }
        echo        "</td>
                    <td>". $language["report_table_strength"];
                    foreach($strength_arr as $comp_id){
                        echo "<div class='report_summary_table_answer'>" . $reportClass->getCompetencyByCompetencyId($comp_id) . "</div>";
                    }
        echo        "</td>
                </tr>
                <tr>
                    <td style='font-weight:bold;'>". $language["report_table_average"] ."</td>
                    <td>". $language["report_table_opportunity"];
                    foreach($opportunity_arr as $comp_id){
                        echo "<div class='report_summary_table_answer'>" . $reportClass->getCompetencyByCompetencyId($comp_id) . "</div>";
                    }
        echo        "</td>
                    <td>". $language["report_table_competent"];
                    foreach($competent_average_arr as $comp_id){
                        echo "<div class='report_summary_table_answer'>" . $reportClass->getCompetencyByCompetencyId($comp_id) . "</div>";
                    }
        echo        "</td>
                    <td>". $language["report_table_development_need"];
                    foreach($development_need_average_arr as $comp_id){
                        echo "<div class='report_summary_table_answer'>" . $reportClass->getCompetencyByCompetencyId($comp_id) . "</div>";
                    }
        echo        "</td>
                </tr>
                <tr>
                    <td style='font-weight:bold;'>". $language["report_table_low"] ."</td>
                    <td>". $language["report_table_latent_need"];
                    foreach($latent_need_arr as $comp_id){
                        echo "<div class='report_summary_table_answer'>" . $reportClass->getCompetencyByCompetencyId($comp_id) . "</div>";
                    }
        echo        "</td>
                    <td>". $language["report_table_development_need"];
                    foreach($development_need_low as $comp_id){
                        echo "<div class='report_summary_table_answer'>" . $reportClass->getCompetencyByCompetencyId($comp_id) . "</div>";
                    }
        echo        "</td>
                    <td>". $language["report_table_critical_need"];
                    foreach($critical_need_arr as $comp_id){
                        echo "<div class='report_summary_table_answer'>" . $reportClass->getCompetencyByCompetencyId($comp_id) . "</div>";
                    }
        echo        "</td>
                </tr>
                <tr>
                    <td colspan=2; type='hidden'></td>
                    <td style='font-weight:bold;'>". $language["report_table_low_importance"] ."</td>
                    <td style='font-weight:bold;'>". $language["report_table_important"] ."</td>
                    <td style='font-weight:bold;'>". $language["report_table_very_important"] ."</td>
                </tr>
                <tr>
                    <td colspan= 2; type='hidden'></td>
                    <th colspan= 3; rowspan=2>". $language["report_table_degree_of_importance"] ."</</td>
                </tr>
            </table>";
        ?>
        <div style="display: flex; justify-content: space-between;">
            <button class="btn btn-primary btn-sm to-ranking-statements-page" style="margin-right: auto;"><?=$language["report_text_previous"]?></button>
            <button class="btn btn-primary btn-sm to-feedback-openend-page" style="margin-left: auto;"><?=$language["report_text_next"]?></button>
        </div>
    </section>
    <section id="report-feedback-openend-page" class="report-page">
        <!-- DIALOG BOX -->
        <div class="modal fade" id="staffinfobox" tabindex="-1" role="dialog" aria-labelledby="addEditModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="staffinfoboxlabel"><?= $language["report_feedback-openend_staffinfobox_label"]; ?></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= $language["report_feedback-openend_staffinfobox_number"]; ?><br>
                    <?= $language["report_feedback-openend_staffinfobox_name"]; ?><br>
                    <?= $language["report_feedback-openend_staffinfobox_department"]; ?><br>
                    <?= $language["report_feedback-openend_staffinfobox_email"]; ?><br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal"><?= $language["company_cancel"]; ?></button>
                </div>
                </div>
            </div>
        </div>
        <!-- ----------- -->
        <div class= "report-header">
            <?=$language["report_header_title"]?>
            <div class= "report-header-line"></div>
            <?= $focus_full_name ?>
        </div>
        <div class="report-pages-title"><?= $language["report_feedback-openend_title"] ?></div>
        <br>
        <?
        echo "<table id='report-feedback-openend-table'>
                <tr>
                    <th>No.</th>
                    <th>Additional Feedback</th>
                    <th>Need to discuss</th>
                    <th>Staff info</th>
                </tr>";
        $temp_index = 1;
        for($i=0; $i<count($rater_id_arr); $i++){
            $open_end_answers = $reportClass->getOpenEndAnswerByRaterId($rater_id_arr[$i]);
            $yes_no_discuss = $reportClass->getYesNoDiscussByRaterId($rater_id_arr[$i]);
            if(isset($open_end_answers)){
                echo "<tr>
                        <td style='text-align:center;'>". $temp_index ."</td>
                        <td>". $open_end_answers ."</td>
                        <td style='text-align:center;'>". ($yes_no_discuss ? "✓" : "✗") ."</td>";
                        $report_staff_name = $reportClass->getStaffNameByRaterId($rater_id_arr[$i]);
                echo    "<td style='text-align:center;'>". ($yes_no_discuss ? '<button id="report-staffinfo['. $rater_id_arr[$i] .']" class ="btn btn-primary report-staffinfo" data-toggle="modal" data-target="#staffinfobox" style="padding:0;"><i class="material-icons">perm_identity</i></button>' : "") ."</td>
                    </tr>";
                $temp_index++;
            }
         }
        echo "</table>";
        ?>
        <button class="btn btn-primary btn-sm to-report-summary-page" style="margin-right: auto;"><?=$language["report_text_previous"]?></button>
    </section>
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