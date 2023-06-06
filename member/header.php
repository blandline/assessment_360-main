<? 
  include_once "../classes/Constant.php";
  if(isset($_GET['lang'])) {
    $lang = in_array($_GET['lang'], $ACCEPT_LANG) ? $_GET['lang'] : '';
    if($lang != "") {
      $_COOKIE['lang'] = $lang;
      setcookie("lang", $lang, 2147483647, "/");
    }
  }

  if(!isset($_COOKIE['lang'])){
    $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    $lang = in_array($lang, $ACCEPT_LANG) ? $lang : 'en';
    $_COOKIE['lang'] = $lang;
    setcookie("lang", $lang, 2147483647, "/");
  }
  include_once "../lang/". $_COOKIE['lang'].".php";
?>

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
  <link href="../assets/css/style.css?v=<?=$cssVersion;?>" rel="stylesheet">
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