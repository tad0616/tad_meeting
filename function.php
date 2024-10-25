<?php
use Xmf\Request;
use XoopsModules\Tadtools\FormValidator;
use XoopsModules\Tadtools\SweetAlert;
use XoopsModules\Tadtools\TadUpFiles;
use XoopsModules\Tadtools\Utility;
/********************* 自訂函數 *********************/
/**
 * @param string $tad_meeting_sn
 * @param string $tad_meeting_cate_sn
 */

//tad_meeting編輯表單
function tad_meeting_form($tad_meeting_sn = '', $tad_meeting_cate_sn = '')
{
    global $xoopsDB, $xoopsTpl, $xoopsModuleConfig, $xoTheme;

    $xoTheme->addScript('modules/tadtools/My97DatePicker/WdatePicker.js');

    //抓取預設值
    if (!empty($tad_meeting_sn)) {
        $DBV = get_tad_meeting($tad_meeting_sn);
    } else {
        $DBV = [];
    }

    //判斷目前使用者是否有：建立會議
    $create_meeting = Utility::power_chk('create_meeting', $DBV['tad_meeting_cate_sn']);
    $xoopsTpl->assign('create_meeting', $create_meeting);

    if (!$_SESSION['tad_meeting_adm'] and !$create_meeting) {
        redirect_header($_SERVER['PHP_SELF'], 3, _TAD_PERMISSION_DENIED);
    }

    //預設值設定

    //設定 tad_meeting_sn 欄位的預設值
    $tad_meeting_sn = !isset($DBV['tad_meeting_sn']) ? $tad_meeting_sn : $DBV['tad_meeting_sn'];
    $xoopsTpl->assign('tad_meeting_sn', $tad_meeting_sn);
    //設定 tad_meeting_title 欄位的預設值
    $tad_meeting_title = !isset($DBV['tad_meeting_title']) ? '' : $DBV['tad_meeting_title'];
    $xoopsTpl->assign('tad_meeting_title', $tad_meeting_title);
    //設定 tad_meeting_cate_sn 欄位的預設值
    $tad_meeting_cate_sn = !isset($DBV['tad_meeting_cate_sn']) ? $tad_meeting_cate_sn : $DBV['tad_meeting_cate_sn'];
    $xoopsTpl->assign('tad_meeting_cate_sn', $tad_meeting_cate_sn);
    //設定 tad_meeting_datetime 欄位的預設值
    $tad_meeting_datetime = !isset($DBV['tad_meeting_datetime']) ? date('Y-m-d H:i') : $DBV['tad_meeting_datetime'];
    $xoopsTpl->assign('tad_meeting_datetime', $tad_meeting_datetime);
    //設定 tad_meeting_place 欄位的預設值
    $tad_meeting_place = !isset($DBV['tad_meeting_place']) ? '' : $DBV['tad_meeting_place'];
    $xoopsTpl->assign('tad_meeting_place', $tad_meeting_place);
    //設定 tad_meeting_chairman 欄位的預設值
    $tad_meeting_chairman = !isset($DBV['tad_meeting_chairman']) ? '' : $DBV['tad_meeting_chairman'];
    $xoopsTpl->assign('tad_meeting_chairman', $tad_meeting_chairman);
    //設定 tad_meeting_note 欄位的預設值
    $tad_meeting_note = !isset($DBV['tad_meeting_note']) ? '' : $DBV['tad_meeting_note'];
    $xoopsTpl->assign('tad_meeting_note', $tad_meeting_note);

    $op = empty($tad_meeting_sn) ? 'insert_tad_meeting' : 'update_tad_meeting';
    //$op = "replace_tad_meeting";

    $FormValidator = new FormValidator('#myForm', true);
    $FormValidator->render();

    //會議類別
    $sql = 'SELECT `tad_meeting_cate_sn`, `tad_meeting_cate_title` FROM `' . $xoopsDB->prefix('tad_meeting_cate') . '` ORDER BY `tad_meeting_cate_sort`';
    $result = Utility::query($sql) or Utility::web_error($sql, __FILE__, __LINE__);

    $i = 0;
    $tad_meeting_cate_sn_options_array = [];
    while (list($tad_meeting_cate_sn, $tad_meeting_cate_title) = $xoopsDB->fetchRow($result)) {
        $tad_meeting_cate_sn_options_array[$i]['tad_meeting_cate_sn'] = $tad_meeting_cate_sn;
        $tad_meeting_cate_sn_options_array[$i]['tad_meeting_cate_title'] = $tad_meeting_cate_title;
        $i++;
    }
    $xoopsTpl->assign('tad_meeting_cate_sn_options', $tad_meeting_cate_sn_options_array);

    //加入Token安全機制
    require_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';
    $token = new \XoopsFormHiddenToken();
    $token_form = $token->render();
    $xoopsTpl->assign('token_form', $token_form);
    $xoopsTpl->assign('action', $_SERVER['PHP_SELF']);
    $xoopsTpl->assign('next_op', $op);

    $meeting_place_arr = [];
    $meeting_place = explode(';', $xoopsModuleConfig['meeting_place']);
    foreach ($meeting_place as $value) {
        $meeting_place_arr[] = trim($value);
    }
    $xoopsTpl->assign('meeting_place', $meeting_place_arr);
}

