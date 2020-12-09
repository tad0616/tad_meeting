<?php
use Xmf\Request;
use XoopsModules\Tadtools\Utility;
require_once dirname(dirname(__DIR__)) . '/mainfile.php';

$tad_meeting_cate_sn = Request::getInt('tad_meeting_cate_sn');
$sort_meeting = Utility::power_chk('sort_meeting', $tad_meeting_cate_sn);
if ($sort_meeting) {
    $sort = 1;
    foreach ($_POST['tr'] as $tad_meeting_data_sn) {

        $tad_meeting_data_sn = (int) $tad_meeting_data_sn;

        $sql = 'update ' . $xoopsDB->prefix('tad_meeting_data') . " set `tad_meeting_data_sort`='{$sort}' where `tad_meeting_data_sn`='{$tad_meeting_data_sn}'";
        $xoopsDB->queryF($sql) or die(_TAD_SORT_FAIL . ' (' . date('Y-m-d H:i:s') . ')');
        $sort++;
    }
    echo 'Sort saved! (' . date('Y-m-d H:i:s') . ')';
}
