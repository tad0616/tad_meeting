<?php
use Xmf\Request;
use XoopsModules\Tadtools\Utility;
require dirname(dirname(dirname(__DIR__))) . '/include/cp_header.php';
// 關閉除錯訊息
header('HTTP/1.1 200 OK');
$xoopsLogger->activated = false;
$sn = Request::getInt('tad_meeting_cate_sn');
$sort = Request::getInt('sort');

$sql = 'UPDATE `' . $xoopsDB->prefix('tad_meeting_cate') . '` SET `tad_meeting_cate_sort`=? WHERE `tad_meeting_cate_sn`=?';
Utility::query($sql, 'ii', [$sort, $sn]) or die(_TAD_SORT_FAIL . ' (' . date('Y-m-d H:i:s') . ')');

echo _TAD_SORTED . ' (' . date('Y-m-d H:i:s') . ') ';
