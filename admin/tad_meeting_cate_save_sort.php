<?php
use Xmf\Request;
require dirname(dirname(dirname(__DIR__))) . '/include/cp_header.php';

$sn = Request::getInt('tad_meeting_cate_sn');
$sort = Request::getInt('sort');

$sql = 'update `' . $xoopsDB->prefix('tad_meeting_cate') . "` set `tad_meeting_cate_sort`='{$sort}' where `tad_meeting_cate_sn`='{$sn}'";
$xoopsDB->queryF($sql) or die('Save Sort Fail! (' . date('Y-m-d H:i:s') . ')');

echo 'Sort saved! (' . date('Y-m-d H:i:s') . ') ';