//新增資料到tad_meeting中
function insert_tad_meeting()
{
    global $xoopsDB;

    $tad_meeting_sn = Request::getInt('tad_meeting_sn');
    $tad_meeting_title = Request::getString('tad_meeting_title');
    $tad_meeting_cate_sn = Request::getInt('tad_meeting_cate_sn');
    $tad_meeting_datetime = Request::getString('tad_meeting_datetime');
    $tad_meeting_place = Request::getString('tad_meeting_place');
    $tad_meeting_chairman = Request::getString('tad_meeting_chairman');
    $tad_meeting_note = Request::getString('tad_meeting_note');

    //判斷目前使用者是否有：建立會議
    $create_meeting = Utility::power_chk('create_meeting', $tad_meeting_cate_sn);
    if (!$_SESSION['tad_meeting_adm'] and !$create_meeting) {
        redirect_header($_SERVER['PHP_SELF'], 3, _TAD_PERMISSION_DENIED);
    }

    //XOOPS表單安全檢查
    if ($_SERVER['SERVER_ADDR'] != '127.0.0.1' && !$GLOBALS['xoopsSecurity']->check()) {
        $error = implode('<br>', $GLOBALS['xoopsSecurity']->getErrors());
        redirect_header($_SERVER['PHP_SELF'], 3, $error);
    }

    $sql = 'INSERT INTO `' . $xoopsDB->prefix('tad_meeting') . '` (
        `tad_meeting_title`,
        `tad_meeting_cate_sn`,
        `tad_meeting_datetime`,
        `tad_meeting_place`,
        `tad_meeting_chairman`,
        `tad_meeting_note`
    ) VALUES (
        ?,
        ?,
        ?,
        ?,
        ?,
        ?
    )';
    Utility::query($sql, 'sissss', [$tad_meeting_title, $tad_meeting_cate_sn, $tad_meeting_datetime, $tad_meeting_place, $tad_meeting_chairman, $tad_meeting_note]) or Utility::web_error($sql, __FILE__, __LINE__);

    //取得最後新增資料的流水編號
    $tad_meeting_sn = $xoopsDB->getInsertId();

    return $tad_meeting_sn;
}

