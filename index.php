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

/*-----------引入檔案區--------------*/
include "header.php";
$xoopsOption['template_main'] = 'tad_meeting_index.tpl';
include_once XOOPS_ROOT_PATH . "/header.php";

/*-----------功能函數區--------------*/

//以流水號秀出某筆tad_meeting資料內容
function show_one_tad_meeting($tad_meeting_sn = '', $tad_meeting_data_sn = '')
{
    global $xoopsDB, $xoopsTpl, $isAdmin, $xoopsUser;

    $xoopsTpl->assign('tad_meeting_sn', $tad_meeting_sn);
    $xoopsTpl->assign('tad_meeting_data_sn', $tad_meeting_data_sn);

    //判斷目前使用者是否有：觀看會議內容
    $read_report = power_chk("tad_meeting", 3);
    $xoopsTpl->assign('read_report', $read_report);
    if (!$read_report) {
        redirect_header($_SERVER['PHP_SELF'], 3, _TAD_PERMISSION_DENIED);
    }
    list_tad_meeting_data($tad_meeting_sn);

    //判斷目前使用者是否有：建立會議
    $create_meeting = power_chk("tad_meeting", 1);
    $xoopsTpl->assign('create_meeting', $create_meeting);

    //判斷目前使用者是否有：填寫會議內容
    $add_report = power_chk("tad_meeting", 2);
    $xoopsTpl->assign('add_report', $add_report);

    if ($add_report) {
        tad_meeting_data_form($tad_meeting_sn, $tad_meeting_data_sn);
    }

    //判斷目前使用者是否有：排序會議內容
    $sort_report = power_chk("tad_meeting", 4);
    $xoopsTpl->assign('sort_report', $sort_report);

    if (empty($tad_meeting_sn)) {
        return;
    } else {
        $tad_meeting_sn = (int) $tad_meeting_sn;
    }

    $now_uid = is_object($xoopsUser) ? $xoopsUser->uid() : 0;
    $xoopsTpl->assign('now_uid', $now_uid);

    $myts = MyTextSanitizer::getInstance();

    $sql = "select * from `" . $xoopsDB->prefix("tad_meeting") . "`
    where `tad_meeting_sn` = '{$tad_meeting_sn}' ";
    $result = $xoopsDB->query($sql) or web_error($sql, __FILE__, _LINE__);
    $all    = $xoopsDB->fetchArray($result);

    //以下會產生這些變數： $tad_meeting_sn, $tad_meeting_title, $tad_meeting_cate_sn, $tad_meeting_datetime, $tad_meeting_place, $tad_meeting_chairman, $tad_meeting_note
    foreach ($all as $k => $v) {
        $$k = $v;
    }

    //取得分類資料(tad_meeting_cate)
    $tad_meeting_cate_arr = get_tad_meeting_cate($tad_meeting_cate_sn);

    //過濾讀出的變數值
    $tad_meeting_title    = $myts->htmlSpecialChars($tad_meeting_title);
    $tad_meeting_datetime = $myts->htmlSpecialChars($tad_meeting_datetime);
    $tad_meeting_chairman = $myts->htmlSpecialChars($tad_meeting_chairman);
    $tad_meeting_note     = $myts->displayTarea($tad_meeting_note, 0, 1, 0, 1, 1);

    $xoopsTpl->assign('tad_meeting_title', $tad_meeting_title);
    $xoopsTpl->assign('tad_meeting_cate_sn', $tad_meeting_cate_sn);
    $xoopsTpl->assign('tad_meeting_cate_sn_title', $tad_meeting_cate_arr['tad_meeting_cate_title']);
    $xoopsTpl->assign('tad_meeting_datetime', $tad_meeting_datetime);
    $xoopsTpl->assign('tad_meeting_place', $tad_meeting_place);
    $xoopsTpl->assign('tad_meeting_chairman', $tad_meeting_chairman);
    $xoopsTpl->assign('tad_meeting_note', nl2br($tad_meeting_note));

    if (!file_exists(XOOPS_ROOT_PATH . "/modules/tadtools/sweet_alert.php")) {
        redirect_header("index.php", 3, _MA_NEED_TADTOOLS);
    }

    include_once XOOPS_ROOT_PATH . "/modules/tadtools/sweet_alert.php";
    $sweet_alert_obj         = new sweet_alert();
    $delete_tad_meeting_func = $sweet_alert_obj->render('delete_tad_meeting_func', "{$_SERVER['PHP_SELF']}?op=delete_tad_meeting&tad_meeting_sn=", "tad_meeting_sn");
    $xoopsTpl->assign('delete_tad_meeting_func', $delete_tad_meeting_func);

    $xoopsTpl->assign('action', $_SERVER['PHP_SELF']);
    $xoopsTpl->assign('now_op', 'show_one_tad_meeting');
}

