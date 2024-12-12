<?php
use XoopsModules\Tadtools\Utility;

require dirname(dirname(dirname(__DIR__))) . '/include/cp_header.php';
// 關閉除錯訊息
header('HTTP/1.1 200 OK');
$xoopsLogger->activated = false;
$of_sn = (int) str_replace('node-_', '', $_POST['tad_meeting_cate_parent_sn']);
$sn = (int) str_replace('node-_', '', $_POST['tad_meeting_cate_sn']);

if ($of_sn == $sn) {
    die(_MA_TREETABLE_MOVE_ERROR1 . '(' . date('Y-m-d H:i:s') . ')');
} elseif (chk_cate_path($sn, $of_sn)) {
    die(_MA_TREETABLE_MOVE_ERROR2 . '(' . date('Y-m-d H:i:s') . ')');
}

$sql = 'UPDATE `' . $xoopsDB->prefix('tad_meeting_cate') . '` SET `tad_meeting_cate_parent_sn`=? WHERE `tad_meeting_cate_sn`=?';
Utility::query($sql, 'ii', [$of_sn, $sn]) or die('Reset Fail! (' . date('Y-m-d H:i:s') . ')');

echo _MA_TREETABLE_MOVE_OK . ' (' . date('Y-m-d H:i:s') . ')';

//檢查目的地編號是否在其子目錄下
function chk_cate_path($sn, $to_sn)
{
    global $xoopsDB;
    //抓出子目錄的編號
    $sql = 'SELECT `tad_meeting_cate_sn` FROM `' . $xoopsDB->prefix('tad_meeting_cate') . '` WHERE `tad_meeting_cate_parent_sn`=?';
    $result = Utility::query($sql, 'i', [$sn]) or Utility::web_error($sql, __FILE__, __LINE__);

    while (list($sub_sn) = $xoopsDB->fetchRow($result)) {
        if (chk_cate_path($sub_sn, $to_sn)) {
            return true;
        }
        if ($sub_sn == $to_sn) {
            return true;
        }
    }

    return false;
}
