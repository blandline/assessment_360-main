<? include_once '../config/config.php'; ?>
<? include_once '../member/header.php'; ?>

<body>
    <div class="wrapper">
        <? include_once '../member/leftmenu.php'; ?>
        <div class="main-panel">
            <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <a class="navbar-brand"><?= $language["competency_focus_competency_framework_title"]; ?></a>
                        <?
                        if ($login->isAdmin()) {
                            if (isset($_POST["ac"])) {
                                $_SESSION[$session_admin_temp_compId] = $_POST["ac"];
                            }
                        ?>
                            <select id="ac" style="-webkit-appearance: menulist;">
                                <?
                                $result = $login->getCompany(true);
                                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                    $name = $row["en_name"];
                                    if (!empty(@$_SESSION[$session_admin_temp_compId]) && $row["id"] == $_SESSION[$session_admin_temp_compId]) {
                                ?>
                                        <option selected value="<?= $row["id"]; ?>"><?= $name; ?></option>
                                    <? } else { ?>
                                        <option value="<?= $row["id"]; ?>"><?= $name; ?></option>
                                    <? } ?>
                                <? } ?>
                            </select>
                        <? } ?>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                    </button>
                </div>
            </nav>
            <div class="content search-competency-content">
                <div class="container-fluid">
                    <? include_once '../member/footer.php'; ?>
                </div>
            </div>
        </div>
    </div>
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
</body>

</html>