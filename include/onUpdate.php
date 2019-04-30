<?php

use XoopsModules\Tad_meeting\Update;

function xoops_module_update_tad_meeting($module, $old_version)
{
    global $xoopsDB;

    //新增檔案欄位
    if (Update::chk_fc_tag()) {
        Update::go_fc_tag();
    }

    return true;
}
