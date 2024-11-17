<?php
use Xmf\Request;
use XoopsModules\Tadtools\CategoryHelper;
use XoopsModules\Tadtools\FormValidator;
use XoopsModules\Tadtools\SweetAlert;
use XoopsModules\Tadtools\Utility;
use XoopsModules\Tadtools\Ztree;
/*-----------引入檔案區--------------*/
$xoopsOption['template_main'] = 'tad_meeting_admin.tpl';
require_once __DIR__ . '/header.php';
require_once dirname(__DIR__) . '/function.php';

xoops_loadLanguage('main', $xoopsModule->getVar('dirname'));

/*-----------執行動作判斷區----------*/
$op = Request::getString('op');
$tad_meeting_sn = Request::getInt('tad_meeting_sn');
$tad_meeting_cate_sn = Request::getInt('tad_meeting_cate_sn');
$tad_meeting_data_sn = Request::getInt('tad_meeting_data_sn');
$files_sn = Request::getInt('files_sn');

switch ($op) {
    case 'tad_meeting_form':
        list_tad_meeting_cate_tree($tad_meeting_cate_sn);
        tad_meeting_form($tad_meeting_sn, $tad_meeting_cate_sn);
        break;

    case 'delete_tad_meeting':
        delete_tad_meeting($tad_meeting_sn);
        header("location: {$_SERVER['PHP_SELF']}");
        exit;

    case 'tad_meeting_cate_form':
        list_tad_meeting_cate_tree($tad_meeting_cate_sn);
        tad_meeting_cate_form($tad_meeting_cate_sn);
        break;

    case 'delete_tad_meeting_cate':
        delete_tad_meeting_cate($tad_meeting_cate_sn);
        header("location: {$_SERVER['PHP_SELF']}");
        exit;

    //新增資料
    case 'insert_tad_meeting':
        $tad_meeting_sn = insert_tad_meeting();
        header("location: {$_SERVER['PHP_SELF']}?tad_meeting_sn=$tad_meeting_sn");
        exit;

    //更新資料
    case 'update_tad_meeting':
        update_tad_meeting($tad_meeting_sn);
        header("location: {$_SERVER['PHP_SELF']}?tad_meeting_sn=$tad_meeting_sn");
        exit;

    //新增資料
    case 'insert_tad_meeting_cate':
        $tad_meeting_cate_sn = insert_tad_meeting_cate();
        header("location: {$_SERVER['PHP_SELF']}?tad_meeting_cate_sn=$tad_meeting_cate_sn");
        exit;

    //更新資料
    case 'update_tad_meeting_cate':
        update_tad_meeting_cate($tad_meeting_cate_sn);
        header("location: {$_SERVER['PHP_SELF']}?tad_meeting_cate_sn=$tad_meeting_cate_sn");
        exit;

    default:
        list_tad_meeting_cate_tree($tad_meeting_cate_sn);
        list_tad_meeting($tad_meeting_cate_sn);
        $op = 'list_tad_meeting';
        break;
}

/*-----------秀出結果區--------------*/
$xoopsTpl->assign('now_op', $op);
$xoopsTpl->assign('tad_meeting_adm', $tad_meeting_adm);
require_once __DIR__ . '/footer.php';

/*-----------功能函數區--------------*/

