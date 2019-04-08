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

include_once "../../tadtools/language/{$xoopsConfig['language']}/admin_common.php";
define('_TAD_NEED_TADTOOLS', 'This module needs TadTools module. You can download TadTools from <a href="http://www.tad0616.net/modules/tad_uploader/index.php?of_cat_sn=50" target="_blank">Tad Textbook </a>. ');

//tad_meeting-edit
define('_MD_TADMEETIN_TAD_MEETING_TITLE', 'meeting name');
define('_MD_TADMEETIN_TAD_MEETING_CATE_SN', 'classification number');
define('_MD_TADMEETIN_TAD_MEETING_DATETIME', 'meeting date');
define('_MD_TADMEETIN_TAD_MEETING_PLACE', 'meeting place');
define('_MD_TADMEETIN_TAD_MEETING_CHAIRMAN', 'meeting chair');
define('_MD_TADMEETIN_TAD_MEETING_SN', 'meeting number');
define('_MD_TADMEETIN_TAD_MEETING_NOTE', 'Related Supplement');
define('_MD_TADMEETIN_TAD_MEETING_CATE_TITLE', 'category title');
define('_MD_TADMEETIN_TAD_MEETING_CATE_DESC', 'classification instructions');
define('_MD_TADMEETIN_TAD_MEETING_CATE_SORT', 'sort order');
define('_MD_TADMEETIN_TAD_MEETING_CATE_ENABLE', 'state');

define('_MA_TADMEETIN_PERM_TITLE', 'meeting system detail permission');
define('_MA_TADMEETIN_PERM_DESC', 'check the permissions you want to open to the group:');
define('_MA_TADMEETIN_CREATE_MEETING', 'build a meeting');
define('_MA_TADMEETIN_ADD_REPORT', 'fill in meeting content');
define('_MA_TADMEETIN_READ_REPORT', 'watch meeting content');
define('_MA_TADMEETIN_SORT_REPORT', 'sort meeting content');
