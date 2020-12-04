<?php
use XoopsModules\Tadtools\Utility;
require_once dirname(dirname(__DIR__)) . '/mainfile.php';

$sort_meeting = Utility::power_chk('sort_meeting', 4);
if ($sort_meeting) {
    $sort = 1;
    foreach ($_POST['tr'] as $tad_meeting_data_sn) {

        $tad_meeting_data_sn = (int) $tad_meeting_data_sn;

        $sql = 'update ' . $xoopsDB->prefix('tad_meeting_data') . " set `tad_meeting_data_sort`='{$sort}' where `tad_meeting_data_sn`='{$tad_meeting_data_sn}'";
        $xoopsDB->queryF($sql) or die(_TAD_SORT_FAIL . ' (' . date('Y-m-d H:i:s') . ')');
        $sort++;
        echo "<div>$sql</div>";
    }
    echo 'Sort saved! (' . date('Y-m-d H:i:s') . ')';
}
