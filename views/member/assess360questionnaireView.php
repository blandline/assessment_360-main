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
    <title>Questionnaire</title>
</head>





<?
//TEMP
$role_arr = ["focus", "manager", "colleague", "direct report", "others"];
$role = $role_arr[3];
$rater_id = 0; //getrateridbypwd
?>

<body class="questionnaire-body">
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel"><?= $language["competency_framework_warning"]; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= $language["questionnaire_areyousure_confirm"]; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $language["questionnaire_areyousure_no"]; ?></button>
                    <button type="button" class="btn btn-primary confirm-yes" data-dismiss="modal"><?= $language["questionnaire_areyousure_yes"]; ?></button>
                </div>
            </div>
        </div>
    </div>
    <form method="post" id="questionnaire_form" action="assess360">
        <section id="intro-page" class="questionnaire-page questionnaire-page-active">
            <div class="questionnaire-header"><?= $language["questionnaire_header_title"] ?></div>
            <br>
            <div class="questionnaire-paragraph-title"><?= $language["questionnaire_intropage_introduction"] ?></div><br>
            <div>
                <?= $language["questionnaire_intropage_introduction_paragraph1"] ?>
                <?= $language["questionnaire_intropage_introduction_paragraph2"] ?>
            </div>

            <div class="questionnaire-paragraph-title"><?= $language["questionnaire_intropage_instruction"] ?></div><br>
            <div>
                <?= $language["questionnaire_intropage_instruction_paragraph1"] ?>
                <?= $language["questionnaire_intropage_instruction_paragraph2"] ?>
                <?= $language["questionnaire_intropage_instruction_paragraph3"] ?>
                <?= $language["questionnaire_intropage_instruction_paragraph4"] ?>
                <?= $language["questionnaire_intropage_instruction_paragraph5"] ?>
                <?= $language["questionnaire_intropage_instruction_paragraph6"] ?>
                <?
                if ($role == "manager" or $role == "focus") {
                    echo '<a href="#importance-of-competency-page">', $language["questionnaire_intropage_instruction_paragraph7"], '</a>';
                } elseif ($role != "manager" and $role != "focus") {
                    echo '<a href="#competency-statements-page">', $language["questionnaire_intropage_instruction_paragraph7"], '</a>';
                }
                ?>
                <?= $language["questionnaire_intropage_instruction_paragraph8"] ?>
            </div>
        </section>
        <section id="importance-of-competency-page" class="questionnaire-page">
            <div class="questionnaire-header"><?= $language["questionnaire_header_title"] ?></div>
            <br>
            <?= $language["questionnaire_importanceofcompetency_title"] ?>
            <br>
            <br>
            <?= $language["questionnaire_importanceofcompetency_paragraph1"] ?>
            <div style='width: 100%; display: flex; justify-content: space-between;'>
                <div style="width: 80%"></div>
                <div style="width: 20%; display:inline-block;">
                    <div style="margin-left: 10px; text-align: center;"><?= $language["questionnaire_importanceofcompetency_importance"] ?></div>
                    <div style="display:flex;">
                        <div style="justify-content: flex-start; text-align:left; flex:1; margin-left:10px;"><?= $language["questionnaire_importanceofcompetency_low"] ?></div>
                        <div style="justify-content: flex-end; text-align:right; flex:1;"><?= $language["questionnaire_importanceofcompetency_high"] ?></div>
                    </div>
                    <div style="margin-left: 10px; text-align: center;"><?= $language["questionnaire_importanceofcompetency_doubleheaded_arrow"] ?></div>
                </div>
            </div>
            <!-- TODO list of competencies -->
            <?
            //CHANGE LATER TO GET FOCUSID BY PWD
            $focus_id = 0;
            $competency_arr = $questionsClass->getCompetencyByFocusID($focus_id);
            //$competency_id_arr = $questionsClass->getCompetencyIDByFocusID($focus_id);
            // $temp_title = $questionsClass->getCompetencyForQuestionnaire();
            $competency_def_arr = array();
            $competency_id_arr = array();
            for ($i = 0; $i < count($competency_arr); $i++) {
                $competency_def_arr[$i] = $questionsClass->getEnDespByCompetency($competency_arr[$i]);
                $competency_id_arr[$i] = $questionsClass->getCompetencyIdByCompetency($competency_arr[$i]);
            }
            $importanceofcompetencies_assocarr = $questionsClass->getImportanceOfCompetenciesAnswer_arr($companyId, $rater_id);
            $importanceofcompetencies_previousanswers = array();
            if(isset($importanceofcompetencies_assocarr)){
                for($i=0; $i<count($competency_arr); $i++){
                    $importanceofcompetencies_previousanswers[$i] = isset($importanceofcompetencies_assocarr[$competency_id_arr[$i]]) ? $importanceofcompetencies_assocarr[$competency_id_arr[$i]] : "";
                }
            }
            for ($i = 0; $i < count($competency_arr); $i++) {
                echo
                "<div style='width: 100%; display: flex; justify-content: space-between;'>
                    <div class='questionnaire_importanceofcompetency_component' style=' width:80%; display: inline-block; vertical-align: middle; border: 1px solid black;'>" .
                    "<div class='questionnaire_importanceofcompetency_title' style='font-family: `Calibri`; font-size: 14px; font-weight: bold; padding-left: 5px;'>" . $competency_arr[$i] . "</div>" .
                    "<div class='questionnaire_importanceofcompetency_definition' style='font-family: `Calibri`; font-size: 12px; padding-left: 5px;'>" . $competency_def_arr[$i] . "</div>" .
                    "</div>" .
                    "<div class='questionnaire_importanceofcompetency_table' style='display: inline-block; vertical-align: middle; margin-left: 10px;'>" .
                    "<table style=' width:20%; border: 1px solid black;'>
                        <thead>
                            <tr>
                                <th style='text-align: center;'>1</th>
                                <th style='text-align: center;'>2</th>
                                <th style='text-align: center;'>3</th>
                                <th style='text-align: center;'>4</th>
                                <th style='text-align: center;'>5</th>
                            </tr>
                        </thead>" .
                        "<tr>
                        <td style='border: 1px solid black; padding-right: 15px; padding-left: 15px;'><input type='radio' name='importanceofcompetencies[{$i}]' value='1'" . (isset($importanceofcompetencies_previousanswers[$i]) && $importanceofcompetencies_previousanswers[$i] == 1 ? ' checked' : '') . "></td>
                        <td style='border: 1px solid black; padding-right: 15px; padding-left: 15px;'><input type='radio' name='importanceofcompetencies[{$i}]' value='2'" . (isset($importanceofcompetencies_previousanswers[$i]) && $importanceofcompetencies_previousanswers[$i] == 2 ? ' checked' : '') . "></td>
                        <td style='border: 1px solid black; padding-right: 15px; padding-left: 15px;'><input type='radio' name='importanceofcompetencies[{$i}]' value='3'" . (isset($importanceofcompetencies_previousanswers[$i]) && $importanceofcompetencies_previousanswers[$i] == 3 ? ' checked' : '') . "></td>
                        <td style='border: 1px solid black; padding-right: 15px; padding-left: 15px;'><input type='radio' name='importanceofcompetencies[{$i}]' value='4'" . (isset($importanceofcompetencies_previousanswers[$i]) && $importanceofcompetencies_previousanswers[$i] == 4 ? ' checked' : '') . "></td>
                        <td style='border: 1px solid black; border-right: none; padding-right: 15px; padding-left: 15px;'><input type='radio' name='importanceofcompetencies[{$i}]' value='5'" . (isset($importanceofcompetencies_previousanswers[$i]) && $importanceofcompetencies_previousanswers[$i] == 5 ? ' checked' : '') . "></td>
                        </tr>" .
                    "</table>" .
                    "</div>" .
                    "</div>";
            }
            ?>
            <br>
            <?= $language["questionnaire_importanceofcompetency_paragraph2"] ?>
            <button type="button" class="btn btn-success btn-sm addButton competency-add-btn questionnaire-confirm-button" data-toggle="modal" data-target="#deleteModal" style="margin-left: 0px !important;"><?= $language["questionnaire_confirm_button"] ?></button>
            <br>
            <!--
            <button class="btn btn-primary btn-sm questionnaire-importanceofcompetency-previous"><?= $language["questionnaire_previous_button"] ?></button>
            <button class="btn btn-primary btn-sm questionnaire-importanceofcompetency-next"><?= $language["questionnaire_next_button"] ?></button>
            -->
        </section>
        <section id="competency-statements-page" class="questionnaire-page">
            <div class="questionnaire-header"><?= $language["questionnaire_header_title"] ?></div>
            <br>
            <div class="questionnaire-paragraph-title">
                <?
                if ($role == "manager" or $role == "focus") {
                    echo $language["questionnaire_competencystatements_title_for_focus_manager"];
                } elseif ($role != "manager" and $role != "focus") {
                    echo $language["questionnaire_competencystatements_title_for_others"];
                }
                ?>
            </div>
            <div class="questionnaire-competency-statements-instructions">
                <div class="questionnaire-competencystatements-container">
                    <div style="display: flex; flex-direction: column;">
                        <div><?= $language["questionnaire_competencystatements_paragraph0"] ?></div>
                        <div class="questionnaire-competency-statements-instruction12345" style="margin-left: auto;">
                            <?= $language["questionnaire_competencystatements_paragraph1"] ?>
                            <?= $language["questionnaire_competencystatements_paragraph3"] ?>
                        </div>
                    </div>
                </div>
                <?= $language["questionnaire_competencystatements_paragraph2"] ?>
                <!-- TODO competency statements -->
                <div id="competency-statements-container">
                    <table style="border: 1px solid black; width: 100%;">
                        <thead style="text-align:center; background-color: #59A5CB; color:white; font-size: 14px;">
                            <tr>
                                <th style="width:80%"><?= $language["questionnaire_questions"] ?></th>
                                <th>1</th>
                                <th>2</th>
                                <th>3</th>
                                <th>4</th>
                                <th>5</th>
                                <th style="margin-left:10px;">X</th>
                            </tr>
                        </thead>

                        <?
                        $questions_arr = $questionsClass->getQuestionsForQuestionnaire();
                        $total_questions = count($questions_arr);
                        $questions_per_page = 5;
                        $total_pages = ceil($total_questions / $questions_per_page);

                        $page = isset($_POST['page']) ? $_POST['page'] : 1;
                        $start = ($page - 1) * $questions_per_page;
                        $end = $start + $questions_per_page - 1;

                        for($i=0; $i<count($questions_arr); $i++){
                            $question_id_arr[$i] = $questionsClass->getQuestionIdbyQuestion($questions_arr[$i]);
                        }
                        $competencystatements_assocarr = $questionsClass->getCompetencyStatementsAnswer_arr($companyId, $rater_id);
                        $competencystatements_previousanswers = array();
                        if(isset($competencystatements_assocarr)){
                            for($i=0; $i<count($questions_arr); $i++){
                                $competencystatements_previousanswers[$i] = isset($competencystatements_assocarr[$question_id_arr[$i]]) ? $competencystatements_assocarr[$question_id_arr[$i]] : "";
                            }
                        }
                        var_dump($competencystatements_assocarr);
                        //var_dump($competencystatements_previousanswers);
                        // Output the competency statements for the current page
                        $table = '<tbody>';
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
                        echo $table;
                        ?>
                    </table>
                </div>
                <div id="competency-statements-pagination" style="display: flex; justify-content: center; margin-top: 20px;">
                    <? if ($total_pages > 1) : ?>
                        <ul class="pagination">
                            <li class="page-item <? echo $page == 1 ? 'disabled' : ''; ?>">
                                <a class="page-link" href="javascript:void(0);" data-page="<? echo $page - 1; ?>">
                                    <? echo $language['questionnaire_pagination_previous']; ?>
                                </a>
                                <? echo '<input type="hidden" name="a" value="submitCompetencyStatements"> ';?>
                            </li>
                            <? for ($i = 1; $i <= min(5, $total_pages); $i++) : ?>
                                <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                                    <a class="page-link" href="javascript:void(0);" data-page="<? echo $i; ?>">
                                        <? echo $i; ?>
                                    </a>
                                    <? echo '<input type="hidden" name="a" value="submitCompetencyStatements"> ';?>
                                </li>
                            <? endfor; ?>
                            <li class="page-item <?php echo $page == $total_pages ? 'disabled' : ''; ?>">
                                <a class="page-link" href="javascript:void(0);" data-page="<? echo $page + 1; ?>">
                                    <? echo $language['questionnaire_pagination_next']; ?>
                                </a>
                                <? echo '<input type="hidden" name="a" value="submitCompetencyStatements"> ';?>
                            </li>
                        </ul>
                    <? endif; ?>
                </div>
            </div>
            <br>
            <?
            if ($role == "manager") {
                echo '<button class="btn btn-primary btn-sm questionnaire-competencystatement-previous">', $language["questionnaire_previous_button"], '</a></button>';
                echo '<input type="hidden" name="a" value="submitCompetencyStatements"> ';
                echo '<button class="btn btn-primary btn-sm questionnaire-competencystatement-next">', $language["questionnaire_next_button"], '</a></button>';
            } elseif ($role == "focus") {
                echo '<button class="btn btn-primary btn-sm questionnaire-competencystatement-previous">', $language["questionnaire_previous_button"], '</a></button>';
                // echo '<input type="hidden" name="a" value="submitQuestionnaire"> ';
                //TODO HERE
                echo '<button class="btn btn-success btn-sm addButton competency-add-btn questionnaire-competencystatement-next">', $language["questionnaire_finish_button"], '</button>';
            } else {
                echo '<input type="hidden" name="a" value="submitCompetencyStatements"> ';
                echo '<button class="btn btn-primary btn-sm questionnaire-competencystatement-next">', $language["questionnaire_next_button"], '</a></button>';
            }
            ?>
        </section>
        <section id="open-end-question-page" class="questionnaire-page">
            <div class="questionnaire-header"><?= $language["questionnaire_header_title"] ?></div>
            <br>
            <?
            if ($role == "manager") {
                echo $language["questionnaire_openendquestion_title_for_manager"];
            } elseif ($role != "manager") {
                echo $language["questionnaire_openendquestion_title_for_others"];
            }
            ?>
            <?= $language["questionnaire_openendquestion_paragraph1"] ?>
            <textarea class="questionnaire_openendquestion_text-input" name="questionnaire_openendquestion" placeholder="(Maximum 100 words)" rows="6"></textarea>
            <!-- --------------------------- YES/NO BUTTONS ----------------------------- -->
            <!--<div class="questionnaire_openendquestion_discuss_container" style="display:inline-block;">-->
            <?= $language["questionnaire_openendquestion_paragraph2"] ?>
            <label style="margin-left: 20px; color:#3C4858;"><input type="radio" name="questionnaire_yesno_discuss" value="1"><?= $language["questionnaire_openendquestion_discuss_yes"] ?></label>
            <label style="margin-left: 20px; color:#3C4858;"><input type="radio" name="questionnaire_yesno_discuss" value="0"><?= $language["questionnaire_openendquestion_discuss_no"] ?></label>
            <!--</div>-->
            <!-- ------------------------------------------------------------------------- -->
            <?= $language["questionnaire_openendquestion_finish"] ?>
            <button class="btn btn-primary btn-sm questionnaire-openendquestion-previous"><a style="color:white;" href="#competency-statements-page"><?= $language["questionnaire_previous_button"] ?></a></button>
            <input type="hidden" name="a" value="submitopenendquestion"> 
            <!-- <button class="btn btn-success btn-sm addButton competency-add-btn questionnaire-finish-button"><?= $language["questionnaire_finish_button"] ?></button> -->
            <input class="btn btn-success btn-sm addButton competency-add-btn questionnaire-openendquestion-finish" type="submit">
        </section> 
    </form>

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
    <script> 
        rater_id = <? echo $rater_id?>;
        competency_arr = <? echo json_encode($competency_arr) ?>;
        questions_per_page = <? echo $questions_per_page?>;
        total_questions = <? echo $total_questions?>;
        total_pages = <? echo $total_pages; ?>;
        questions_arr = <? echo json_encode($questions_arr) ?>;
        var Questionnaire = new Questionnaire();
    </script>
</body>

</html>