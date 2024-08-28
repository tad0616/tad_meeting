<?php

use XoopsModules\Tad_meeting\Update;
if (!class_exists('XoopsModules\Tad_meeting\Update')) {
    include dirname(__DIR__) . '/preloads/autoloader.php';
}
function xoops_module_update_tad_meeting($module, $old_version)
{
    Utility::mk_dir(XOOPS_ROOT_PATH . '/uploads/tad_meeting');
    Utility::mk_dir(XOOPS_ROOT_PATH . '/uploads/tad_meeting/file');
    Utility::mk_dir(XOOPS_ROOT_PATH . '/uploads/tad_meeting/tmp');
    Utility::mk_dir(XOOPS_ROOT_PATH . '/uploads/tad_meeting/image');
    Utility::mk_dir(XOOPS_ROOT_PATH . '/uploads/tad_meeting/image/.thumbs');

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