//更新tad_meeting某一筆資料
function update_tad_meeting($tad_meeting_sn = '')
{
    global $xoopsDB;

    $tad_meeting_sn = Request::getInt('tad_meeting_sn');
    $tad_meeting_title = Request::getString('tad_meeting_title');
    $tad_meeting_cate_sn = Request::getInt('tad_meeting_cate_sn');
    $tad_meeting_datetime = Request::getString('tad_meeting_datetime');
    $tad_meeting_place = Request::getString('tad_meeting_place');
    $tad_meeting_chairman = Request::getString('tad_meeting_chairman');
    $tad_meeting_note = Request::getString('tad_meeting_note');

    $create_meeting = Utility::power_chk('create_meeting', $tad_meeting_cate_sn);
    if (!$_SESSION['tad_meeting_adm'] and !$create_meeting) {
        redirect_header($_SERVER['PHP_SELF'], 3, _TAD_PERMISSION_DENIED);
    }

    //XOOPS表單安全檢查
    if ($_SERVER['SERVER_ADDR'] != '127.0.0.1' && !$GLOBALS['xoopsSecurity']->check()) {
        $error = implode('<br>', $GLOBALS['xoopsSecurity']->getErrors());
        redirect_header($_SERVER['PHP_SELF'], 3, $error);
    }
    $sql = 'UPDATE `' . $xoopsDB->prefix('tad_meeting') . '` SET `tad_meeting_title` = ?, `tad_meeting_cate_sn` = ?, `tad_meeting_datetime` = ?, `tad_meeting_place` = ?, `tad_meeting_chairman` = ?, `tad_meeting_note` = ? WHERE `tad_meeting_sn` = ?';
    Utility::query($sql, 'sissssi', [$tad_meeting_title, $tad_meeting_cate_sn, $tad_meeting_datetime, $tad_meeting_place, $tad_meeting_chairman, $tad_meeting_note, $tad_meeting_sn]) or Utility::web_error($sql, __FILE__, __LINE__);

    return $tad_meeting_sn;
}

//刪除tad_meeting某筆資料資料
function delete_tad_meeting($tad_meeting_sn = '')
{
    global $xoopsDB;

    if (empty($tad_meeting_sn)) {
        return;
    }
    $DBV = get_tad_meeting($tad_meeting_sn);

    $create_meeting = Utility::power_chk('create_meeting', $DBV['tad_meeting_cate_sn']);
    if (!$_SESSION['tad_meeting_adm'] and !$create_meeting) {
        redirect_header($_SERVER['PHP_SELF'], 3, _TAD_PERMISSION_DENIED);
    }

    $sql = 'SELECT `tad_meeting_data_sn` FROM `' . $xoopsDB->prefix('tad_meeting_data') . '` WHERE `tad_meeting_sn` = ?';
    $result = Utility::query($sql, 'i', [$tad_meeting_sn]) or Utility::web_error($sql, __FILE__, __LINE__);

    while (list($tad_meeting_data_sn) = $xoopsDB->fetchRow($result)) {
        delete_tad_meeting_data($tad_meeting_data_sn);
    }

    $sql = 'DELETE FROM `' . $xoopsDB->prefix('tad_meeting') . '` WHERE `tad_meeting_sn` = ?';
    Utility::query($sql, 'i', [$tad_meeting_sn]) or Utility::web_error($sql, __FILE__, __LINE__);

}

//刪除tad_meeting_data某筆資料資料
function delete_tad_meeting_data($tad_meeting_data_sn = '')
{
    global $xoopsDB;

    if (empty($tad_meeting_data_sn)) {
        return;
    }
    $data = get_tad_meeting_data($tad_meeting_data_sn);
    $DBV = get_tad_meeting($data['tad_meeting_sn']);

    $post_meeting = Utility::power_chk('post_meeting', $DBV['tad_meeting_cate_sn']);
    if (!$_SESSION['tad_meeting_adm'] and !$post_meeting) {
        redirect_header($_SERVER['PHP_SELF'], 3, _TAD_PERMISSION_DENIED);
    }

    $sql = 'DELETE FROM `' . $xoopsDB->prefix('tad_meeting_data') . '` WHERE `tad_meeting_data_sn` = ?';
    Utility::query($sql, 'i', [$tad_meeting_data_sn]) or Utility::web_error($sql, __FILE__, __LINE__);

    $TadUpFiles = new TadUpFiles('tad_meeting');
    $TadUpFiles->set_col('tad_meeting_data_sn', $tad_meeting_data_sn);
    $TadUpFiles->del_files();
}

//以流水號取得某筆tad_meeting資料
function get_tad_meeting($tad_meeting_sn = '')
{
    global $xoopsDB;

    if (empty($tad_meeting_sn)) {
        return;
    }

    $sql = 'SELECT * FROM `' . $xoopsDB->prefix('tad_meeting') . '` WHERE `tad_meeting_sn` =?';
    $result = Utility::query($sql, 'i', [$tad_meeting_sn]) or Utility::web_error($sql, __FILE__, __LINE__);
    $data = $xoopsDB->fetchArray($result);

    return $data;
}

