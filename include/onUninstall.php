<?php
function xoops_module_uninstall_tad_meeting($module)
{
    global $xoopsDB;
    $date = date('Ymd');

    rename(XOOPS_ROOT_PATH . '/uploads/tad_meeting', XOOPS_ROOT_PATH . "/uploads/tad_meeting_bak_{$date}");

    return true;
}
