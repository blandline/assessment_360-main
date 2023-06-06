<?
include_once "classes/Constant.php";
if (isset($_GET['lang'])) {
    $lang = in_array($_GET['lang'], $ACCEPT_LANG) ? $_GET['lang'] : '';
    if ($lang != "") {
        $_COOKIE['lang'] = $lang;
        setcookie("lang", $lang, 2147483647, "/");
    }
}

if (!isset($_COOKIE['lang'])) {
    $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    $lang = in_array($lang, $ACCEPT_LANG) ? $lang : 'en';
    $_COOKIE['lang'] = $lang;
    setcookie("lang", $lang, 2147483647, "/");
}
include "lang/" . $_COOKIE['lang'] . ".php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>PerformVE</title>
    <meta content="Real time data analytics on employee performance, sentiment and engagement to uplift and improve people and business performance." name="description">
    <meta content="performve,team war room,the vein,onboard de vein,human captital,boost efficiency,performance,improve revenue,improve business success,real time data analytics,team collaboration,track team performance,employee sentiment,new hires sentiment,sales performance,return on investment,performance management,提高效率,表現,提高收入,提高商業成功率,實時數據分析,團隊合作,跟踪團隊表現,員工情緒,新員工情緒,銷售業績,投資回報,績效管理" name="keywords">
    <link href="img/favicon.ico" rel="icon">
    <link href="img/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="assets/vendor/splide/splide.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital@1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@1,300;1,400&display=swap" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <header id="header" class="d-flex align-items-center">
        <div class="container d-flex align-items-center justify-content-between">
            <a href="./" class="logo"><img src="img/logo.png" alt=""></a>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="./#home"><?= $language["header_home"]; ?></a></li>
                    <li><a class="nav-link scrollto" href="./#about"><?= $language["header_about"]; ?></a></li>
                    <li><a class="nav-link scrollto" href="./#services"><?= $language["header_service"]; ?></a></li>
                    <li><a class="nav-link scrollto " href="./#security"><?= $language["header_security"]; ?></a></li>
                    <li><a class="nav-link scrollto " href="./#team"><?= $language["header_team"]; ?></a></li>
                    <li><a class="nav-link scrollto " href="./#customized"><?= $language["header_customized"]; ?></a></li>
                    <li><a class="nav-link scrollto" href="./#contact"><?= $language["header_contact"]; ?></a></li>

                    <? if(strpos($_SERVER['REQUEST_URI'], "/login") === false) { ?>
                        <li class="login"><a class="nav-link scrollto" href="login"><?= $language["header_login"]; ?></a></li>
                    <?php
                    }
                    
                    $langStr = "English";
                    if (isset($_COOKIE['lang']) && $_COOKIE['lang'] == "tc") {
                        $langStr = "繁體中文";
                    } else if (isset($_COOKIE['lang']) && $_COOKIE['lang'] == "sc") {
                        $langStr = "简体中文";
                    }
                    ?>
                    <li class="dropdown"><a>
                            <div><i class="bx bx-globe" style="font-size: 16px;"></i>&nbsp;&nbsp;<span><?= $langStr; ?></span></div><i class="bi bi-chevron-down"></i>
                        </a>
                        <ul>
                            <li><a href="?lang=en">English</a></li>
                            <li><a href="?lang=tc">繁體中文</a></li>
                            <li><a href="?lang=sc">简体中文</a></li>
                        </ul>
                    </li>
                </ul>
                <? if(strpos($_SERVER['REQUEST_URI'], "/login") === false) { ?>
                    <a href="login" class="btn-login"><?= $language["header_login"]; ?></a>
                <? } ?>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
        </div>
    </header>