//列出所有tad_meeting資料
function list_tad_meeting()
{
    global $xoopsDB, $xoopsTpl, $isAdmin;

    $myts = MyTextSanitizer::getInstance();

    $sql = "SELECT * FROM `" . $xoopsDB->prefix("tad_meeting") . "` ORDER BY tad_meeting_datetime DESC";

    //getPageBar($原sql語法, 每頁顯示幾筆資料, 最多顯示幾個頁數選項);
    $PageBar = getPageBar($sql, 20, 10);
    $bar     = $PageBar['bar'];
    $sql     = $PageBar['sql'];
    $total   = $PageBar['total'];

    $result = $xoopsDB->query($sql) or web_error($sql, __FILE__, _LINE__);

    //取得分類所有資料陣列
    $tad_meeting_cate_arr = get_tad_meeting_cate_all();
    $all_content          = array();
    $i                    = 0;
    while ($all = $xoopsDB->fetchArray($result)) {
        //以下會產生這些變數： $tad_meeting_sn, $tad_meeting_title, $tad_meeting_cate_sn, $tad_meeting_datetime, $tad_meeting_place, $tad_meeting_chairman, $tad_meeting_note
        foreach ($all as $k => $v) {
            $$k = $v;
        }

        //過濾讀出的變數值
        $tad_meeting_title    = $myts->htmlSpecialChars($tad_meeting_title);
        $tad_meeting_datetime = $myts->htmlSpecialChars($tad_meeting_datetime);
        $tad_meeting_chairman = $myts->htmlSpecialChars($tad_meeting_chairman);
        $tad_meeting_note     = $myts->displayTarea($tad_meeting_note, 0, 1, 0, 1, 1);

        $all_content[$i]['tad_meeting_sn']       = $tad_meeting_sn;
        $all_content[$i]['tad_meeting_title']    = $tad_meeting_title;
        $all_content[$i]['tad_meeting_cate_sn']  = $tad_meeting_cate_arr[$tad_meeting_cate_sn]['tad_meeting_cate_title'];
        $all_content[$i]['tad_meeting_datetime'] = $tad_meeting_datetime;
        $all_content[$i]['tad_meeting_place']    = $tad_meeting_place;
        $all_content[$i]['tad_meeting_chairman'] = $tad_meeting_chairman;
        $all_content[$i]['tad_meeting_note']     = $tad_meeting_note;
        $i++;
    }

    //刪除確認的JS
    if (!file_exists(XOOPS_ROOT_PATH . "/modules/tadtools/sweet_alert.php")) {
        redirect_header("index.php", 3, _MD_NEED_TADTOOLS);
    }
    include_once XOOPS_ROOT_PATH . "/modules/tadtools/sweet_alert.php";
    $sweet_alert_obj         = new sweet_alert();
    $delete_tad_meeting_func = $sweet_alert_obj->render('delete_tad_meeting_func',
        "{$_SERVER['PHP_SELF']}?op=delete_tad_meeting&tad_meeting_sn=", "tad_meeting_sn");
    $xoopsTpl->assign('delete_tad_meeting_func', $delete_tad_meeting_func);

    $xoopsTpl->assign('bar', $bar);
    $xoopsTpl->assign('action', $_SERVER['PHP_SELF']);
    $xoopsTpl->assign('isAdmin', $isAdmin);
    $xoopsTpl->assign('all_content', $all_content);
    $xoopsTpl->assign('now_op', 'list_tad_meeting');

    //判斷目前使用者是否有：建立會議
    $create_meeting = power_chk("tad_meeting", 1);
    $xoopsTpl->assign('create_meeting', $create_meeting);

}

