<?php
use Xmf\Request;
use XoopsModules\Tadtools\Utility;
require_once dirname(dirname(__DIR__)) . '/mainfile.php';

// 關閉除錯訊息
$xoopsLogger->activated = false;

$tad_meeting_cate_sn = Request::getInt('tad_meeting_cate_sn');
$sort_meeting = Utility::power_chk('sort_meeting', $tad_meeting_cate_sn);
if ($sort_meeting) {
    $sort = 1;
    foreach ($_POST['tr'] as $tad_meeting_data_sn) {

        $tad_meeting_data_sn = (int) $tad_meeting_data_sn;

        $sql = 'UPDATE `' . $xoopsDB->prefix('tad_meeting_data') . '` SET `tad_meeting_data_sort`=? WHERE `tad_meeting_data_sn`=?';
        Utility::query($sql, 'ii', [$sort, $tad_meeting_data_sn]) or die(_TAD_SORT_FAIL . ' (' . date('Y-m-d H:i:s') . ')');

        $sort++;
    }
    echo _TAD_SORTED . ' (' . date('Y-m-d H:i:s') . ')';
}