//列出所有tad_meeting資料
function list_tad_meeting($tad_meeting_cate_sn = '')
{
    global $xoopsDB, $xoopsTpl, $g2p;

    //取得分類所有資料陣列
    $tad_meeting_cate_arr = get_tad_meeting_cate_all();
    $cate = [];
    if ($tad_meeting_cate_sn) {

        $cate = get_tad_meeting_cate($tad_meeting_cate_sn);

        $view_meeting = Utility::get_perm($tad_meeting_cate_sn, 'view_meeting');
        $view_meeting_txt = Utility::txt_to_group_name(implode(',', (array) $view_meeting), _MA_TADMEETIN_ALL_OK, ' , ');
        $xoopsTpl->assign('view_meeting_txt', $view_meeting_txt);

        $create_meeting = Utility::get_perm($tad_meeting_cate_sn, 'create_meeting');
        $create_meeting_txt = Utility::txt_to_group_name(implode(',', (array) $create_meeting), _MA_TADMEETIN_ONLY_ROOT, ' , ');
        $xoopsTpl->assign('create_meeting_txt', $create_meeting_txt);

        $post_meeting = Utility::get_perm($tad_meeting_cate_sn, 'post_meeting');
        $post_meeting_txt = Utility::txt_to_group_name(implode(',', (array) $post_meeting), _MA_TADMEETIN_ONLY_ROOT, ' , ');
        $xoopsTpl->assign('post_meeting_txt', $post_meeting_txt);

        $sort_meeting = Utility::get_perm($tad_meeting_cate_sn, 'sort_meeting');
        $sort_meeting_txt = Utility::txt_to_group_name(implode(',', (array) $sort_meeting), _MA_TADMEETIN_ONLY_ROOT, ' , ');
        $xoopsTpl->assign('sort_meeting_txt', $sort_meeting_txt);
    }

    $where_tad_meeting_cate_sn = !empty($tad_meeting_cate_sn) ? "where a.tad_meeting_cate_sn='{$tad_meeting_cate_sn}'" : '';

    $sql = 'select a.*, b.tad_meeting_cate_title from ' . $xoopsDB->prefix('tad_meeting') . ' as a left join ' . $xoopsDB->prefix('tad_meeting_cate') . " as b on a.tad_meeting_cate_sn=b.tad_meeting_cate_sn {$where_tad_meeting_cate_sn} order by a.tad_meeting_sn desc";
    //Utility::getPageBar($原sql語法, 每頁顯示幾筆資料, 最多顯示幾個頁數選項);
    $PageBar = Utility::getPageBar($sql, 10, 10);
    $bar = $PageBar['bar'];
    $sql = $PageBar['sql'];
    $total = $PageBar['total'];
    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);

    $i = 0;

    $all_content = [];
    while (false !== ($all = $xoopsDB->fetchArray($result))) {

        $all['tad_meeting_cate_title'] = $tad_meeting_cate_arr[$all['tad_meeting_cate_sn']]['tad_meeting_cate_title'];
        $all_content[$i] = $all;

        $i++;
    }
    Utility::get_jquery(true);

    $SweetAlert = new SweetAlert();
    $SweetAlert->render('delete_tad_meeting_cate_func', 'main.php?op=delete_tad_meeting_cate&tad_meeting_cate_sn=', 'tad_meeting_cate_sn');
    $SweetAlert2 = new SweetAlert();
    $SweetAlert2->render('delete_tad_meeting_func', "main.php?op=delete_tad_meeting&tad_meeting_cate_sn=$tad_meeting_cate_sn&g2p=$g2p&tad_meeting_sn=", 'tad_meeting_sn');

    $xoopsTpl->assign('tad_meeting_cate_sn', $tad_meeting_cate_sn);
    $xoopsTpl->assign('all_content', $all_content);
    $xoopsTpl->assign('cate', $cate);
    $xoopsTpl->assign('bar', $bar);
}

//列出所有tad_meeting_cate資料
function list_tad_meeting_cate_tree($def_tad_meeting_cate_sn = '')
{
    global $xoopsDB, $xoopsTpl;
    $cate_count = [];

    $sql = 'SELECT COUNT(*), `tad_meeting_cate_sn` FROM `' . $xoopsDB->prefix('tad_meeting') . '` GROUP BY `tad_meeting_cate_sn`';
    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);

    while (list($count, $tad_meeting_cate_sn) = $xoopsDB->fetchRow($result)) {
        $cate_count[$tad_meeting_cate_sn] = $count;
    }

    $categoryHelper = new CategoryHelper('tad_meeting_cate', 'tad_meeting_cate_sn', 'tad_meeting_cate_parent_sn', 'tad_meeting_cate_title');
    $path = $categoryHelper->getCategoryPath($def_tad_meeting_cate_sn);

    // $path = get_tad_meeting_cate_path($def_tad_meeting_cate_sn);
    $path_arr = array_keys($path);
    $data[] = "{ id:0, pId:0, name:'All', url:'main.php', target:'_self', open:true}";

    $sql = 'SELECT `tad_meeting_cate_sn`, `tad_meeting_cate_parent_sn`, `tad_meeting_cate_title` FROM `' . $xoopsDB->prefix('tad_meeting_cate') . '` ORDER BY `tad_meeting_cate_sort`';
    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);

    if ($result->num_rows > 0) {
        while (list($tad_meeting_cate_sn, $tad_meeting_cate_parent_sn, $tad_meeting_cate_title) = $xoopsDB->fetchRow($result)) {
            $font_style = $def_tad_meeting_cate_sn == $tad_meeting_cate_sn ? ", font:{'background-color':'yellow', 'color':'black'}" : '';
            $open = in_array($tad_meeting_cate_sn, $path_arr) ? 'true' : 'false';
            $display_counter = empty($cate_count[$tad_meeting_cate_sn]) ? '' : " ({$cate_count[$tad_meeting_cate_sn]})";
            $data[] = "{ id:{$tad_meeting_cate_sn}, pId:{$tad_meeting_cate_parent_sn}, name:'{$tad_meeting_cate_title}{$display_counter}', url:'main.php?tad_meeting_cate_sn={$tad_meeting_cate_sn}', open: {$open} ,target:'_self' {$font_style}}";
        }
    }
    $json = implode(",\n", $data);

    $Ztree = new Ztree('cate_tree', $json, 'tad_meeting_cate_save_drag.php', 'tad_meeting_cate_save_sort.php', 'tad_meeting_cate_parent_sn', 'tad_meeting_cate_sn');
    $ztree_code = $Ztree->render();
    $xoopsTpl->assign('ztree_code', $ztree_code);
    $xoopsTpl->assign('cate_count', $cate_count);

    return $data;
}