//取得tad_meeting_cate所有資料陣列
function get_tad_meeting_cate_all()
{
    global $xoopsDB;
    $sql      = "SELECT * FROM `" . $xoopsDB->prefix("tad_meeting_cate") . "`";
    $result   = $xoopsDB->query($sql) or web_error($sql, __FILE__, _LINE__);
    $data_arr = array();
    while ($data = $xoopsDB->fetchArray($result)) {
        $tad_meeting_cate_sn            = $data['tad_meeting_cate_sn'];
        $data_arr[$tad_meeting_cate_sn] = $data;
    }
    return $data_arr;
}

//tad_meeting_data編輯表單
function tad_meeting_data_form($tad_meeting_sn = '', $tad_meeting_data_sn = '')
{
    global $xoopsDB, $xoopsTpl, $xoopsUser, $isAdmin, $xoopsModuleConfig;

    $add_report = power_chk("tad_meeting", 2);
    if (!$isAdmin and !$add_report) {
        redirect_header($_SERVER['PHP_SELF'], 3, _TAD_PERMISSION_DENIED);
    }

    //抓取預設值
    if (!empty($tad_meeting_data_sn)) {
        $DBV = get_tad_meeting_data($tad_meeting_data_sn);
    } else {
        $DBV = array();
    }

    //預設值設定

    //設定 tad_meeting_data_sn 欄位的預設值
    $tad_meeting_data_sn = !isset($DBV['tad_meeting_data_sn']) ? $tad_meeting_data_sn : $DBV['tad_meeting_data_sn'];
    $xoopsTpl->assign('tad_meeting_data_sn', $tad_meeting_data_sn);
    //設定 tad_meeting_sn 欄位的預設值
    $tad_meeting_sn = !isset($DBV['tad_meeting_sn']) ? $tad_meeting_sn : $DBV['tad_meeting_sn'];
    //設定 tad_meeting_data_unit 欄位的預設值
    $tad_meeting_data_unit = !isset($DBV['tad_meeting_data_unit']) ? '' : $DBV['tad_meeting_data_unit'];
    $xoopsTpl->assign('tad_meeting_data_unit', $tad_meeting_data_unit);
    //設定 tad_meeting_data_job 欄位的預設值
    $tad_meeting_data_job = !isset($DBV['tad_meeting_data_job']) ? '' : $DBV['tad_meeting_data_job'];
    $xoopsTpl->assign('tad_meeting_data_job', $tad_meeting_data_job);
    //設定 tad_meeting_data_title 欄位的預設值
    $tad_meeting_data_title = !isset($DBV['tad_meeting_data_title']) ? '' : $DBV['tad_meeting_data_title'];
    $xoopsTpl->assign('tad_meeting_data_title', $tad_meeting_data_title);
    //設定 tad_meeting_data_content 欄位的預設值
    $tad_meeting_data_content = !isset($DBV['tad_meeting_data_content']) ? '' : $DBV['tad_meeting_data_content'];
    $xoopsTpl->assign('tad_meeting_data_content', $tad_meeting_data_content);
    //設定 tad_meeting_data_uid 欄位的預設值
    $user_uid             = $xoopsUser ? $xoopsUser->uid() : "";
    $tad_meeting_data_uid = !isset($DBV['tad_meeting_data_uid']) ? $user_uid : $DBV['tad_meeting_data_uid'];
    $xoopsTpl->assign('tad_meeting_data_uid', $tad_meeting_data_uid);
    //設定 tad_meeting_data_sort 欄位的預設值
    $tad_meeting_data_sort = !isset($DBV['tad_meeting_data_sort']) ? tad_meeting_data_max_sort() : $DBV['tad_meeting_data_sort'];
    $xoopsTpl->assign('tad_meeting_data_sort', $tad_meeting_data_sort);
    //設定 tad_meeting_data_date 欄位的預設值
    $tad_meeting_data_date = !isset($DBV['tad_meeting_data_date']) ? date("Y-m-d H:i:s") : $DBV['tad_meeting_data_date'];
    $xoopsTpl->assign('tad_meeting_data_date', $tad_meeting_data_date);

    $op = empty($tad_meeting_data_sn) ? "insert_tad_meeting_data" : "update_tad_meeting_data";
    //$op = "replace_tad_meeting_data";

    //套用formValidator驗證機制
    if (!file_exists(TADTOOLS_PATH . "/formValidator.php")) {
        redirect_header("index.php", 3, _TAD_NEED_TADTOOLS);
    }
    include_once TADTOOLS_PATH . "/formValidator.php";
    $formValidator      = new formValidator("#myForm", true);
    $formValidator_code = $formValidator->render();

    include_once XOOPS_ROOT_PATH . "/modules/tadtools/TadUpFiles.php";
    $TadUpFiles = new TadUpFiles("tad_meeting");
    $TadUpFiles->set_col("tad_meeting_data_sn", $tad_meeting_data_sn);
    $up_tad_meeting_data_sn_form = $TadUpFiles->upform(true, "up_tad_meeting_data_sn", "");
    $xoopsTpl->assign('up_tad_meeting_data_sn_form', $up_tad_meeting_data_sn_form);

    //加入Token安全機制
    include_once XOOPS_ROOT_PATH . "/class/xoopsformloader.php";
    $token      = new XoopsFormHiddenToken();
    $token_form = $token->render();
    $xoopsTpl->assign("token_form", $token_form);
    $xoopsTpl->assign('action', $_SERVER["PHP_SELF"]);
    $xoopsTpl->assign('formValidator_code', $formValidator_code);
    $xoopsTpl->assign('now_op', 'tad_meeting_data_form');
    $xoopsTpl->assign('next_op', $op);

    $meeting_unit_arr = array();
    $meeting_unit     = explode(';', $xoopsModuleConfig['meeting_unit']);
    foreach ($meeting_unit as $value) {
        $meeting_unit_arr[] = trim($value);
    }
    $xoopsTpl->assign('meeting_unit', $meeting_unit_arr);

    $meeting_job_arr = array();
    $meeting_job     = explode(';', $xoopsModuleConfig['meeting_job']);
    foreach ($meeting_job as $value) {
        $meeting_job_arr[] = trim($value);
    }
    $xoopsTpl->assign('meeting_job', $meeting_job_arr);
}

