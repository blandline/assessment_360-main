<?
if(!isset($_SESSION)) {
    session_name("id");
    session_start();
} 
/* Start session, this is necessary, it must be the first thing in the PHP document after <? syntax ! */ 

session_unset();
session_destroy();  // Destroy all session data.

header('Location: ../login');