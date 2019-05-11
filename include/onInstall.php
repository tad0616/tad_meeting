<?php
use XoopsModules\Tadtools\Utility;
if (!class_exists('XoopsModules\Tadtools\Utility')) {
    require XOOPS_ROOT_PATH . '/modules/tadtools/preloads/autoloader.php';
}


function xoops_module_install_tad_meeting(&$module)
{
    Utility::mk_dir(XOOPS_ROOT_PATH . '/uploads/tad_meeting');
    Utility::mk_dir(XOOPS_ROOT_PATH . '/uploads/tad_meeting/file');
    Utility::mk_dir(XOOPS_ROOT_PATH . '/uploads/tad_meeting/image');
    Utility::mk_dir(XOOPS_ROOT_PATH . '/uploads/tad_meeting/image/.thumbs');

    return true;
}
