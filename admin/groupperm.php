<?php
/*-----------引入檔案區--------------*/
$xoopsOption['template_main'] = "tad_meeting_adm_groupperm.tpl";
include_once "header.php";
include_once "../function.php";
include_once XOOPS_ROOT_PATH . "/Frameworks/art/functions.php";
include_once XOOPS_ROOT_PATH . "/Frameworks/art/functions.admin.php";
include_once XOOPS_ROOT_PATH . '/class/xoopsform/grouppermform.php';

//取得本模組編號
$module_id = $xoopsModule->getVar('mid');

//頁面標題
$perm_page_title = _MA_TADMEETIN_PERM_TITLE;

//取得分類編號及標題
//權限項目陣列（編號超級重要！設定後，以後切勿隨便亂改。）
$item_list = array(
    '1' => _MA_TADMEETIN_CREATE_MEETING,
    '2' => _MA_TADMEETIN_ADD_REPORT,
    '3' => _MA_TADMEETIN_READ_REPORT,
    '4' => _MA_TADMEETIN_SORT_REPORT,
);

//頁面標題
$perm_page_title = _MA_TADMEETIN_PERM_TITLE;

//權限名稱（請設定一個英文名稱，一般用模組名稱即可）
$perm_name = 'tad_meeting';

//權限描述
$perm_desc = _MA_TADMEETIN_PERM_DESC;

//建立XOOPS權限表單
$formi = new XoopsGroupPermForm($perm_page_title, $module_id, $perm_name, $perm_desc);

//將權限項目設進表單中
foreach ($item_list as $item_id => $item_name) {
    $formi->addItem($item_id, $item_name);
}

echo $formi->render();
include_once 'footer.php';