//取得tad_meeting_cate所有資料陣列
function get_tad_meeting_cate_all()
{
    global $xoopsDB;
    $sql = 'SELECT * FROM `' . $xoopsDB->prefix('tad_meeting_cate') . '`';
    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);

    $data_arr = [];
    while (false !== ($data = $xoopsDB->fetchArray($result))) {
        $tad_meeting_cate_sn = $data['tad_meeting_cate_sn'];
        $data_arr[$tad_meeting_cate_sn] = $data;
    }

    return $data_arr;
}

//tad_meeting_cate編輯表單
function tad_meeting_cate_form($tad_meeting_cate_sn = '')
{
    global $xoopsTpl, $xoopsModule, $tad_meeting_adm;
    if (!$tad_meeting_adm) {
        redirect_header($_SERVER['PHP_SELF'], 3, _TAD_PERMISSION_DENIED);
    }

    //抓取預設值
    if (!empty($tad_meeting_cate_sn)) {
        $DBV = get_tad_meeting_cate($tad_meeting_cate_sn);
    } else {
        $DBV = [];
    }

    //預設值設定

    //設定 tad_meeting_cate_sn 欄位的預設值
    $tad_meeting_cate_sn = !isset($DBV['tad_meeting_cate_sn']) ? $tad_meeting_cate_sn : $DBV['tad_meeting_cate_sn'];
    $xoopsTpl->assign('tad_meeting_cate_sn', $tad_meeting_cate_sn);
    //設定 tad_meeting_cate_parent_sn 欄位的預設值
    $tad_meeting_cate_parent_sn = !isset($DBV['tad_meeting_cate_parent_sn']) ? '' : $DBV['tad_meeting_cate_parent_sn'];
    $xoopsTpl->assign('tad_meeting_cate_parent_sn', $tad_meeting_cate_parent_sn);
    //設定 tad_meeting_cate_title 欄位的預設值
    $tad_meeting_cate_title = !isset($DBV['tad_meeting_cate_title']) ? '' : $DBV['tad_meeting_cate_title'];
    $xoopsTpl->assign('tad_meeting_cate_title', $tad_meeting_cate_title);
    //設定 tad_meeting_cate_desc 欄位的預設值
    $tad_meeting_cate_desc = !isset($DBV['tad_meeting_cate_desc']) ? '' : $DBV['tad_meeting_cate_desc'];
    $xoopsTpl->assign('tad_meeting_cate_desc', $tad_meeting_cate_desc);
    //設定 tad_meeting_cate_sort 欄位的預設值
    $tad_meeting_cate_sort = !isset($DBV['tad_meeting_cate_sort']) ? tad_meeting_cate_max_sort() : $DBV['tad_meeting_cate_sort'];
    $xoopsTpl->assign('tad_meeting_cate_sort', $tad_meeting_cate_sort);
    //設定 tad_meeting_cate_enable 欄位的預設值
    $tad_meeting_cate_enable = !isset($DBV['tad_meeting_cate_enable']) ? '1' : $DBV['tad_meeting_cate_enable'];
    $xoopsTpl->assign('tad_meeting_cate_enable', $tad_meeting_cate_enable);

    $op = empty($tad_meeting_cate_sn) ? 'insert_tad_meeting_cate' : 'update_tad_meeting_cate';
    //$op = "replace_tad_meeting_cate";

    $FormValidator = new FormValidator('#myForm', true);
    $FormValidator->render();

    //加入Token安全機制
    require_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';
    $token = new \XoopsFormHiddenToken();
    $token_form = $token->render();
    $xoopsTpl->assign('token_form', $token_form);
    $xoopsTpl->assign('action', $_SERVER['PHP_SELF']);
    $xoopsTpl->assign('next_op', $op);

    $mod_id = $xoopsModule->mid();
    $modulepermHandler = xoops_getHandler('groupperm');

    //可見群組
    $read_group = $modulepermHandler->getGroupIds('view_meeting', $tad_meeting_cate_sn, $mod_id);
    if (empty($read_group)) {
        $read_group = [1, 2, 3];
    }

    $SelectGroup_name = new \XoopsFormSelectGroup('view_group', 'view_meeting', true, $read_group, 6, true);
    $SelectGroup_name->setExtra("class='form-control' id='view_group'");
    $enable_group = $SelectGroup_name->render();
    $xoopsTpl->assign('enable_group', $enable_group);

    //可建立群組
    $create_group = $modulepermHandler->getGroupIds('create_meeting', $tad_meeting_cate_sn, $mod_id);
    if (empty($create_group)) {
        $create_group = [1];
    }

    $SelectGroup_name = new \XoopsFormSelectGroup('create_group', 'create_meeting', true, $create_group, 6, true);
    $SelectGroup_name->setExtra("class='form-control' id='create_group'");
    $enable_create_group = $SelectGroup_name->render();
    $xoopsTpl->assign('enable_create_group', $enable_create_group);

    //可上傳群組
    $post_group = $modulepermHandler->getGroupIds('post_meeting', $tad_meeting_cate_sn, $mod_id);
    if (empty($post_group)) {
        $post_group = [1];
    }

    $SelectGroup_name = new \XoopsFormSelectGroup('post_group', 'post_meeting', true, $post_group, 6, true);
    $SelectGroup_name->setExtra("class='form-control' id='post_group'");
    $enable_post_group = $SelectGroup_name->render();
    $xoopsTpl->assign('enable_post_group', $enable_post_group);

    //可排序群組
    $sort_group = $modulepermHandler->getGroupIds('sort_meeting', $tad_meeting_cate_sn, $mod_id);
    if (empty($sort_group)) {
        $sort_group = [1];
    }

    $SelectGroup_name = new \XoopsFormSelectGroup('sort_group', 'sort_meeting', true, $sort_group, 6, true);
    $SelectGroup_name->setExtra("class='form-control' id='sort_group'");
    $enable_sort_group = $SelectGroup_name->render();
    $xoopsTpl->assign('enable_sort_group', $enable_sort_group);

}

