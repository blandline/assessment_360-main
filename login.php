<?
if (!isset($_SESSION)) {
  session_name("id");
  session_start();
}

require("classes/Constant.php");
require("classes/Session.php");
require("classes/UserClass.php");

$login = new UserClass();

if ($login->isLoggedIn() == true) {
  if (isset($_SESSION[$session_login_page]) && !empty($_SESSION[$session_login_page])) {
    header('Location: ' . $_SESSION[$session_login_page]);
    unset($_SESSION[$session_login_page]);
  } else if (in_array($PACKAGE_ASSESS_360, $_SESSION[$session_package]) && ($_SESSION[$session_userPermission] == [-1] || in_array($PERMISSION_ASSESS360_VIEW, $_SESSION[$session_userPermission]))) {
    header('Location: member/assess360?a=listofraters');
  } else {
    header('Location: member/blank');
  }
} else {
  include("views/loginForm.php");   // else prompt login form
}
?>