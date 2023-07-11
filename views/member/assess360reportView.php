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
    <script>
        var AssessmentReport = new AssessmentReport();
    </script>
</body>

</html>