//自動取得tad_meeting_cate的最新排序
function tad_meeting_cate_max_sort()
{
    global $xoopsDB;
    $sql = 'SELECT MAX(`tad_meeting_cate_sort`) FROM `' . $xoopsDB->prefix('tad_meeting_cate') . '`';
    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);

    list($sort) = $xoopsDB->fetchRow($result);

    return ++$sort;
}

//新增資料到tad_meeting_cate中
function insert_tad_meeting_cate()
{
    global $xoopsDB, $tad_meeting_adm;
    if (!$tad_meeting_adm) {
        redirect_header($_SERVER['PHP_SELF'], 3, _TAD_PERMISSION_DENIED);
    }

    //XOOPS表單安全檢查
    if ($_SERVER['SERVER_ADDR'] != '127.0.0.1' && !$GLOBALS['xoopsSecurity']->check()) {
        $error = implode('<br>', $GLOBALS['xoopsSecurity']->getErrors());
        redirect_header($_SERVER['PHP_SELF'], 3, $error);
    }

    $tad_meeting_cate_sn = Request::getInt('tad_meeting_cate_sn');
    $tad_meeting_cate_parent_sn = Request::getInt('tad_meeting_cate_parent_sn');
    $tad_meeting_cate_title = Request::getString('tad_meeting_cate_title');
    $tad_meeting_cate_desc = Request::getString('tad_meeting_cate_desc');
    $tad_meeting_cate_sort = Request::getInt('tad_meeting_cate_sort');
    $tad_meeting_cate_enable = Request::getInt('tad_meeting_cate_enable');

    $sql = 'INSERT INTO `' . $xoopsDB->prefix('tad_meeting_cate') . '` (
        `tad_meeting_cate_parent_sn`,
        `tad_meeting_cate_title`,
        `tad_meeting_cate_desc`,
        `tad_meeting_cate_sort`,
        `tad_meeting_cate_enable`
    ) VALUES(
        ?, ?, ?, ?, ?
    )';
    Utility::query($sql, 'issis', [$tad_meeting_cate_parent_sn, $tad_meeting_cate_title, $tad_meeting_cate_desc, $tad_meeting_cate_sort, $tad_meeting_cate_enable]) or Utility::web_error($sql, __FILE__, __LINE__);

    //取得最後新增資料的流水編號
    $tad_meeting_cate_sn = $xoopsDB->getInsertId();

    $view_meeting = Request::getArray('view_meeting');
    $post_meeting = Request::getArray('post_meeting');
    Utility::save_perm($view_meeting, $tad_meeting_cate_sn, 'view_meeting');
    Utility::save_perm($post_meeting, $tad_meeting_cate_sn, 'post_meeting');

    return $tad_meeting_cate_sn;
}

