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
                  <form method="post" id="rateform" action="listofratersView.php">
                    <table id="raterlisttable" class="competency-frm-table table table-hover" style="width:100%;">
                      <thead class="text-danger">
                        <tr>
                          <th colspan="2"><?= $language["listofraters_framework_focusname"]; ?></th>
                          <th colspan="2" rowspan="2"><?= $language["listofraters_framework_launchdate"]; ?></th>
                          <th colspan="2" rowspan="2"><?= $language["listofraters_framework_enddate"]; ?></th>
                          <th colspan="2"><?= $language["listofraters_framework_raters"]; ?></th>
                          <th rowspan="2"><?= $language["listofraters_framework_role"]; ?></th>
                          <th rowspan="2"><?= $language["listofraters_framework_gender"]; ?></th>
                          <th rowspan="2"><?= $language["listofraters_framework_position"]; ?></th>
                          <th rowspan="2"><?= $language["listofraters_framework_email"]; ?></th>
                        </tr>

                        <tr>
                          <th><?= $language["listofraters_framework_firstname"]; ?></th>
                          <th><?= $language["listofraters_framework_lastname"]; ?></th>
                          <th><?= $language["listofraters_framework_firstname"]; ?></th>
                          <th><?= $language["listofraters_framework_lastname"]; ?></th>
                        </tr>
                      </thead>
                      <tr>
                        <td><input type="text" name="rows[0]FOCUS_first_name" style="width: 75px;"></td>
                        <td><input type="text" name="rows[0]FOCUS_last_name"  style="width: 75px;"></td>
                        <td colspan="2"><input type="date" name="rows[0]Launch-date" style="width: 115px;"></td>
                        <td colspan="2"><input type="date" name="rows[0]End-date" style="width: 115px;"></td>
                        <td><input type="text" name="rows[0]Rater-first-name" style="width: 75px;"></td>
                        <td><input type="text" name="rows[0]Rater-last-name" style="width: 75px;"></td>
                        <td>
                          <select name="rows[0]Roles" id="roles" style="width: 95px;">
                            <option value="FOCUS" name='focus_role'>FOCUS</option>
                            <option value="Manager" name='manager_role'>Manager</option>
                            <option value="Colleague" name='colleague_role'>Colleague</option>
                            <option value="Direct report" name='direct_report_role'>Direct report</option>
                            <option value="Other" name='other_role'>Other</option>
                          </select>
                        </td>
                        <td>
                          <select name="rows[0]Genders" id="genders" style="width: 60px;">
                            <option value="Male" name='male_gender'>Male</option>
                            <option value="Female" name='female_gender'>Female</option>
                            <option value="Other Gender" name='other_gender'>Other</option>
                            <option value="Other Gender" name='other_gender'>Other Gender</option>
          <tr>
            <th><?= $language["listofraters_framework_firstname"]; ?></th>
            <th><?= $language["listofraters_framework_lastname"]; ?></th>
            <th><?= $language["listofraters_framework_firstname"]; ?></th>
            <th><?= $language["listofraters_framework_lastname"]; ?></th>
          </tr>
          <tr>
            <td><input type="text" name="rows[0][FOCUS_first_name]"></td>
            <td><input type="text" name="rows[0][FOCUS_last_name]"></td>
            <td colspan="2"><input type="date" name="rows[0][Launch-date]"></td>
            <td colspan="2"><input type="date" name="rows[0][End-date]"></td>
            <td><input type="text" name="rows[0][Rater-first-name]"></td>
            <td><input type="text" name="rows[0][Rater-last-name]"></td>
            <td>
              <select name="rows[0][Roles]" id="roles">
                <option value="FOCUS" name='focus_role'>FOCUS</option>
                <option value="Manager" name='manager_role'>Manager</option>
                <option value="Colleague" name='colleague_role'>Colleague</option>
                <option value="Direct report" name='direct_report_role'>Direct report</option>
                <option value="Other" name='other_role'>Other</option>
              </select>
            </td>
            <td>
              <select name="rows[0][Genders]" id="genders">
                <option value="Male" name='male_gender'>Male</option>
                <option value="Female" name='female_gender'>Female</option>
                <option value="Other Gender" name='other_gender'>Other Gender</option>

          <tr>
            <td><input type="text" name="rows[0][FOCUS_first_name]"></td>
            <td><input type="text" name="rows[0][FOCUS_last_name]"></td>
            <td colspan="2"><input type="date" name="rows[0][Launch-date]"></td>
            <td colspan="2"><input type="date" name="rows[0][End-date]"></td>
            <td><input type="text" name="rows[0][Rater-first-name]"></td>
            <td><input type="text" name="rows[0][Rater-last-name]"></td>
            <td>
              <select name="rows[0][Roles]" id="roles">
                <option value="FOCUS" name='focus_role'>FOCUS</option>
                <option value="Manager" name='manager_role'>Manager</option>
                <option value="Colleague" name='colleague_role'>Colleague</option>
                <option value="Direct report" name='direct_report_role'>Direct report</option>
                <option value="Other" name='other_role'>Other</option>
              </select>
            </td>
            <td>
              <select name="rows[0][Genders]" id="genders">
                <option value="Male" name='male_gender'>Male</option>
                <option value="Female" name='female_gender'>Female</option>
                <option value="Other Gender" name='other_gender'>Other Gender</option>

              </select>
            </td>
            <td><input type="text" name="rows[0][position]"></td>
            <td><input type="text" name="rows[0][email]"></td>
          </tr>
        </table>
        <input type="hidden" name="a" value="addListOfRaters">
        <input type="submit" style="background-color:rgb(210, 56, 56); border-color:rgb(253, 253, 255); color:rgb(0, 0, 0)" value="Activate">
      </form>
      <button class="addrow_raterlist">Add</button>
      <button class="deleterow_raterlist">Delete</button>
      <!-- ---------------------------------------------------------------- -->
      <? include_once '../member/footer.php'; ?>
                          </select>
                        </td>
                        <td><input type="text" name="rows[0]position" style="width: 75px;"></td>
                        <td><input type="text" name="rows[0]email" style="width: 90px;"></td>
                      </tr>
                      <td><input type="text" name="rows[0][FOCUS_first_name]"></td>
                      <td><input type="text" name="rows[0][FOCUS_last_name]"></td>
                      <td colspan="2"><input type="date" name="rows[0][Launch-date]"></td>
                      <td colspan="2"><input type="date" name="rows[0][End-date]"></td>
                      <td><input type="text" name="rows[0][Rater-first-name]"></td>
                      <td><input type="text" name="rows[0][Rater-last-name]"></td>
                      <td>
                        <select name="rows[0][Roles]" id="roles">
                          <option value="FOCUS" name='focus_role'>FOCUS</option>
                          <option value="Manager" name='manager_role'>Manager</option>
                          <option value="Colleague" name='colleague_role'>Colleague</option>
                          <option value="Direct report" name='direct_report_role'>Direct report</option>
                          <option value="Other" name='other_role'>Other</option>
                        </select>
                      </td>
                      <td>
                        <select name="rows[0][Genders]" id="genders">
                          <option value="Male" name='male_gender'>Male</option>
                          <option value="Female" name='female_gender'>Female</option>
                          <option value="Other Gender" name='other_gender'>Other Gender</option>
                    </table>
                    
                    <input type="submit" style="background-color:rgb(210, 56, 56); border-color:rgb(253, 253, 255); color:rgb(0, 0, 0)" value="Activate">
                  </form>
              
                  <!-- ---------------------------------------------------------------- -->
                  <? include_once '../member/footer.php'; ?>
                  
                  
                </div>
              </div>
            </div>
          </div>
          </form>
          <button class="addrow_raterlist"><?= $language["listofraters_add_button"]; ?></button>
          <button class="deleterow_raterlist"><?= $language["listofraters_delete_button"]; ?></button>
          <br>
          <br>
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
  <!----------------------------------SARBULAND------------------------------------------------>
  <?php
  // extract the data from the table-like form
  $form_data = array();
  foreach ($_POST['rows'] as $row) {
    $row_data = array();
    foreach ($row as $column_name => $column_value) {
      $row_data[$column_name] = $column_value;
    }
    $form_data[] = $row_data;
  }

  // do something with the form data
  foreach ($form_data as $row_data) {
    // do something with the row data

  }
  ?>
  <!------------------------------------------------------------------------------------------->
</body>

</html>