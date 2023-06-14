<? include_once '../config/config.php'; ?>
<? include_once '../member/header.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questionnaire</title>
</head>

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
    <form>
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
            </div>
        </section>
        <section id="importance-of-competency-page" class="questionnaire-page">
            <div class="questionnaire-header"><?= $language["questionnaire_header_title"] ?></div>
            <br>
            <div class="questionnaire-paragraph-title"><?= $language["questionnaire_importanceofcompetency"] ?></div>
            <br>
            <?= $language["questionnaire_importanceofcompetency_paragraph1"] ?>
            <!-- TODO list of competencies-->
            <?
            // if (isset($_POST['comp_arr'])) {
            //     $comp_arr = $_POST['comp_arr'];
            //     foreach ($comp_arr as $comp) {
            //         echo "<div>" . $comp . "</div>";
            //     }
            // }
            $temp_title = "Deciding";
            $temp_definition = "Making decisions based on (in)complete information and initiating...";
            for ($i = 0; $i < 5; $i++) {
                echo 
                "<div style='width: 100%;'>
                    <div class='questionnaire_importanceofcompetency_component' style='border: 1px solid black; width:80%; display: inline-block;'>".
                        "<div class='questionnaire_importanceofcompetency_title'>" . $temp_title . "</div>".
                        "<div class='questionnaire_importanceofcompetency_definition'>" . $temp_definition . "</div>".
                    "</div>". 
                    "<div class='questionnaire_importanceofcompetency_table' style='display: inline-block; margin-left: 10px;'>".
                        "<table style='border: 1px solid black; width:20%'>
                            <thead>
                                <tr>
                                    <th style='text-align: center;'>1</th>
                                    <th style='text-align: center;'>2</th>
                                    <th style='text-align: center;'>3</th>
                                    <th style='text-align: center;'>4</th>
                                    <th style='text-align: center;'>5</th>
                                </tr>
                            </thead>".
                            "<tr>
                                <td style='border: 1px solid black; padding-right: 15px; padding-left: 15px;'><input type='radio' name='importanceofcompetencies[{$i}]' value='1'></td>
                                <td style='border: 1px solid black; padding-right: 15px; padding-left: 15px;'><input type='radio' name='importanceofcompetencies[{$i}]' value='2'></td>
                                <td style='border: 1px solid black; padding-right: 15px; padding-left: 15px;'><input type='radio' name='importanceofcompetencies[{$i}]' value='3'></td>
                                <td style='border: 1px solid black; padding-right: 15px; padding-left: 15px;'><input type='radio' name='importanceofcompetencies[{$i}]' value='4'></td>
                                <td style='border: 1px solid black; padding-right: 15px; padding-left: 15px;'><input type='radio' name='importanceofcompetencies[{$i}]' value='5'></td>
                            </tr>".
                        "</table>".
                    "</div>".
                "</div>";
            }
            ?>
            <br>
            <?= $language["questionnaire_importanceofcompetency_paragraph2"] ?>
            <button type="button" class="btn btn-success btn-sm addButton competency-add-btn questionnaire-confirm-button" data-toggle="modal" data-target="#deleteModal" style="margin-left: 0px !important;"><?= $language["questionnaire_confirm_button"] ?></button>
            <br>
            <br>
            <button><a href="#intro-page"><?= $language["questionnaire_previous_button"] ?></a></button>
            <button><a href="#competency-statements-page"><?= $language["questionnaire_next_button"] ?></a></button>
        </section>
        <section id="competency-statements-page" class="questionnaire-page">
            <div class="questionnaire-header"><?= $language["questionnaire_header_title"] ?></div>
            <br>
            <div class="questionnaire-paragraph-title"><?= $language["questionnaire_competencystatements"] ?></div>
            <div class="questionnaire-competency-statements-instructions">
                <?= $language["questionnaire_competencystatements_paragraph"] ?>
                <!-- TODO competency statements-->
            </div>
            <button><a href="#importance-of-competency-page"><?= $language["questionnaire_previous_button"] ?></a></button>
            <button><a href="#open-end-question-page"><?= $language["questionnaire_next_button"] ?></a></button>
        </section>
        <section id="open-end-question-page" class="questionnaire-page">
            <div class="questionnaire-header"><?= $language["questionnaire_openendquestion"] ?></div>
            <br>
            <?= $language["questionnaire_openendquestion_paragraph1"] ?>
            <input type="text" class="text-input" placeholder="(Maximum 100 words)">
            <!-- --------------------------- YES/NO BUTTONS ------------------------------->
            <div class="questionnaire_openendquestion_discuss_container" style="display:inline-block;">
                <?= $language["questionnaire_openendquestion_paragraph2"] ?>
                <label>Yes<input type="radio" name="yesno" value="yes"></label>
                <label>No<input type="radio" name="yesno" value="no"></label>
            </div>
            <!-- --------------------------------------------------------------------------->
            <?= $language["questionnaire_openendquestion_finish"] ?>
            <button><a href="#competency-statements-page"><?= $language["questionnaire_previous_button"] ?></a></button>
            <button><?= $language["questionnaire_finish_button"] ?></button>
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
        var Questionnaire = new Questionnaire();
    </script>
</body>

</html>