//更新tad_meeting_cate某一筆資料
function update_tad_meeting_cate($tad_meeting_cate_sn = '')
{
    global $xoopsDB, $tad_meeting_adm;
    if (!$tad_meeting_adm) {
        redirect_header($_SERVER['PHP_SELF'], 3, _TAD_PERMISSION_DENIED);
    }

    //XOOPS表單安全檢查
    if ($_SERVER['SERVER_ADDR'] != '127.0.0.1' && !$GLOBALS['xoopsSecurity']->check()) {
        $error = implode('<br>', $GLOBALS['xoopsSecurity']->getErrors());
        redirect_header($_SERVER['PHP_SELF'], 3, $error);
    }

    $tad_meeting_cate_sn = Request::getInt('tad_meeting_cate_sn');
    $tad_meeting_cate_parent_sn = Request::getInt('tad_meeting_cate_parent_sn');
    $tad_meeting_cate_title = Request::getString('tad_meeting_cate_title');
    $tad_meeting_cate_desc = Request::getString('tad_meeting_cate_desc');
    $tad_meeting_cate_sort = Request::getInt('tad_meeting_cate_sort');
    $tad_meeting_cate_enable = Request::getInt('tad_meeting_cate_enable');

    $sql = 'UPDATE `' . $xoopsDB->prefix('tad_meeting_cate') . '` SET
    `tad_meeting_cate_parent_sn` = ?,
    `tad_meeting_cate_title` = ?,
    `tad_meeting_cate_desc` = ?,
    `tad_meeting_cate_sort` = ?,
    `tad_meeting_cate_enable` = ?
    WHERE `tad_meeting_cate_sn` = ?';
    Utility::query($sql, 'issisi', [$tad_meeting_cate_parent_sn, $tad_meeting_cate_title, $tad_meeting_cate_desc, $tad_meeting_cate_sort, $tad_meeting_cate_enable, $tad_meeting_cate_sn]) or Utility::web_error($sql, __FILE__, __LINE__);

    $view_meeting = Request::getArray('view_meeting');
    $post_meeting = Request::getArray('post_meeting');
    Utility::save_perm($view_meeting, $tad_meeting_cate_sn, 'view_meeting');
    Utility::save_perm($post_meeting, $tad_meeting_cate_sn, 'post_meeting');
    return $tad_meeting_cate_sn;
}

//刪除tad_meeting_cate某筆資料資料
function delete_tad_meeting_cate($tad_meeting_cate_sn = '')
{
    global $xoopsDB, $tad_meeting_adm;
    if (!$tad_meeting_adm) {
        redirect_header($_SERVER['PHP_SELF'], 3, _TAD_PERMISSION_DENIED);
    }

    if (empty($tad_meeting_cate_sn)) {
        return;
    }

    $sql = 'DELETE FROM `' . $xoopsDB->prefix('tad_meeting_cate') . '` WHERE `tad_meeting_cate_sn` = ?';
    Utility::query($sql, 'i', [$tad_meeting_cate_sn]) or Utility::web_error($sql, __FILE__, __LINE__);
}
