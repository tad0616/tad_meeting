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

//define('_MI_TADMEETIN_NAME', '會議系統');
//define('_MI_TADMEETIN_AUTHOR', '會議系統');
//define('_MI_TADMEETIN_CREDITS', '');
//define('_MI_TADMEETIN_DESC', '線上彙整會議記錄並產生報表');
//define('_MI_TADMEETIN_AUTHOR_WEB', 'Tad 教材網');
//define('_MI_TADMEETIN_ADMENU1', '主管理介面');
//define('_MI_TADMEETIN_ADMENU1_DESC', '主管理介面');
//define('_MI_TADMEETIN_SMNAME2', '各組報告');
//
//define('_MI_TAD_MEETING_SHOW1_BLOCK_NAME', '近期會議');
//define('_MI_TAD_MEETING_SHOW1_BLOCK_DESC', '近期會議區塊 (tad_meeting_show1)');
//
//define('_MI_TADMEETIN_GROUPPERM', '細部權限設定');
//define('_MI_TADMEETIN_GROUPPERM_DESC', '細部權限設定');
//
//define('_MI_TADMEETIN_MEETING_PLACE', '會議地點');
//define('_MI_TADMEETIN_MEETING_PLACE_DESC', '請用小寫分號「;」隔開選項');
//define('_MI_TADMEETIN_MEETING_PLACE_DEFAULT', '辦公室;視聽教室;多功能教室;餐廳');
//
//define('_MI_TADMEETIN_MEETING_UNIT', '處室設定');
//define('_MI_TADMEETIN_MEETING_UNIT_DESC', '請用小寫分號「;」隔開選項');
//define('_MI_TADMEETIN_MEETING_UNIT_DEFAULT', '校長室;教導處;總務處;幼兒園;人事室;會計室');
//
//define('_MI_TADMEETIN_MEETING_JOB', '職務設定');
//define('_MI_TADMEETIN_MEETING_JOB_DESC', '請用小寫分號「;」隔開選項');
//define('_MI_TADMEETIN_MEETING_JOB_DEFAULT', '校長;教導主任;分校主任;教務組;網管;學務組;護理師;總務主任;事務組;幹事;園主任;人事主任;會計主任');
//
//define('_MI_TADMEETIN_FILE_TITLE', '預設會議記錄檔案標題');
//define('_MI_TADMEETIN_FILE_TITLE_DESC', '用於產生文件標題及檔名');
//define('_MI_TADMEETIN_FILE_TITLE_DEFAULT', 'OO市立OO國民小學OO學年度第O學期');


define('_MI_TADMEETIN_NAME', 'conference system');
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
define('_MI_TADMEETIN_MEETING_JOB_DEFAULT', 'headmaster; teaching director; school director; education group; network management; management group; nursing division; general affairs director; affairs group; officer; park director; personnel director');

define('_MI_TADMEETIN_FILE_TITLE', 'default meeting record file title');
define('_MI_TADMEETIN_FILE_TITLE_DESC', 'for generating file title and file name');
define('_MI_TADMEETIN_FILE_TITLE_DEFAULT', 'OO City OO National Primary School OO Academic Year O');
