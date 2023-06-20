<div class="sidebar" data-color="danger" data-background-color="white">
  <div class="logo">
    <?= $login->getCompanyLogo(); ?>
    <div class="sidebar-displayName"><?= $language["leftmenu_hello"]; ?> <?= $login->getDisplayName(); ?></div>
  </div>
  <div class="sidebar-wrapper" id="leftmenubar">
    <ul class="nav">


      <?
      $isShowListOfRaters = !empty(@$_SESSION[$session_admin]) || (in_array($PACKAGE_ASSESS_360, $_SESSION[$session_package]) && $login->checkUserPermission($PERMISSION_ASSESS360_VIEW));
      if ($isShowListOfRaters) {
        $isViewListOfRaters = isset($_SESSION[$session_page]) && $_SESSION[$session_page] == $SESSION_PAGE_LIST_OF_RATERS;
      ?>

        <li class="nav-item <? if ($isViewListOfRaters) echo "leftMenuActive"; ?>">
          <a class="nav-link" href="./assess360?a=listofraters">
            <i class="material-icons">check_circle</i>
            <p><?= $language["leftmenu_list_of_raters"]; ?></p>
          </a>
        </li>
      <? } ?>

     


      <?
      $isShowAssess360 = !empty(@$_SESSION[$session_admin]) || (in_array($PACKAGE_ASSESS_360, $_SESSION[$session_package]) && $login->checkUserPermission($PERMISSION_ASSESS360_VIEW));
      if ($isShowAssess360) {
        $isViewAssess360 = isset($_SESSION[$session_page]) && $_SESSION[$session_page] == $SESSION_PAGE_ASSESS_360;
      ?>
        <li class="nav-item <? if ($isViewAssess360) echo "leftMenuActive"; ?>">
          <a class="nav-link" href="./assess360?a=assess360">
            <i class="material-icons">check_circle</i>
            <p><?= $language["leftmenu_assessment360"]; ?></p>
          </a>
        </li>
      <? } ?>



      <?
      $isShowCompetency = !empty(@$_SESSION[$session_admin]) || (in_array($PACKAGE_ASSESS_360, $_SESSION[$session_package]) && $login->checkUserPermission($PERMISSION_ASSESS360_VIEW));
      if ($isShowCompetency) {
        $isViewCompetency = isset($_SESSION[$session_page]) && $_SESSION[$session_page] == $SESSION_PAGE_COMPETENCY;
      ?>
        <li class="nav-item <? if ($isViewCompetency) echo "leftMenuActive"; ?>">
          <a class="nav-link" href="./assess360?a=competency">
            <i class="material-icons">check_circle</i>
            <p><?= $language["leftmenu_competencies"]; ?></p>
          </a>
        </li>
      <? } ?>



      <li class="nav-item">
        <a class="nav-link" href="logout">
          <i class="material-icons">directions_run</i>
          <p><?= $language["leftmenu_logout"]; ?></p>
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