//自動取得tad_meeting_data的最新排序
function tad_meeting_data_max_sort()
{
    global $xoopsDB;
    $sql        = "SELECT max(`tad_meeting_data_sort`) FROM `" . $xoopsDB->prefix("tad_meeting_data") . "`";
    $result     = $xoopsDB->query($sql) or web_error($sql, __FILE__, _LINE__);
    list($sort) = $xoopsDB->fetchRow($result);
    return ++$sort;
}

//以流水號取得某筆tad_meeting_data資料
function get_tad_meeting_data($tad_meeting_data_sn = '')
{
    global $xoopsDB;

    if (empty($tad_meeting_data_sn)) {
        return;
    }

    $sql = "select * from `" . $xoopsDB->prefix("tad_meeting_data") . "`
    where `tad_meeting_data_sn` = '{$tad_meeting_data_sn}'";
    $result = $xoopsDB->query($sql) or web_error($sql, __FILE__, _LINE__);
    $data   = $xoopsDB->fetchArray($result);
    return $data;
}

//新增資料到tad_meeting_data中
function insert_tad_meeting_data()
{
    global $xoopsDB, $xoopsUser, $isAdmin;
    $add_report = power_chk("tad_meeting", 2);
    if (!$isAdmin and !$add_report) {
        redirect_header($_SERVER['PHP_SELF'], 3, _TAD_PERMISSION_DENIED);
    }

    //XOOPS表單安全檢查
    if (!$GLOBALS['xoopsSecurity']->check()) {
        $error = implode("<br />", $GLOBALS['xoopsSecurity']->getErrors());
        redirect_header($_SERVER['PHP_SELF'], 3, $error);
    }

    $myts = MyTextSanitizer::getInstance();

    $tad_meeting_sn           = (int) $_POST['tad_meeting_sn'];
    $tad_meeting_data_sn      = (int) $_POST['tad_meeting_data_sn'];
    $tad_meeting_data_unit    = $_POST['tad_meeting_data_unit'];
    $tad_meeting_data_job     = $_POST['tad_meeting_data_job'];
    $tad_meeting_data_title   = $myts->addSlashes($_POST['tad_meeting_data_title']);
    $tad_meeting_data_content = $myts->addSlashes($_POST['tad_meeting_data_content']);
    //取得使用者編號
    $tad_meeting_data_uid  = ($xoopsUser) ? $xoopsUser->uid() : "";
    $tad_meeting_data_uid  = !empty($_POST['tad_meeting_data_uid']) ? (int) $_POST['tad_meeting_data_uid'] : $tad_meeting_data_uid;
    $tad_meeting_data_sort = (int) $_POST['tad_meeting_data_sort'];
    $tad_meeting_data_date = date("Y-m-d H:i:s", xoops_getUserTimestamp(time()));

    $sql = "insert into `" . $xoopsDB->prefix("tad_meeting_data") . "` (
        `tad_meeting_sn`,
        `tad_meeting_data_unit`,
        `tad_meeting_data_job`,
        `tad_meeting_data_title`,
        `tad_meeting_data_content`,
        `tad_meeting_data_uid`,
        `tad_meeting_data_sort`,
        `tad_meeting_data_date`
    ) values(
        '{$tad_meeting_sn}',
        '{$tad_meeting_data_unit}',
        '{$tad_meeting_data_job}',
        '{$tad_meeting_data_title}',
        '{$tad_meeting_data_content}',
        '{$tad_meeting_data_uid}',
        '{$tad_meeting_data_sort}',
        '{$tad_meeting_data_date}'
    )";
    $xoopsDB->query($sql) or web_error($sql, __FILE__, _LINE__);

    //取得最後新增資料的流水編號
    $tad_meeting_data_sn = $xoopsDB->getInsertId();

    include_once XOOPS_ROOT_PATH . "/modules/tadtools/TadUpFiles.php";
    $TadUpFiles = new TadUpFiles("tad_meeting");
    $TadUpFiles->set_col("tad_meeting_data_sn", $tad_meeting_data_sn);
    $TadUpFiles->upload_file('up_tad_meeting_data_sn', '', '', '', '', true, false);
    return $tad_meeting_data_sn;
}

