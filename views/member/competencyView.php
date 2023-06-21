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
            <a class="navbar-brand">Competency Selection</a>
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
      <section id="competency-selection-page-button" class="competency-page">
      <div style="margin-top: 95px; position: absolute; right: 12px;">
        <button type="button" class="btn btn-primary test-btn"><?= $language["confirm_button"]; ?></button>
      </div>
      </section>
      <div class="content search-competency-content">
        <div class="container-fluid">
          <div class="row">
            <div class="competency-frm-table-div">
              <div class="card">
                <div class="div-datatable-competency card-body table-responsive">
                  <section id="focus-selection-page" class="competency-page competency-page-active">
                    <form method="post" id="rateform" action="assess360">
                      <table id="raterlisttable" class="table table-hover" style="width:100%;">
                        <thead class="text-danger">
                          <tr>
                            <th><?= $language["competency_focus_selection_firstname"]?></th>
                            <th><?= $language["competency_focus_selection_lastname"]?></th>
                            <th><?= $language["competency_focus_selection_position"]?></th>
                            <th><?= $language["competency_focus_selection_launchdate"]?></th>
                            <th><?= $language["competency_focus_selection_enddate"]?></th>
                            <th><?= $language["competency_focus_selection_action"]?></th>
                            <th style="display:none"><?= $language["competency_focus_selection_focusid"]?></th>
                          </tr>
                        </thead>
                        <tbody>
                          <!-- ------------------SHOW THE FOCUS SELECTION TABLE HERE-------------- -->
                          <tr>
                            <td>temp</td>
                            <td>temp</td>
                            <td>temp</td>
                            <td>temp</td>
                            <td>temp</td>
                            <td><button class="btn btn-primary btn-sm goto-competency-selection">Competency Selection</button></td>
                          </tr>
                          <!-- ------------------------------------------------------------------- -->
                        </tbody>
                      </table>
                    </form>
                  </section>
                  <section id="competency-selection-page" class="competency-page">
                    <table class="competency-frm-table table table-hover" style="width:100%;">
                      <thead class="text-danger">
                        <tr>
                          <th style="width:0px"></th>
                          <!--------------------------- NEW ------------------------------------>
                          <th><?= $language["competency_framework_position"]; ?></th>
                          <!-------------------------------------------------------------------->
                          <?
                          $result = $competency->getCompetencyCluster();
                          while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                            if (isset($_COOKIE['lang']) && $_COOKIE['lang'] == "tc") {
                              echo "<th>" . $row["tc_name"] . "</th>";
                            } else if (isset($_COOKIE['lang']) && $_COOKIE['lang'] == "sc") {
                              echo "<th>" . $row["sc_name"] . "</th>";
                            } else {
                              echo "<th>" . $row["en_name"] . "</th>";
                            }
                          }
                          ?>
                          <th class="text-right name-nowrap"><?= $language["competency_actions"]; ?></th>
                          <th class="text-center hideRowId">#</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </section>
                </div>
              </div>
            </div>
          </div>

          <div class="row competency-add-table">
            <div class="competency-table-group-div" style="display:none;">
              <div class="card">
                <div class="card-header card-header-danger">
                  <h4 class="card-title"><?= $language["competency_cluster"]; ?></h4>
                </div>
                <div class="div-datatable-competency card-body table-responsive">
                  <table class="competency-table-group table table-hover" style="width:100%;">
                    <thead class="text-danger">
                      <tr>
                        <th></th>
                        <th class="name-nowrap"><?= $language["competency_name"]; ?></th>
                        <th class="text-center hideRowId">#</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div id="competency-next-div" class="align-self-center" style="display:none;"><i class="material-icons">arrow_forward_ios</i></div>
            <div class="competency-table-competency-div" style="display:none;">
              <div class="card">
                <div class="card-header card-header-danger">
                  <h4 class="card-title"><?= $language["competency_competency"]; ?></h4>
                </div>
                <div class="div-datatable-competency card-body table-responsive">
                  <table class="competency-table-competency table table-hover" style="width:100%;">
                    <thead class="text-danger">
                      <tr>
                        <th style="width:0px"></th>
                        <th class="name-nowrap"><?= $language["competency_name"]; ?></th>
                        <th class="text-right name-nowrap"><?= $language["competency_actions"]; ?></th>
                        <th class="text-center hideRowId">#</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div id="competency-next-div2" class="align-self-center" style="display:none;"><i class="material-icons">arrow_forward_ios</i></div>
            <div class="competency-table-component-div" style="display:none;">
              <div class="card">
                <div class="card-header card-header-danger">
                  <h4 class="card-title"><?= $language["competency_component"]; ?></h4>
                </div>
                <div class="div-datatable-competency card-body table-responsive">
                  <table class="competency-table-component table table-hover" style="width:100%;">
                    <thead class="text-danger">
                      <tr>
                        <th style="width:0px"></th>
                        <th class="name-nowrap"><?= $language["competency_name"]; ?></th>
                        <th class="text-center hideRowId">#</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <br><br><br>
          </div>
          <p><a class="nav-link" href="./assess360?a=questionnaire">Questionnaire temp</a></p>
          <!-- ---------------------------------------------------------------- -->
          <? include_once '../member/footer.php'; ?>
        </div>
      </div>
      </section>
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
    var competencyselection = new CompetencySelection();
    var competency = new Competency();
  </script>

</body>

</html>