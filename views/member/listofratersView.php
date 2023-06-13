<? include_once '../config/config.php'; ?>
<? include_once '../member/header.php'; ?>

<body>
  <div class="wrapper">
    <? include_once '../member/leftmenu.php'; ?>

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
            <?= $language["competency_framework_confirm_delete"]; ?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $language["competency_framework_cancel"]; ?></button>
            <button type="button" class="btn btn-primary confirm-delete" data-dismiss="modal"><?= $language["competency_framework_delete"]; ?></button>
          </div>
        </div>
      </div>
    </div>

    <div class="main-panel">
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand"><?= $language["listofraters_framework_title"]; ?></a>
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


      <!-- --------------------------------NEW TABLE------------------------- -->
      <div class="content search-competency-content">
        <div class="container-fluid">
          <div class="row">
            <div class="competency-frm-table-div">
              <div class="card">
                <div class="div-datatable-competency card-body table-responsive">
                  <div class="listofraters-form-and-button-container">
                    <form method="post" id="rateform" action="assess360">
                      <table id="raterlisttable" class="competency-frm-table table table-hover" style="width:100%;">
                        <thead class="text-danger">
                          <tr>
                            <th colspan="2" style="text-align: center;"><?= $language["listofraters_framework_focusname"]; ?></th>
                            <th colspan="2" rowspan="2" style="text-align: center;"><?= $language["listofraters_framework_launchdate"]; ?></th>
                            <th colspan="2" rowspan="2" style="text-align: center;"><?= $language["listofraters_framework_enddate"]; ?></th>
                            <th colspan="2" style="text-align: center;"><?= $language["listofraters_framework_raters"]; ?></th>
                            <th rowspan="2" style="text-align: center;"><?= $language["listofraters_framework_role"]; ?></th>
                            <th rowspan="2" style="text-align: center;"><?= $language["listofraters_framework_gender"]; ?></th>
                            <th rowspan="2" style="text-align: center;"><?= $language["listofraters_framework_position"]; ?></th>
                            <th rowspan="2" style="text-align: center;"><?= $language["listofraters_framework_email"]; ?></th>
                            <th rowspan="2" style="text-align: center;"><?= $language["listofraters_framework_actions"]; ?></th>
                          </tr>
                          <tr>
                            <th style="text-align: center;"><?= $language["listofraters_framework_firstname"]; ?></th>
                            <th style="text-align: center;"><?= $language["listofraters_framework_lastname"]; ?></th>
                            <th style="text-align: center;"><?= $language["listofraters_framework_firstname"]; ?></th>
                            <th style="text-align: center;"><?= $language["listofraters_framework_lastname"]; ?></th>
                            <div class="addButtonWrapper">
                          </tr>
                        </thead>
                        <tr>
                          <td><input type="text" name="rows[0][FOCUS_first_name]" style="width:75px"></td>
                          <td><input type="text" name="rows[0][FOCUS_last_name]" style="width:75px"></td>
                          <td colspan="2"><input type="date" name="rows[0][Launch-date]" style="width:115px"></td>
                          <td colspan="2"><input type="date" name="rows[0][End-date]" style="width:115px"></td>
                          <td><input type="text" name="rows[0][Rater-first-name]" style="width:75px"></td>
                          <td><input type="text" name="rows[0][Rater-last-name]" style="width:75px"></td>
                          <td>
                            <select name="rows[0][Roles]" id="roles" style="width:95px; -webkit-appearance: menulist;">
                              <option value="FOCUS" name='focus_role'><?= $language["listofraters_role_focus"]; ?></option>
                              <option value="Manager" name='manager_role'><?= $language["listofraters_role_manager"]; ?></option>
                              <option value="Colleague" name='colleague_role'><?= $language["listofraters_role_colleague"]; ?></option>
                              <option value="Direct report" name='direct_report_role'><?= $language["listofraters_role_directreport"]; ?></option>
                              <option value="Other" name='other_role'><?= $language["listofraters_role_other"]; ?></option>
                            </select>
                          </td>
                          <td>
                            <select name="rows[0][Genders]" id="genders" style="width:80px; -webkit-appearance: menulist;">
                              <option value="Male" name='male_gender'><?= $language["listofraters_gender_male"]; ?></option>
                              <option value="Female" name='female_gender'><?= $language["listofraters_gender_female"]; ?></option>
                              <option value="Other Gender" name='other_gender'><?= $language["listofraters_gender_other"]; ?></option>
                            </select>
                          </td>
                          <td><input type="text" name="rows[0][position]" style="width:75px"></td>
                          <td><input type="text" name="rows[0][email]" style="width:80px"></td>
                          <td></td>
                        </tr>
                      </table>
                      <input class="btn btn-success btn-sm addButton competency-add-btn" type="submit" value="Activate">
                    </form>
                    <button class="btn btn-primary btn-sm addButton raterlist-add-btn" style="position: absolute; right: 10px; display:inline-block;"><?= $language["listofraters_add_button"]; ?></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- ---------------------------------------------------------------- -->
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
  <script src="../js/lang/<?= $_COOKIE['lang'] ?>.js?v=<?= $jsVersion; ?>"></script>
  <script src="../<?= $jspath; ?>/assess360.js?v=<?= $jsVersion; ?>"></script>
  <script>
    var Raterlist = new Raterlist();
  </script>

  <!-- <?php

        if (isset($_POST["Activate"])) {
          header('https://chess.com');
        }

        ?> -->





</body>

</html>