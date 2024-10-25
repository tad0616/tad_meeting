<?php
use XoopsModules\Tadtools\EasyResponsiveTabs;
use XoopsModules\Tadtools\Utility;
/*-----------引入檔案區--------------*/
$GLOBALS['xoopsOption']['template_main'] = 'tad_meeting_power.tpl';
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
$sql = 'SELECT `tad_meeting_cate_sn`, `tad_meeting_cate_title` FROM `' . $xoopsDB->prefix('tad_meeting_cate') . '`';
$result = Utility::query($sql) or redirect_header($_SERVER['PHP_SELF'], 3, _MA_TADUP_DB_ERROR1);
while (list($tad_meeting_cate_sn, $tad_meeting_cate_title) = $xoopsDB->fetchRow($result)) {
    $item_list[$tad_meeting_cate_sn] = $tad_meeting_cate_title;
}

$permission_kind['create_meeting'] = _MA_TADMEETIN_CAN_CREATE;
$permission_kind['post_meeting'] = _MA_TADMEETIN_CAN_POST;
$permission_kind['view_meeting'] = _MA_TADMEETIN_CAN_ACCESS;
$permission_kind['sort_meeting'] = _MA_TADMEETIN_CAN_SORT;

$permission['create_meeting'] = _MA_TADMEETIN_CAN_CREATE_CATE;
$permission['post_meeting'] = _MA_TADMEETIN_CAN_POST_CATE;
$permission['view_meeting'] = _MA_TADMEETIN_CAN_ACCESS_CATE;
$permission['sort_meeting'] = _MA_TADMEETIN_CAN_SORT_CATE;

$EasyResponsiveTabs = new EasyResponsiveTabs('#grouppermformTab', 'default');
$EasyResponsiveTabs->rander();

foreach ($permission as $item => $perm_desc) {
    $formi = new \XoopsGroupPermForm('', $module_id, $item, $perm_desc);
    foreach ($item_list as $item_id => $item_name) {
        $formi->addItem($item_id, $item_name);
    }
    $title[$item] = $permission_kind[$item];
    $form[$item] = $formi->render();
}

$xoopsTpl->assign('now_op', 'power');
$xoopsTpl->assign('title', $title);
$xoopsTpl->assign('form', $form);

require_once __DIR__ . '/footer.php';
