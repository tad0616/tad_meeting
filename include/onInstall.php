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
use XoopsModules\Tad_meeting\Utility;

include dirname(__DIR__) . '/preloads/autoloader.php';

function xoops_module_install_tad_meeting(&$module)
{
    Utility::mk_dir(XOOPS_ROOT_PATH . '/uploads/tad_meeting');
    Utility::mk_dir(XOOPS_ROOT_PATH . '/uploads/tad_meeting/file');
    Utility::mk_dir(XOOPS_ROOT_PATH . '/uploads/tad_meeting/image');
    Utility::mk_dir(XOOPS_ROOT_PATH . '/uploads/tad_meeting/image/.thumbs');

    return true;
}
