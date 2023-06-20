<div class="sidebar" data-color="danger" data-background-color="white">
  <div class="logo">
    <?= $login->getCompanyLogo(); ?>
    <div class="sidebar-displayName"><?= $language["leftmenu_hello"]; ?> <?= $login->getDisplayName(); ?></div>
  </div>
  <div class="sidebar-wrapper" id="leftmenubar">
    <ul class="nav">

      <?
      $isShowAssess360 = !empty(@$_SESSION[$session_admin]) || (in_array($PACKAGE_ASSESS_360, $_SESSION[$session_package]) && $login->checkUserPermission($PERMISSION_ASSESS360_VIEW));
      if ($isShowAssess360) {
        $isViewAssess360 = isset($_SESSION[$session_page]) && $_SESSION[$session_page] == $SESSION_PAGE_ASSESS_360;

        $isShowRaterForm = !empty(@$_SESSION[$session_admin]) || (in_array($PACKAGE_ASSESS_360, $_SESSION[$session_package]) && $login->checkUserPermission($PERMISSION_ASSESS360_VIEW));
        if ($isShowRaterForm) {
          $isViewRaterForm = isset($_SESSION[$session_page]) && $_SESSION[$session_page] == $SESSION_PAGE_LIST_OF_RATERS_RATERFORM;
        }

        $isShowDataCenter = !empty(@$_SESSION[$session_admin]) || (in_array($PACKAGE_ASSESS_360, $_SESSION[$session_package]) && $login->checkUserPermission($PERMISSION_ASSESS360_VIEW));
        if ($isShowDataCenter) {
          $isViewDataCenter = isset($_SESSION[$session_page]) && $_SESSION[$session_page] == $SESSION_PAGE_LIST_OF_RATERS_DATA_CENTER;
        }

        $isShowCompetencySelection = !empty(@$_SESSION[$session_admin]) || (in_array($PACKAGE_ASSESS_360, $_SESSION[$session_package]) && $login->checkUserPermission($PERMISSION_ASSESS360_VIEW));
        if ($isShowCompetencySelection) {
          $isViewCompetencySelection = isset($_SESSION[$session_page]) && $_SESSION[$session_page] == $SESSION_PAGE_COMPETENCY_SELECTION;
        }

        $isShowFocusCompetency = !empty(@$_SESSION[$session_admin]) || (in_array($PACKAGE_ASSESS_360, $_SESSION[$session_package]) && $login->checkUserPermission($PERMISSION_ASSESS360_VIEW));
        if ($isShowFocusCompetency) {
          $isViewFocusCompetency = isset($_SESSION[$session_page]) && $_SESSION[$session_page] == $SESSION_PAGE_COMPETENCY_FOCUS_COMPETENCY;
        }
      ?>

        <li class="nav-item">
          <a class="nav-link <?= $isViewAssess360 ? '' : 'collapsed'; ?><? if ($isViewRaterForm || $isViewDataCenter || $isViewCompetencySelection || $isViewFocusCompetency) echo "leftMenuActive"; ?>" href="./assess360" data-toggle="collapse" data-target="#collapseConfig" aria-expanded="<?= $isViewAssess360 ? 'false' : 'true'; ?>" aria-controls="collapseConfig">
            <i class="material-icons">check_circle</i>
            <span><?= $language["leftmenu_assessment360"]; ?></span>
          </a>
          <div id="collapseConfig" class="collapse <?= ($isViewRaterForm || $isViewDataCenter || $isViewCompetencySelection || $isViewFocusCompetency) ? 'show' : ''; ?>">
            <div class="bg-white py-2 collapse-inner rounded collapse-item-div">
              <ul class="nav sub-nav">
                <li class="nav-item">
                  <a class="nav-link <?= ($isViewRaterForm || $isViewDataCenter) ? '' : 'collapsed'; ?>" href="#" data-toggle="collapse" data-target="#collapseRaterList" aria-expanded="<?= ($isViewRaterForm || $isViewDataCenter) ? 'false' : 'true'; ?>" aria-controls="collapseCompany">
                    <span><?= $language["leftmenu_list_of_raters"] ?></span>
                  </a>

                  <div id="collapseRaterList" class="collapse <?= ($isViewRaterForm || $isViewDataCenter) ? 'show' : ''; ?>">
                    <div class="bg-white py-2 collapse-inner rounded collapse-item-div sub-sub-nav">
                      <a class="collapse-item <? if ($isViewRaterForm) echo "leftMenuActive"; ?>" href="./assess360?a=listofraters">
                        <p><span style="font-weight:100;">•</span>&nbsp;&nbsp;&nbsp;<?= $language["leftmenu_list_of_raters_rater_form"]; ?></p>
                      </a>
                    </div>
                    <div class="bg-white py-2 collapse-inner rounded collapse-item-div sub-sub-nav">
                      <a class="collapse-item <? if ($isViewDataCenter) echo "leftMenuActive"; ?>" href="./assess360?a=datacenter">
                        <p><span style="font-weight:100;">•</span>&nbsp;&nbsp;&nbsp;<?= $language["leftmenu_list_of_raters_data_center"]; ?></p>
                      </a>
                    </div>
                  </div>
                </li>

                <li class="nav-item">
                  <a class="nav-link <?= ($isViewCompetencySelection || $isViewFocusCompetency) ? '' : 'collapsed'; ?>" href="#" data-toggle="collapse" data-target="#collapseCompetency" aria-expanded="<?= ($isViewCompetencySelection || $isViewFocusCompetency) ? 'false' : 'true'; ?>" aria-controls="collapseCompany">
                    <span><?= $language["leftmenu_competency"] ?></span>
                  </a>

                  <div id="collapseCompetency" class="collapse <?= ($isViewCompetencySelection || $isViewFocusCompetency) ? 'show' : ''; ?>">
                    <div class="bg-white py-2 collapse-inner rounded collapse-item-div sub-sub-nav">
                      <a class="collapse-item <? if ($isViewCompetencySelection) echo "leftMenuActive"; ?>" href="./assess360?a=competency">
                        <p><span style="font-weight:100;">•</span>&nbsp;&nbsp;&nbsp;<?= $language["leftmenu_competency_selection"]; ?></p>
                      </a>
                    </div>
                    <div class="bg-white py-2 collapse-inner rounded collapse-item-div sub-sub-nav">
                      <a class="collapse-item <? if ($isViewFocusCompetency) echo "leftMenuActive"; ?>" href="./assess360?a=focuscompetency">
                        <p><span style="font-weight:100;">•</span>&nbsp;&nbsp;&nbsp;<?= $language["leftmenu_competency_focus_competency"]; ?></p>
                      </a>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
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