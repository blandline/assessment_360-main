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

<?
$role_arr = ["focus", "manager", "colleague", "direct report", "others"];
$role = $role_arr[2];
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
            //$focus_id = $listofratersClass->getFocusId($companyId);
            $focus_id = 0;
            $temp_title = $questionsClass->getCompetencyByFocusID($focus_id);
            // $temp_title = $questionsClass->getCompetencyForQuestionnaire();
            $temp_definition = array();
            for ($i = 0; $i < count($temp_title); $i++) {
                $temp_definition[$i] = $questionsClass->getEnDespByCompetency($temp_title[$i]);
            }
            for ($i = 0; $i < count($temp_title); $i++) {
                echo
                "<div style='width: 100%; display: flex; justify-content: space-between;'>
                    <div class='questionnaire_importanceofcompetency_component' style=' width:80%; display: inline-block; vertical-align: middle; border: 1px solid black;'>" .
                    "<div class='questionnaire_importanceofcompetency_title' style='font-family: `Calibri`; font-size: 14px; font-weight: bold; padding-left: 5px;'>" . $temp_title[$i] . "</div>" .
                    "<div class='questionnaire_importanceofcompetency_definition' style='font-family: `Calibri`; font-size: 12px; padding-left: 5px;'>" . $temp_definition[$i] . "</div>" .
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
                                    <td style='border: 1px solid black; padding-right: 15px; padding-left: 15px;'><input type='radio' name='importanceofcompetencies[{$i}]' value='1'></td>
                                    <td style='border: 1px solid black; padding-right: 15px; padding-left: 15px;'><input type='radio' name='importanceofcompetencies[{$i}]' value='2'></td>
                                    <td style='border: 1px solid black; padding-right: 15px; padding-left: 15px;'><input type='radio' name='importanceofcompetencies[{$i}]' value='3'></td>
                                    <td style='border: 1px solid black; padding-right: 15px; padding-left: 15px;'><input type='radio' name='importanceofcompetencies[{$i}]' value='4'></td>
                                    <td style='border: 1px solid black; border-right: none; padding-right: 15px; padding-left: 15px;'><input type='radio' name='importanceofcompetencies[{$i}]' value='5'></td>
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
                        $result_arr = $questionsClass->getQuestionsForQuestionnaire();

                        $total_questions = count($result_arr);
                        $questions_per_page = 5;
                        $total_pages = ceil($total_questions / $questions_per_page);

                        $page = isset($_GET['page']) ? $_GET['page'] : 1;
                        $start = ($page - 1) * $questions_per_page;
                        $end = $start + $questions_per_page - 1;

                        // Output the competency statements for the current page
                        $table = '<tbody>';
                        for ($i = $start; $i <= $end && $i < $total_questions; $i++) {
                            $table .=
                                "<tr style='font-size: 14px;'>
                                <td style='border: 1px solid black; padding-left: 5px;'>{$result_arr[$i]}</td>
                                <td style='border: 1px solid black; padding-right: 15px; padding-left: 15px;'><input type='radio' name='competencystatements[{$i}]' value='1'></td>
                                <td style='border: 1px solid black; padding-right: 15px; padding-left: 15px;'><input type='radio' name='competencystatements[{$i}]' value='2'></td>
                                <td style='border: 1px solid black; padding-right: 15px; padding-left: 15px;'><input type='radio' name='competencystatements[{$i}]' value='3'></td>
                                <td style='border: 1px solid black; padding-right: 15px; padding-left: 15px;'><input type='radio' name='competencystatements[{$i}]' value='4'></td>
                                <td style='border: 1px solid black; padding-right: 15px; padding-left: 15px;'><input type='radio' name='competencystatements[{$i}]' value='5'></td>
                                <td style='border: 1px solid black; padding-right: 15px; padding-left: 15px; margin-left:10px;'><input type='radio' name='competencystatements[{$i}]' value='X'></td>
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
                            <li class="page-item disabled"><a class="page-link" style="color:#2196f3;" onclick="changePage(<? echo $page - 1; ?>)"><? echo $language["questionnaire_pagination_previous"]; ?></a></li>
                            <? for ($i = 1; $i <= min(5, $total_pages); $i++) : ?>
                                <? if ($i == $page) : ?>
                                    <li class="page-item active"><a class="page-link"><? echo $i; ?></a></li>
                                <? else : ?>
                                    <li class="page-item"><a class="page-link"  style="color:#2196f3;" onclick="changePage(<? echo $i; ?>)"><? echo $i; ?></a></li>
                                <? endif; ?>
                            <? endfor; ?>
                            <? if ($page < $total_pages) : ?>
                                <li class="page-item"><a class="page-link" style="color:#2196f3;" onclick="changePage(<? echo $page + 1; ?>)"><? echo $language["questionnaire_pagination_next"]; ?></a></li>
                            <? endif; ?>
                        </ul>
                    <? endif; ?>
                </div>
            </div>
            <br>
            <?
            if ($role == "manager") {
                echo '<button class="btn btn-primary btn-sm questionnaire-competencystatement-previous">', $language["questionnaire_previous_button"], '</a></button>';
                echo '<button class="btn btn-primary btn-sm questionnaire-competencystatement-next">', $language["questionnaire_next_button"], '</a></button>';
            } elseif ($role == "focus") {
                echo '<button class="btn btn-primary btn-sm questionnaire-competencystatement-previous">', $language["questionnaire_previous_button"], '</a></button>';
                echo '<button class="btn btn-success btn-sm addButton competency-add-btn questionnaire-finish-button">', $language["questionnaire_finish_button"], '</button>';
            } else {
                echo '<button class="btn btn-primary btn-sm questionnaire-competencystatement-next">', $language["questionnaire_next_button"], '</a></button>';
            }
            ?>
        </section>

        <script>
            function changePage(page) {
                $.ajax({
                    url: 'assess360',
                    type: 'GET',
                    data: {
                        page: page,
                        questions_per_page: <?php echo $questions_per_page; ?>,
                        total_questions: <?php echo $total_questions; ?>,
                        result_arr: JSON.stringify(<?php echo json_encode($result_arr); ?>)
                    },
                    success: function(html) {
                        $('#competency-statements-container').html(html);
                        total_pages = <?php echo $total_pages; ?>;
                        updatePaginationLinks(page);
                    }
                });
            }

            function updatePaginationLinks(currentPage) {
                var paginationLinks = $('#competency-statements-pagination .pagination');
                paginationLinks.empty();
                if (total_pages > 1) {
                    var prevLink = $('<li class="page-item"><a class="page-link" href="javascript:void(0);"><?php echo $language["questionnaire_pagination_previous"]; ?></a></li>');
                    if (currentPage > 1) {
                        prevLink.click(function() {
                            changePage(currentPage - 1);
                        });
                    } else {
                        prevLink.addClass('disabled');
                    }
                    paginationLinks.append(prevLink);
                    var maxLinks = 5;
                    var startLink = Math.max(1, currentPage - 2);
                    var endLink = Math.min(total_pages, startLink + maxLinks - 1);
                    startLink = Math.max(1, endLink - maxLinks + 1);
                    for (var i = startLink; i <= endLink; i++) {
                        var pageLink = $('<li class="page-item"><a class="page-link" href="javascript:void(0);">' + i + '</a></li>');
                        if (i == currentPage) {
                            pageLink.addClass('active');
                        } else {
                            pageLink.click(function() {
                                currentPage = parseInt($(this).text()); // update the currentPage variable
                                changePage($(this).text());
                            });
                        }
                        paginationLinks.append(pageLink);
                    }
                    var nextLink = $('<li class="page-item"><a class="page-link" href="javascript:void(0);"><?php echo $language["questionnaire_pagination_next"]; ?></a></li>');
                    if (currentPage < total_pages) {
                        nextLink.click(function() {
                            if (currentPage < total_pages) {
                                currentPage++; // update the currentPage variable
                                changePage(currentPage);
                            }
                        });
                    } else {
                        nextLink.addClass('disabled');
                    }
                    paginationLinks.append(nextLink);
                }
            }
        </script>

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
            <label style="margin-left: 20px; color:#3C4858;"><input type="radio" name="questionnaire_yesno_discuss" value="yes"><?= $language["questionnaire_openendquestion_discuss_yes"] ?></label>
            <label style="margin-left: 20px; color:#3C4858;"><input type="radio" name="questionnaire_yesno_discuss" value="no"><?= $language["questionnaire_openendquestion_discuss_no"] ?></label>
            <!--</div>-->
            <!-- ------------------------------------------------------------------------- -->
            <?= $language["questionnaire_openendquestion_finish"] ?>
            <button class="btn btn-primary btn-sm questionnaire-openendquestion-previous"><a style="color:white;" href="#competency-statements-page"><?= $language["questionnaire_previous_button"] ?></a></button>
            <button class="btn btn-success btn-sm addButton competency-add-btn questionnaire-finish-button"><?= $language["questionnaire_finish_button"] ?></button>
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