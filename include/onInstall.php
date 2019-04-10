<?php
/**
 * Tad Meeting module
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright  XOOPS Project (https://xoops.org)
 * @license    http://www.fsf.org/copyleft/gpl.html GNU public license
 * @package    Tad Meeting
 * @since      2.5
 * @author     tad
 * @version    $Id $
 **/


function xoops_module_install_tad_meeting(&$module)
{

    tad_meeting_mk_dir(XOOPS_ROOT_PATH . "/uploads/tad_meeting");
    tad_meeting_mk_dir(XOOPS_ROOT_PATH . "/uploads/tad_meeting/file");
    tad_meeting_mk_dir(XOOPS_ROOT_PATH . "/uploads/tad_meeting/image");
    tad_meeting_mk_dir(XOOPS_ROOT_PATH . "/uploads/tad_meeting/image/.thumbs");

    return true;
}

//建立目錄
function tad_meeting_mk_dir($dir = "")
{
    //若無目錄名稱秀出警告訊息
    if (empty($dir)) {
        return;
    }

    //若目錄不存在的話建立目錄
    if (!is_dir($dir)) {
        umask(000);
        //若建立失敗秀出警告訊息
        mkdir($dir, 0777);
    }
}