//更新tad_meeting_data某一筆資料
function update_tad_meeting_data($tad_meeting_data_sn = '')
{
    global $xoopsDB, $isAdmin, $xoopsUser;
    $add_report = power_chk("tad_meeting", 2);
    if (!$isAdmin and !$add_report) {
        redirect_header($_SERVER['PHP_SELF'], 3, _TAD_PERMISSION_DENIED);
    }

    //XOOPS表單安全檢查
    if (!$GLOBALS['xoopsSecurity']->check()) {
        $error = implode("<br />", $GLOBALS['xoopsSecurity']->getErrors());
        redirect_header($_SERVER['PHP_SELF'], 3, $error);
    }

    $myts = MyTextSanitizer::getInstance();

    $tad_meeting_data_unit    = $_POST['tad_meeting_data_unit'];
    $tad_meeting_data_job     = $_POST['tad_meeting_data_job'];
    $tad_meeting_data_title   = $myts->addSlashes($_POST['tad_meeting_data_title']);
    $tad_meeting_data_content = $myts->addSlashes($_POST['tad_meeting_data_content']);
    //取得使用者編號
    $tad_meeting_data_uid  = ($xoopsUser) ? $xoopsUser->uid() : "";
    $tad_meeting_data_uid  = !empty($_POST['tad_meeting_data_uid']) ? (int) $_POST['tad_meeting_data_uid'] : $tad_meeting_data_uid;
    $tad_meeting_data_sort = (int) $_POST['tad_meeting_data_sort'];
    $tad_meeting_data_date = date("Y-m-d H:i:s", xoops_getUserTimestamp(time()));

    $sql = "update `" . $xoopsDB->prefix("tad_meeting_data") . "` set
       `tad_meeting_data_unit` = '{$tad_meeting_data_unit}',
       `tad_meeting_data_job` = '{$tad_meeting_data_job}',
       `tad_meeting_data_title` = '{$tad_meeting_data_title}',
       `tad_meeting_data_content` = '{$tad_meeting_data_content}',
       `tad_meeting_data_uid` = '{$tad_meeting_data_uid}',
       `tad_meeting_data_sort` = '{$tad_meeting_data_sort}',
       `tad_meeting_data_date` = '{$tad_meeting_data_date}'
    where `tad_meeting_data_sn` = '$tad_meeting_data_sn'";
    $xoopsDB->queryF($sql) or web_error($sql, __FILE__, _LINE__);

    include_once XOOPS_ROOT_PATH . "/modules/tadtools/TadUpFiles.php";
    $TadUpFiles = new TadUpFiles("tad_meeting");
    $TadUpFiles->set_col("tad_meeting_data_sn", $tad_meeting_data_sn);
    $TadUpFiles->upload_file('up_tad_meeting_data_sn', '', '', '', '', true, false);
    return $tad_meeting_data_sn;
}

