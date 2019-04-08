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

include_once "../../tadtools/language/{$xoopsConfig['language']}/admin_common.php";
define('_TAD_NEED_TADTOOLS', '需要 tadtools 模組，可至<a href="http://campus-xoops.tn.edu.tw/modules/tad_modules/index.php?module_sn=1" target="_blank">XOOPS輕鬆架</a>下載。');

//tad_meeting-edit
//define('_MD_TADMEETIN_TAD_MEETING_TITLE', '會議名稱');
//define('_MD_TADMEETIN_TAD_MEETING_CATE_SN', '分類編號');
//define('_MD_TADMEETIN_TAD_MEETING_DATETIME', '開會日期');
//define('_MD_TADMEETIN_TAD_MEETING_PLACE', '會議地點');
//define('_MD_TADMEETIN_TAD_MEETING_CHAIRMAN', '會議主席');
//define('_MD_TADMEETIN_TAD_MEETING_SN', '會議編號');
//define('_MD_TADMEETIN_TAD_MEETING_NOTE', '相關補充說明');
//define('_MD_TADMEETIN_TAD_MEETING_CATE_TITLE', '分類標題');
//define('_MD_TADMEETIN_TAD_MEETING_CATE_DESC', '分類說明');
//define('_MD_TADMEETIN_TAD_MEETING_CATE_SORT', '分類排序');
//define('_MD_TADMEETIN_TAD_MEETING_CATE_ENABLE', '狀態');
//
//define('_MA_TADMEETIN_PERM_TITLE', '會議系統細部權限設定');
//define('_MA_TADMEETIN_PERM_DESC', '請勾選欲開放給群組使用的權限：');
//define('_MA_TADMEETIN_CREATE_MEETING', '建立會議');
//define('_MA_TADMEETIN_ADD_REPORT', '填寫會議內容');
//define('_MA_TADMEETIN_READ_REPORT', '觀看會議內容');
//define('_MA_TADMEETIN_SORT_REPORT', '排序會議內容');


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
