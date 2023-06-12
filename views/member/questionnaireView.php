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
    <section id="intro-page" class="questionnaire-page questionnaire-page-active">
        <div class="questionnaire-header">COMPETENCE AUDIT ON FOCUS</div>
        <br>
        <div class="questionnaire-paragraph-title">INTRODUCTION</div><br>
        <div>
            <p>
                The aim of this questionnaire is to gain your objective feedback on several competencies that are relevant for the professional
                performance of the FOCUS who will have a good idea of the competencies that are well developed, as well as requiring further development.
                Therefore, your objective and truthful answer is very important for the FOCUS.</p>
            <p>The entire questionnaire will be processed anonymously. That means, no one would know your feedback.</p>
        </div>

        <div class="questionnaire-paragraph-title">INSTRUCTION</div><br>
        <div>
            <p>The Questionnaire takes you 15 to 20 minutes to complete all the simple statements.</p>
            <p>
                There are 5 answer categories (5-point scale) per statement that range from "1 - strong development needed" to "5 - exceptional strength".
                To answer, please click the bullet next to the answer of your choice.
            </p>
            <p>If you consider that you do not have enough observation about this statement on the FOCUS, please click the bullet " not enough observation".</p>
            <p>Please note that:</p>
            <p>
                1. Click "Continue Later" tp interrupt the questionnaire and continue again by accessing the given link again. Completed answers will be saved.<br>
                2. Click "Next" to save your answer and go to the next statement.<br>
                3. Write your thruthful opinion in the "open-end question" about FOCUS' behavior and performance during work.<br>
                4. Click "Finish" when completing the questionnaire. No changes on answers anymore.<br>
            </p>
            <p>If you are ready by Now, click <a href="#importance-of-competency-page">HERE</a> to start your questionnaire.</p>
        </div>
    </section>
    <section id="importance-of-competency-page" class="questionnaire-page">
        <div class="questionnaire-header">COMPETENCE AUDIT ON FOCUS</div>
        <br>
        <div class="questionnaire-paragraph-title">A. IMPORTANCE OF COMPETENCY</div>
        <br>
        <p>
            This section shows how FOCUS and Manager rate each of the competencies in terms of their importance to success in FOCUS's job. There is no
            right or wrong answer. Just show your objective and truthful answer.
        </p>
        <p>When you have completed your rating, please click</p>
        <button class="btn btn-success btn-sm addButton competency-add-btn questionnaire-confirm-button">Confirm</button>
        <br>
        <br>
        <p><a href="#intro-page">Back</a></p>
        <p><a href="#competency-statements-page">Next</a></p>
    </section>
    <section id="competency-statements-page" class="questionnaire-page">
        <div class="questionnaire-header">COMPETENCE AUDIT ON FOCUS</div>
        <br>
        <div class="questionnaire-paragraph-title">B. COMPETENCY STATEMENTS</div>
        <div class="questionnaire-competency-statements-instructions">
            <p>
                Evaluate each statement by means of following scale:<br>
                1 : strong development needed <br>
                2 : development needed <br>
                3 : competent <br>
                4 : strength <br>
                5 : exceptional strength <br>
                <br>
                X : not enough observation
            </p>
        </div>
        <p><a href="#importance-of-competency-page">Back</a></p>
        <p><a href="#open-end-question-page">Next</a></p>
    </section>
    <section id="open-end-question-page" class="questionnaire-page">
        <div class="questionnaire-header">OPEN-END QUESTION ON FOCUS</div>
        <br>
        <p>Additional advice I want to give to the FOCUS:</p>
        <input type="text" class="text-input" placeholder="(Maximum 100 words)">
        <p>Are you willing to discuss your advice with the FOCUS</p>
        <p>END OF COMPETENCY AUDIT</p>
        <p><a href="#competency-statements-page">Back</a></p>
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
        var Questionnaire = new Questionnaire();
    </script>
</body>

</html>