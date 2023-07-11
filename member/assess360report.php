<?
use Mpdf\Tag\Br;
require("../classes/MemberClass.php");
require("../classes/QuestionsClass.php");
require("../vendor/autoload.php");
require("../lang/en.php");
require("../classes/Constant.php");
require("../classes/Encryption.php");
// use Spipu\Html2Pdf\Html2Pdf;
$questionsClass = new QuestionsClass();

//change this to password checking
if (isset($_GET["id"]) && isset($_GET["password"])) {
  $rater_id = $_GET["id"];
  $password = $_GET["password"];
  $decryptedpassword = Mcrpty::_decrypt($_GET["password"]);
  $dbName = substr($decryptedpassword, 4, -4);
  
  $role = $questionsClass->getRoleByRaterId($dbName, $rater_id);
  $focus_id = $questionsClass->getFocusIdbyRaterId($dbName, $rater_id);
  $launch_date = $questionsClass->getLaunchDatebyFocusId($dbName, $focus_id);
  $current_date = date('Y-m-d');
?>
  <script>
    window["currentLang"] = '<?= $_COOKIE['lang'] ?>';

  </script>

  <script>
    var $_POST = <?php echo json_encode($_POST); ?>;
    var $_GET = <?php echo json_encode($_GET); ?>;
  </script>

<?
  include("../views/member/assess360reportView.php");
}
else {
  $_SESSION[$session_login_page] = $_SERVER["REQUEST_URI"];
  header('Location: ../login');
}
?>
