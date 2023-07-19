<? include_once '../config/config.php'; ?>
<? include_once '../member/header.php'; ?>
<?include_once  '../classes/listofratersClass.php'?>







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


            
            
  <!-- <form method="post">
    <div class="d-flex align-items-center">
      <div class="dropdown custom-dropdown">
      
        <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-weight: bold;">
          <?php
              $selectedYear = isset($_POST['selectedYear']) ? $_POST['selectedYear'] : '';
              echo $selectedYear ? $selectedYear : 'Year';
          ?>
         
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownButton" id="dropdownMenu">
          <?php
          $currentYear = date("Y");
          for ($i = 0; $i < 3; $i++) {
            $year = $currentYear - $i;            
            echo '<button class="dropdown-item" type="submit" name="selectedYear" value="' . $year . '"><span style="font-weight: bold;"> ' . $year . '</span></button>';
          }
          ?>
        </div>
      </div>

    
      <div class="input-group custom-input-group ml-4">
        <input type="text" class="form-control" placeholder="Focus Name" name="searchTerm" value="<?php echo isset($_POST['searchTerm']) ? $_POST['searchTerm'] : ''; ?>">
        <div class="input-group-append">
          <button class="btn btn-danger" type="submit" id="searchButton" style="font-weight: bold;">Search</button>
         
        </div>
      </div>
    </div>
  </form> -->
  <form method="post">
    <div class="d-flex align-items-center">
        <div class="dropdown custom-dropdown mr-4 pr-3"> <!-- added mr-4 and pr-3 classes for right margin and right padding -->

            <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-weight: bold;">
                <?php
                $selectedYear = isset($_POST['selectedYear']) ? $_POST['selectedYear'] : '';
                echo $selectedYear ? $selectedYear : 'Year';
                ?>

            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownButton" id="dropdownMenu">
                <?php
                $currentYear = date("Y");
                for ($i = 0; $i < 3; $i++) {
                    $year = $currentYear - $i;
                    echo '<button class="dropdown-item" type="submit" name="selectedYear" value="' . $year . '"><span style="font-weight: bold;"> ' . $year . '</span></button>';
                }
                ?>
            </div>
        </div>

        <!-- code for the search button with added ml-4 and pl-3 classes for left margin and left padding -->
        <div class="input-group custom-input-group ml-4 pl-3">
            <input type="text" class="form-control" placeholder="Focus Name" name="searchTerm" value="<?php echo isset($_POST['searchTerm']) ? $_POST['searchTerm'] : ''; ?>">
            <div class="input-group-append">
                <button class="btn btn-danger" type="submit" id="searchButton" style="font-weight: bold;">Search</button>
            </div>
        </div>
    </div>
</form>
</div>
          </div>

          <?php
// Handle form submission
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     // Get the search term from the form input
//     $searchTerm = isset($_POST['searchTerm']) ? $_POST['searchTerm'] : '';

//     // Call the printTableByRaterName function with the search term as the $raterName parameter
//     $listofratersClass->printTableByRaterName($companyId, $searchTerm);
// }
// ?>

          
         
          <!-- <?php
          if (!isset($_POST["selectedYear"])) {
          ?>

            <div class="row">
              <div class="col-lg-12">
                <div class="table-responsive">
                  <?php $listofratersClass->printTabletwo($companyId); ?>
                </div>
              </div>
            </div>
          <?php
          } else {
            $selectedYear = $_POST["selectedYear"];
            echo '<div class="row"><div class="col-lg-12"><div class="table-responsive">';
            $listofratersClass->printTableByStartYear($companyId, $selectedYear);
            echo '</div></div></div>';
          }
          ?> -->

<?php
if (!isset($_POST["selectedYear"])) {
?>
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // Get the search term from the form input
                    $searchTerm = isset($_POST['searchTerm']) ? $_POST['searchTerm'] : '';

                    // Call the printTableByRaterName function with the search term as the $raterName parameter
                    $listofratersClass->printTableByRaterName($companyId, $searchTerm);
                } else {
                    $listofratersClass->printTabletwo($companyId);
                }
                ?>
            </div>
        </div>
    </div>
<?php
} else {
    $selectedYear = $_POST["selectedYear"];

    echo '<div class="row"><div class="col-lg-12"><div class="table-responsive">';
    $listofratersClass->printTableByStartYear($companyId, $selectedYear);
    echo '</div></div></div>';
}
?>
          





        </div>
      </div>
              
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
    <script src="../js/assess360.js"></script>

</body>

</html>
   

 