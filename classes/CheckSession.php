<?
  include_once "../classes/Constant.php";

  if(!isset($_COOKIE['lang'])){
    if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
      $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
      $lang = in_array($lang, $ACCEPT_LANG) ? $lang : 'en';
    }else{
      $lang = 'en';
    }
    $_COOKIE['lang'] = $lang;
    setcookie("lang", $lang, 2147483647, "/");
  }
  include_once "../lang/". $_COOKIE['lang'].".php";

  if(!isset($_SESSION)) { 
    session_name("id");
    session_start();
  } 

  $_SESSION['last_action'] = time();
?>