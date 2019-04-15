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
xoops_loadLanguage('modinfo_common', 'tadtools');

define('_MI_TADMEETIN_NAME', 'Conferencing system');
define('_MI_TADMEETIN_AUTHOR', 'Conference system');
define('_MI_TADMEETIN_CREDITS', '');
define('_MI_TADMEETIN_DESC', 'Online assembly of meeting records and generate reports');
define('_MI_TADMEETIN_AUTHOR_WEB', 'Tad textbook');
define('_MI_TADMEETIN_ADMENU1', 'Manager');
define('_MI_TADMEETIN_ADMENU1_DESC', 'Main Manager GUI');
define('_MI_TADMEETIN_SMNAME2', 'Group reports');

define('_MI_TAD_MEETING_SHOW1_BLOCK_NAME', 'Recent meeting');
define('_MI_TAD_MEETING_SHOW1_BLOCK_DESC', 'Recent Meeting Block (tad_meeting_show1)');

define('_MI_TADMEETIN_GROUPPERM', 'Permissions');
define('_MI_TADMEETIN_GROUPPERM_DESC', 'Detail permission');

define('_MI_TADMEETIN_MEETING_PLACE', 'Meeting place');
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

define('_MI_TADMEETIN_ORDERBY', 'Meeting Content Sorter');
define('_MI_TADMEETIN_ORDERBY_DESC', 'will be used on all reports and pages');
define('_MI_TADMEETIN_ORDERBY_OPT1', 'Auto-sort (based on the order of office settings)');
define('_MI_TADMEETIN_ORDERBY_OPT2', 'Custom Ordering');
