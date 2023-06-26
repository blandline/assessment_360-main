<? include_once '../config/config.php'; ?>
<? include_once '../member/header.php'; ?>



<body>
  <div class="wrapper">
    <? include_once '../member/leftmenu.php'; ?>
    <div class="main-panel">
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand"><?= $language["listofraters_data_center_framework_title"]; ?></a>
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

           
            <?$listofratersClass->printTabletwo($companyId); ?>
              <!-- <div class="card">
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
                            <th colspan="2" style="text-align: center;"><?= $language["listofraters_data_center_status"]?></th>
                            <
                          </tr>
                          <tr>
                            <th style="text-align: center;"><?= $language["listofraters_framework_firstname"]; ?></th>
                            <th style="text-align: center;"><?= $language["listofraters_framework_lastname"]; ?></th>
                            <th style="text-align: center;"><?= $language["listofraters_framework_firstname"]; ?></th>
                            <th style="text-align: center;"><?= $language["listofraters_framework_lastname"]; ?></th>
                            <th style="text-align: center;"><?= $language["listofraters_data_center_status_start"]?></th>
                            <th style="text-align: center;"><?= $language["listofraters_data_center_status_end"]?></th>
                          </tr>
                         
                        </thead>
                        <tbody>
                        
                           
                            <!-- ------------ MAKE NEW TABLE HERE ----------------------- -->
                            <!-- <tr>
                                                 
                                <td>Shadman</td>
                                <td>Yakub</td>
                                <td>13  - 08</td>
                                <td>-2023</td>
                                <td>18  - 08</td>
                                <td>-2023</td>
                                <td>Shadman</td>
                                <td>Yakub</td>
                                <td>Focus</td>
                                <td>Male</td>
                                <td>Manager</td>
                                <td>shadmanyakub747@gmail.com</td>
                                <td>Yes</td>
                                <td>Yes</td>
                                <td>No</td> 
                                
                            </tr> -->
                            <!-------------------------------------------------------------- -->
                        </tbody>                      
                        
                      </table>
                  </div> 
                </div>
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

 