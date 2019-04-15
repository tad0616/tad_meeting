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
xoops_loadLanguage('admin_common', 'tadtools');
define('_TAD_NEED_TADTOOLS', 'This module needs TadTools module. You can download TadTools from <a href="http://www.tad0616.net/modules/tad_uploader/index.php?of_cat_sn=50" target="_blank">Tad Textbook </a>. ');

//tad_meeting-edit
define('_MD_TADMEETIN_TAD_MEETING_TITLE', 'Meeting name');
define('_MD_TADMEETIN_TAD_MEETING_CATE_SN', 'Classification number');
define('_MD_TADMEETIN_TAD_MEETING_DATETIME', 'Meeting date');
define('_MD_TADMEETIN_TAD_MEETING_PLACE', 'Meeting place');
define('_MD_TADMEETIN_TAD_MEETING_CHAIRMAN', 'Meeting chair');
define('_MD_TADMEETIN_TAD_MEETING_SN', 'Meeting number');
define('_MD_TADMEETIN_TAD_MEETING_NOTE', 'Related Supplement');
define('_MD_TADMEETIN_TAD_MEETING_CATE_TITLE', 'Category title');
define('_MD_TADMEETIN_TAD_MEETING_CATE_DESC', 'Classification instructions');
define('_MD_TADMEETIN_TAD_MEETING_CATE_SORT', 'Sort order');
define('_MD_TADMEETIN_TAD_MEETING_CATE_ENABLE', 'State');

define('_MA_TADMEETIN_PERM_TITLE', 'Detail permission');
define('_MA_TADMEETIN_PERM_DESC', 'Check the permissions you want to open to the group:');
define('_MA_TADMEETIN_CREATE_MEETING', 'Create a meeting');
define('_MA_TADMEETIN_ADD_REPORT', 'Fill in meeting content');
define('_MA_TADMEETIN_READ_REPORT', 'Watch meeting content');
define('_MA_TADMEETIN_SORT_REPORT', 'Sort meeting content');
