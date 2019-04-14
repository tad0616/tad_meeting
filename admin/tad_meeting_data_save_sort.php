<?php
require dirname(dirname(dirname(__DIR__))) . '/include/cp_header.php';

$sort = 1;
foreach ($_POST['tr'] as $tad_meeting_data_sn) {
    $sql = 'update ' . $xoopsDB->prefix('tad_meeting_data') . " set `tad_meeting_data_sort`='{$sort}' where `tad_meeting_data_sn`='{$tad_meeting_data_sn}'";
    $xoopsDB->queryF($sql) or die(_TAD_SORT_FAIL . ' (' . date('Y-m-d H:i:s') . ')');
    $sort++;
}
echo 'Sort saved! (' . date('Y-m-d H:i:s') . ')';
