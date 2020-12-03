<?php
use XoopsModules\Tadtools\Utility;
/*-----------引入檔案區--------------*/
$GLOBALS['xoopsOption']['template_main'] = 'tad_meeting_adm_groupperm.tpl';
require_once __DIR__ . '/header.php';
require_once dirname(__DIR__) . '/function.php';
require_once XOOPS_ROOT_PATH . '/Frameworks/art/functions.php';
require_once XOOPS_ROOT_PATH . '/Frameworks/art/functions.admin.php';
require_once XOOPS_ROOT_PATH . '/class/xoopsform/grouppermform.php';

/*-----------function區--------------*/
$module_id = $xoopsModule->mid();

Utility::get_jquery(true);

//抓取所有資料夾

$item_list = [];
$sql = 'SELECT `tad_meeting_cate_sn`, `tad_meeting_cate_title` FROM ' . $xoopsDB->prefix('tad_meeting_cate');
$result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'], 3, _MA_TADUP_DB_ERROR1);
while (list($tad_meeting_cate_sn, $tad_meeting_cate_title) = $xoopsDB->fetchRow($result)) {
    $item_list[$tad_meeting_cate_sn] = $tad_meeting_cate_title;
}

$perm_desc = '';
$formi = new \XoopsGroupPermForm('', $module_id, 'view_meeting', $perm_desc);
foreach ($item_list as $item_id => $item_name) {
    $formi->addItem($item_id, $item_name);
}

$main1 = $formi->render();
$xoopsTpl->assign('main1', $main1);

$formi = new \XoopsGroupPermForm('', $module_id, 'post_meeting', $perm_desc);
foreach ($item_list as $item_id => $item_name) {
    $formi->addItem($item_id, $item_name);
}

$main2 = $formi->render();
$xoopsTpl->assign('main2', $main2);
$xoopsTpl->assign('now_op', 'power');

$xoTheme->addStylesheet(XOOPS_URL . "/modules/tadtools/css/xoops_adm{$_SESSION['bootstrap']}.css");
$xoTheme->addStylesheet(XOOPS_URL . '/modules/tadtools/css/font-awesome/css/font-awesome.css');
require_once __DIR__ . '/footer.php';
