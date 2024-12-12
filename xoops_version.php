<?php
$modversion = [];
global $xoopsConfig;

//---模組基本資訊---//
$modversion['name'] = _MI_TADMEETIN_NAME;
// $modversion['version'] = '2.7';
$modversion['version'] = $_SESSION['xoops_version'] >= 20511 ? '3.0.0-Stable' : '3.0';
$modversion['description'] = _MI_TADMEETIN_DESC;
$modversion['author'] = _MI_TADMEETIN_AUTHOR;
$modversion['credits'] = _MI_TADMEETIN_CREDITS;
$modversion['help'] = 'page=help';
$modversion['license'] = 'GPL see LICENSE';
$modversion['image'] = 'images/logo.png';
$modversion['dirname'] = basename(__DIR__);

//---模組狀態資訊---//
$modversion['release_date'] = '2024-12-12';
$modversion['module_website_url'] = 'https://tad0616.net';
$modversion['module_website_name'] = _MI_TADMEETIN_AUTHOR_WEB;
$modversion['module_status'] = 'release';
$modversion['author_website_url'] = 'https://tad0616.net';
$modversion['author_website_name'] = _MI_TADMEETIN_AUTHOR_WEB;
$modversion['min_php'] = '5.4';
$modversion['min_xoops'] = '2.5.10';

//---paypal資訊---//
$modversion['paypal'] = [
    'business' => 'tad0616@gmail.com',
    'item_name' => 'Donation : ' . _MI_TAD_WEB,
    'amount' => 0,
    'currency_code' => 'USD',
];

//---安裝設定---//
$modversion['onInstall'] = 'include/onInstall.php';
$modversion['onUpdate'] = 'include/onUpdate.php';
$modversion['onUninstall'] = 'include/onUninstall.php';

//---啟動後台管理界面選單---//
$modversion['system_menu'] = 1;

//---資料表架構---//
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';
$modversion['tables'] = [
    'tad_meeting',
    'tad_meeting_cate',
    'tad_meeting_data',
    'tad_meeting_files_center',
];

//---管理介面設定---//
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = 'admin/main.php';
$modversion['adminmenu'] = 'admin/menu.php';

//---使用者主選單設定---//
$modversion['hasMain'] = 1;
$i = 0;

//---搜尋設定---//
$modversion['hasSearch'] = 1;
$modversion['search']['file'] = 'include/tad_meeting_search.php';
$modversion['search']['func'] = 'tad_meeting_search';
$modversion['templates'] = [
    ['file' => 'tad_meeting_admin.tpl', 'description' => 'tad_meeting_admin.tpl'],
    ['file' => 'tad_meeting_index.tpl', 'description' => 'tad_meeting_index.tpl'],
    ['file' => 'tad_meeting_power.tpl', 'description' => 'tad_meeting_power.tpl'],
];

$modversion['blocks'] = [
    1 => [
        'file' => 'tad_meeting_show1.php',
        'name' => _MI_TAD_MEETING_SHOW1_BLOCK_NAME,
        'description' => _MI_TAD_MEETING_SHOW1_BLOCK_DESC,
        'show_func' => 'tad_meeting_show1',
        'template' => 'tad_meeting_show1.tpl',
        'edit_func' => 'tad_meeting_show1_edit',
        'options' => '5|0',
    ],
];

$modversion['config'] = [
    ['name' => 'meeting_place', 'title' => '_MI_TADMEETIN_MEETING_PLACE', 'description' => '_MI_TADMEETIN_MEETING_PLACE_DESC', 'formtype' => 'textbox', 'valuetype' => 'text', 'default' => _MI_TADMEETIN_MEETING_PLACE_DEFAULT],
    ['name' => 'meeting_unit', 'title' => '_MI_TADMEETIN_MEETING_UNIT', 'description' => '_MI_TADMEETIN_MEETING_UNIT_DESC', 'formtype' => 'textbox', 'valuetype' => 'text', 'default' => _MI_TADMEETIN_MEETING_UNIT_DEFAULT],
    ['name' => 'meeting_job', 'title' => '_MI_TADMEETIN_MEETING_JOB', 'description' => '_MI_TADMEETIN_MEETING_JOB_DESC', 'formtype' => 'textbox', 'valuetype' => 'text', 'default' => _MI_TADMEETIN_MEETING_JOB_DEFAULT],
    ['name' => 'file_title', 'title' => '_MI_TADMEETIN_FILE_TITLE', 'description' => '_MI_TADMEETIN_FILE_TITLE_DESC', 'formtype' => 'textbox', 'valuetype' => 'text', 'default' => _MI_TADMEETIN_FILE_TITLE_DEFAULT],
    ['name' => 'orderby', 'title' => '_MI_TADMEETIN_ORDERBY', 'description' => '_MI_TADMEETIN_ORDERBY_DESC', 'formtype' => 'select', 'valuetype' => 'text', 'default' => 'auto', 'options' => ['_MI_TADMEETIN_ORDERBY_OPT1' => 'auto', '_MI_TADMEETIN_ORDERBY_OPT2' => 'tad_meeting_data_sort']],
];
