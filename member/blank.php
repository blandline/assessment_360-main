<?
require("../classes/CheckSession.php");
require("../classes/Session.php");
require("../classes/MemberClass.php");

$login = new MemberClass();

if ($login->isLoggedIn()) {
?>

<?
    include("../views/member/blankView.php");
} else {
    $_SESSION[$session_login_page] = $_SERVER["REQUEST_URI"];
    header('Location: ../login');
}
?>