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
 * @copyright  The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license    http://www.fsf.org/copyleft/gpl.html GNU public license
 * @package    Tad Meeting
 * @since      2.5
 * @author     tad
 * @version    $Id $
 **/

include_once XOOPS_ROOT_PATH . '/modules/tadtools/language/' . $xoopsConfig['language'] . '/modinfo_common.php';

define('_MI_TADMEETIN_NAME', 'conferencing system');
define('_MI_TADMEETIN_AUTHOR', 'conference system');
define('_MI_TADMEETIN_CREDITS', '');
define('_MI_TADMEETIN_DESC', 'online assembly of meeting records and generate reports');
define('_MI_TADMEETIN_AUTHOR_WEB', 'Tad textbook');
define('_MI_TADMEETIN_ADMENU1', 'main manager interface');
define('_MI_TADMEETIN_ADMENU1_DESC', 'main manager interface');
define('_MI_TADMEETIN_SMNAME2', 'group reports');

define('_MI_TAD_MEETING_SHOW1_BLOCK_NAME', 'recent meeting');
define('_MI_TAD_MEETING_SHOW1_BLOCK_DESC', 'Recent Meeting Block (tad_meeting_show1)');

define('_MI_TADMEETIN_GROUPPERM', 'Detail permission');
define('_MI_TADMEETIN_GROUPPERM_DESC', 'Detail permission');

define('_MI_TADMEETIN_MEETING_PLACE', 'meeting place');
define('_MI_TADMEETIN_MEETING_PLACE_DESC', 'Please use the lowercase semicolon ";" to separate the option');
define('_MI_TADMEETIN_MEETING_PLACE_DEFAULT', 'office; audiovisual classroom; multifunctional classroom; restaurant');

define('_MI_TADMEETIN_MEETING_UNIT', 'room settings');
define('_MI_TADMEETIN_MEETING_UNIT_DESC', 'Please use the lowercase semicolon ";" to separate the option');
define('_MI_TADMEETIN_MEETING_UNIT_DEFAULT', 'principals room; teaching office; general affairs office; kindergarten; personnel room; accounting room');

define('_MI_TADMEETIN_MEETING_JOB', 'job setting');
define('_MI_TADMEETIN_MEETING_JOB_DESC', 'Please use the lowercase semicolon ";" to separate the option');
define('_MI_TADMEETIN_MEETING_JOB_DEFAULT', 'Principals; teaching director; branch director; education group; network management; Nursing division; General affairs officer; Officer; Personnel Director; Accounting Officer');

define('_MI_TADMEETIN_FILE_TITLE', 'default meeting record file title');
define('_MI_TADMEETIN_FILE_TITLE_DESC', 'for generating file title and file name');
define('_MI_TADMEETIN_FILE_TITLE_DEFAULT', 'OO City OO National Primary School OO Academic Year O');