//以流水號取得某筆tad_meeting_cate資料
function get_tad_meeting_cate($tad_meeting_cate_sn = '')
{
    global $xoopsDB;

    if (empty($tad_meeting_cate_sn)) {
        return;
    }

    $sql = 'SELECT * FROM `' . $xoopsDB->prefix('tad_meeting_cate') . '` WHERE `tad_meeting_cate_sn` = ?';
    $result = Utility::query($sql, 'i', [$tad_meeting_cate_sn]) or Utility::web_error($sql, __FILE__, __LINE__);

    $data = $xoopsDB->fetchArray($result);

    return $data;
}

//列出所有tad_meeting_data資料
function list_tad_meeting_data($tad_meeting_sn = '', $mode = '', $file_mode = '')
{
    global $xoopsDB, $xoopsTpl, $xoopsModuleConfig;

    $myts = \MyTextSanitizer::getInstance();

    $TadUpFiles = new TadUpFiles('tad_meeting');

    $meeting_unit_arr = [];
    $meeting_unit = explode(';', $xoopsModuleConfig['meeting_unit']);
    foreach ($meeting_unit as $value) {
        $meeting_unit_arr[] = "'" . trim($value) . "'";
    }

    $meeting_unit_str = implode(',', $meeting_unit_arr);

    $orderby = ('tad_meeting_data_sort' === $xoopsModuleConfig['orderby']) ? '`tad_meeting_data_sort`' : "FIELD(`tad_meeting_data_unit`, {$meeting_unit_str}), `tad_meeting_data_sort`";
    $sql = 'SELECT * FROM `' . $xoopsDB->prefix('tad_meeting_data') . "` WHERE tad_meeting_sn = ? ORDER BY $orderby";
    $params = [$tad_meeting_sn];

    $result = Utility::query($sql, 's', $params) or Utility::web_error($sql, __FILE__, __LINE__);

    $all_content = [];
    $i = 1;
    while (false !== ($all = $xoopsDB->fetchArray($result))) {
        //以下會產生這些變數： $tad_meeting_data_sn, $tad_meeting_data_unit, $tad_meeting_data_job, $tad_meeting_data_title, $tad_meeting_data_content, $tad_meeting_data_uid, $tad_meeting_data_sort, $tad_meeting_data_date
        foreach ($all as $k => $v) {
            $$k = $v;
        }

        //將 uid 編號轉換成使用者姓名（或帳號）
        $uid_name = \XoopsUser::getUnameFromId($tad_meeting_data_uid, 1);
        if (empty($uid_name)) {
            $uid_name = \XoopsUser::getUnameFromId($tad_meeting_data_uid, 0);
        }

        //過濾讀出的變數值
        $tad_meeting_data_title = $myts->htmlSpecialChars($tad_meeting_data_title);
        $tad_meeting_data_content_html = $myts->displayTarea($tad_meeting_data_content, 0, 1, 0, 1, 1);

        $all_content[$i]['tad_meeting_data_sn'] = $tad_meeting_data_sn;
        $all_content[$i]['tad_meeting_data_unit'] = $tad_meeting_data_unit;
        $all_content[$i]['tad_meeting_data_job'] = $tad_meeting_data_job;
        $all_content[$i]['tad_meeting_data_title'] = $tad_meeting_data_title;
        $all_content[$i]['tad_meeting_data_content'] = $tad_meeting_data_content;
        $all_content[$i]['tad_meeting_data_content_html'] = $tad_meeting_data_content_html;
        $all_content[$i]['tad_meeting_data_uid'] = $tad_meeting_data_uid;
        $all_content[$i]['tad_meeting_data_uid_name'] = $uid_name;
        $all_content[$i]['tad_meeting_data_sort'] = $tad_meeting_data_sort;
        $all_content[$i]['tad_meeting_data_date'] = $tad_meeting_data_date;
        $all_content[$i]['number2chinese'] = number2chinese($i);

        $TadUpFiles->set_col('tad_meeting_data_sn', $tad_meeting_data_sn);
        $TadUpFiles->download_url = XOOPS_URL . '/modules/tad_meeting/index.php?op=tufdl';
        if ('return' === $mode) {
            $all_content[$i]['list_file'] = $TadUpFiles->show_files('up_tad_meeting_data_sn', true, $file_mode, true, false, null, null, false);
        } else {
            $all_content[$i]['list_file'] = $TadUpFiles->show_files('up_tad_meeting_data_sn', true, 'filename', true, false, null, null, false);
        }

        $i++;
    }

    if ('return' === $mode) {
        return $all_content;
    }

    $SweetAlert = new SweetAlert();
    $SweetAlert->render(
        'delete_tad_meeting_data_func',
        "{$_SERVER['PHP_SELF']}?op=delete_tad_meeting_data&tad_meeting_sn={$tad_meeting_sn}&tad_meeting_data_sn=",
        'tad_meeting_data_sn'
    );

    $xoopsTpl->assign('tad_meeting_data_jquery_ui', Utility::get_jquery(true));
    $xoopsTpl->assign('action', $_SERVER['PHP_SELF']);
    $xoopsTpl->assign('all_data_content', $all_content);
}

