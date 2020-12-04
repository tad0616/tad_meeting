<?php

use XoopsModules\Tad_meeting\Update;
if (!class_exists('XoopsModules\Tad_meeting\Update')) {
    include dirname(__DIR__) . '/preloads/autoloader.php';
}
function xoops_module_update_tad_meeting($module, $old_version)
{
    global $xoopsDB;

    //新增檔案欄位
    if (Update::chk_fc_tag()) {
        Update::go_fc_tag();
    }
    //修改權限
    if (Update::chk_permission()) {
        Update::go_permission();
    }

    return true;
}