/*-----------執行動作判斷區----------*/
include_once $GLOBALS['xoops']->path('/modules/system/include/functions.php');
$op                  = system_CleanVars($_REQUEST, 'op', '', 'string');
$tad_meeting_sn      = system_CleanVars($_REQUEST, 'tad_meeting_sn', '', 'int');
$tad_meeting_cate_sn = system_CleanVars($_REQUEST, 'tad_meeting_cate_sn', '', 'int');
$tad_meeting_data_sn = system_CleanVars($_REQUEST, 'tad_meeting_data_sn', '', 'int');
$files_sn            = system_CleanVars($_REQUEST, 'files_sn', '', 'int');

switch ($op) {
    /*---判斷動作請貼在下方---*/

    case "tad_meeting_form":
        tad_meeting_form($tad_meeting_sn);
        break;

    //新增資料
    case "insert_tad_meeting":
        $tad_meeting_sn = insert_tad_meeting();
        header("location: {$_SERVER['PHP_SELF']}?tad_meeting_sn=$tad_meeting_sn");
        exit;

    //更新資料
    case "update_tad_meeting":
        update_tad_meeting($tad_meeting_sn);
        header("location: {$_SERVER['PHP_SELF']}?tad_meeting_sn=$tad_meeting_sn");
        exit;

    case "delete_tad_meeting":
        delete_tad_meeting($tad_meeting_sn);
        header("location: {$_SERVER['PHP_SELF']}");
        exit;

    //新增報告資料
    case "insert_tad_meeting_data":
        $tad_meeting_data_sn = insert_tad_meeting_data();
        header("location: {$_SERVER['PHP_SELF']}?tad_meeting_sn=$tad_meeting_sn");
        exit;

    //更新報告資料
    case "update_tad_meeting_data":
        update_tad_meeting_data($tad_meeting_data_sn);
        header("location: {$_SERVER['PHP_SELF']}?tad_meeting_sn=$tad_meeting_sn");
        exit;

    //報告表單
    case "tad_meeting_data_form":
        tad_meeting_data_form($tad_meeting_sn, $tad_meeting_data_sn);
        break;

    //刪除報告
    case "delete_tad_meeting_data":
        delete_tad_meeting_data($tad_meeting_data_sn);
        header("location: {$_SERVER['PHP_SELF']}?tad_meeting_sn=$tad_meeting_sn");
        exit;

    //下載檔案
    case "tufdl":
        include_once XOOPS_ROOT_PATH . "/modules/tadtools/TadUpFiles.php";
        $TadUpFiles = new TadUpFiles("tad_meeting");
        $TadUpFiles->add_file_counter($files_sn, false);
        exit;
        break;

    //更新排序
    case "update_tad_meeting_data_sort":
        $msg = update_tad_meeting_data_sort();
        die($msg);
        break;

    default:
        if (empty($tad_meeting_sn)) {
            list_tad_meeting();
            //$main .= tad_meeting_form($tad_meeting_sn);
        } else {
            show_one_tad_meeting($tad_meeting_sn, $tad_meeting_data_sn);
        }
        break;

        /*---判斷動作請貼在上方---*/
}

/*-----------秀出結果區--------------*/
$xoopsTpl->assign("toolbar", toolbar_bootstrap($interface_menu));
$xoopsTpl->assign("isAdmin", $isAdmin);
include_once XOOPS_ROOT_PATH . '/footer.php';
