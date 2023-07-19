
    

  <script>
    var $_POST = [];
    var $_GET = {"a":"listofraters"};
  </script>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="apple-touch-icon" sizes="76x76" href="../img/apple-touch-icon.png">
  <link rel="icon" type="image/png" href="../img/favicon.ico">
  <title>PerformVE</title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <link href="../assets/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
  <link href="../lib/dataTables/css/dataTables.min.css" rel="stylesheet" />
  <link href="../assets/css/bootstrap-select.min.css" rel="stylesheet" />
  <link href="../assets/css/style.css?v=2.0.8" rel="stylesheet">
  <link href="../assets/css/rowReorder.dataTables.min.css" rel="stylesheet">
  <link href="../assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
  <link href="../assets/css/bootstrap-glyphicons.min.css" rel="stylesheet">
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-Z20LRD6WWG"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'G-Z20LRD6WWG');
  </script>
</head>
<body>
  <div class="wrapper">
    <div class="sidebar" data-color="danger" data-background-color="white">
  <div class="logo">
    <img src='../logo/logo.png' />    <div class="sidebar-displayName">Hello, Assessment 360</div>
  </div>
  <div class="sidebar-wrapper" id="leftmenubar">
    <ul class="nav">

  
            
        <li class="nav-item leftMenuActive">
          <a class="nav-link" href="./assess360?a=listofraters">
            <i class="material-icons">check_circle</i>
            <p>List of raters</p>
          </a>
        </li>
      
      
        <li class="nav-item ">
          <a class="nav-link" href="./assess360?a=assess360">
            <i class="material-icons">check_circle</i>
            <p>Assessment 360</p>
          </a>
        </li>
      
      <li class="nav-item">
        <a class="nav-link" href="logout">
          <i class="material-icons">directions_run</i>
          <p>Logout</p>
        </a>
      </li>
    </ul>
  </div>
</div>

<script>
  document.getElementById("leftmenubar").addEventListener("scroll", function() {
    sessionStorage.setItem('scroll', document.getElementById("leftmenubar").scrollTop);
  });
  document.getElementById("leftmenubar").scrollTop = sessionStorage.getItem('scroll');
</script>
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteModalLabel">Warning</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Conifrm Delete?          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary confirm-delete" data-dismiss="modal">Delete</button>
          </div>
        </div>
      </div>
    </div>

    <!-- /* taking the box down*/ -->
    <style>.container-fluid {
    padding-top: 20px;
    padding-left: 20px
    }
</style>

    <div class="main-panel">
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
      <!-- <img class = "image1" src="https://www.performve.com/img/logo.png" alt="performVe">
      <style>
            .image1 {
    /* display: block;
    max-width: 100%;
    height: 200%;
    text-align: center;
    
    margin: 10px; */
    display: block;
  margin: 0 auto;
  text-align: center;
    }
      </style> -->
      
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand"> </p> </a>
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
                <!-- <a class="navbar-brand"> <h4> -->
               <h4> <br>Thank you for completing the form, a questionnaire will be sent to each of the rater's email soon!<br><br><br></h4></a>
                <style>   h4 {
                /* color: inherit;
                font-size: 1.3em;
                font-weight: bold; */
                font-family: system-ui, sans-serif;
                font-size: 1.8rem;
                
                cursor: pointer;
                --s: 0.1em;   /* the thickness of the line                                            *                                                                                                                                                                                                                                                                                                                                                                                                                                /
                --c: red; /* the color */
                
                color: Red;
                padding-bottom: var(--s);
                background: 
                    linear-gradient(90deg,var(--c) 50%,#000 0) calc(100% - var(--_p,0%))/200% 100%,
                    linear-gradient(var(--c) 0 0) 0% 100%/var(--_p,0%) var(--s) no-repeat;
                -webkit-background-clip: text,padding-box;
                        background-clip: text,padding-box;
                transition: 0.5s;
                
                }
                h4:hover {--_p: 100%}</style>

                </div>
              </div>
            </div>
          </div>
          <!-- ---------------------------------------------------------------- -->
            <!--==========================
    Footer
  ============================-->
  <footer class="footer">
    <div class="copyright float-left">
      &copy;
      
      <script>
       
        document.write(new Date().getFullYear())
      </script> PerformVE Limited. All rights reserved. | Room 18, Unit 109B-113, 1/F, Enterprise Place (5W), No. 5 Science Park West Avenue, Hong Kong Science Park    </div>
  </footer>        </div>
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
  <script src="../js/lang/en.js?v=2.0.15"></script>
  <script src="../js/assess360.js?v=2.0.15"></script>
  <script>
    var Raterlist = new Raterlist();
  </script>







</body>

</html>


 <!----------------------------------SARBULAND------------------------------------------------>
 
<!-- <br />
<b>Warning</b>:  Undefined array key "comp_arr" in <b>C:\xampp\htdocs\assessment_360-main\member\assess360.php</b> on line <b>417</b><br />
<br />
<b>Fatal error</b>:  Uncaught TypeError: count(): Argument #1 ($value) must be of type Countable|array, null given in C:\xampp\htdocs\assessment_360-main\member\assess360.php:418
Stack trace:
#0 {main}
  thrown in <b>C:\xampp\htdocs\assessment_360-main\member\assess360.php</b> on line <b>418</b><br />