function number2chinese($num, $type = '')
{
    if (!is_numeric($num)) {
        return '含有非數字非小數點字符！';
    }

    if ('simple' === $type) {
        $mode = false;
        $sim = true;
    } else {
        $mode = true;
        $sim = false;
    }

    $char = $sim ? ['０', '一', '二', '三', '四', '五', '六', '七', '八', '九']
    : ['零', '壹', '貳', '叁', '肆', '伍', '陸', '柒', '捌', '玖'];
    $unit = $sim ? ['', '十', '百', '千', '', '萬', '億', '兆']
    : ['', '拾', '佰', '仟', '', '萬', '億', '兆'];
    $retval = $mode ? '' : '';

    //小數部分
    if (mb_strpos($num, '.')) {
        list($num, $dec) = explode('.', $num);
        $dec = (string) round($dec, 2);
        if ($mode) {
            $retval .= "{$char[$dec['0']]}角{$char[$dec['1']]}分";
        } else {
            for ($i = 0, $c = mb_strlen($dec); $i < $c; $i++) {
                $retval .= $char[$dec[$i]];
            }
        }
    }
    //整數部分
    $str = $mode ? strrev((int) $num) : strrev($num);
    for ($i = 0, $c = mb_strlen($str); $i < $c; $i++) {
        $out[$i] = $char[$str[$i]];
        if ($mode) {
            $out[$i] .= '0' != $str[$i] ? $unit[$i % 4] : '';
            if ($i > 1 and 0 == $str[$i] + $str[$i - 1]) {
                $out[$i] = '';
            }
            if (0 == $i % 4) {
                $out[$i] .= $unit[4 + floor($i / 4)];
            }
        }
    }
    $retval = implode('', array_reverse($out)) . $retval;

    return $retval;
}

//儲存權限
function saveItem_Permissions($groups, $itemid, $perm_name)
{
    global $xoopsModule;
    $module_id = $xoopsModule->mid();
    $gpermHandler = xoops_getHandler('groupperm');

    // First, if the permissions are already there, delete them
    $gpermHandler->deleteByModule($module_id, $perm_name, $itemid);

    // Save the new permissions
    if (count($groups) > 0) {
        foreach ($groups as $group_id) {
            $gpermHandler->addRight($perm_name, $itemid, $group_id, $module_id);
        }
    }
}

//取回權限的函數
function getItem_Permissions($itemid, $gperm_name)
{
    global $xoopsModule, $xoopsDB;
    $module_id = $xoopsModule->mid();
    $data = [];
    $sql = 'SELECT `gperm_groupid` FROM `' . $xoopsDB->prefix('group_permission') . '` WHERE `gperm_modid` =? AND `gperm_itemid` =? AND `gperm_name` =?';
    $result = Utility::query($sql, 'iis', [$module_id, $itemid, $gperm_name]) or Utility::web_error($sql, __FILE__, __LINE__);

    while (false !== ($row = $xoopsDB->fetchArray($result))) {
        $data[] = $row['gperm_groupid'];
    }

    return $data;
}
