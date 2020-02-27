<?php
$modversion = [];

//---模組基本資訊---//
$modversion['name'] = _MI_TADMEETIN_NAME;
$modversion['version'] = '2.1';
$modversion['description'] = _MI_TADMEETIN_DESC;
$modversion['author'] = _MI_TADMEETIN_AUTHOR;
$modversion['credits'] = _MI_TADMEETIN_CREDITS;
$modversion['help'] = 'page=help';
$modversion['license'] = 'GPL see LICENSE';
$modversion['image'] = 'images/logo.png';
$modversion['dirname'] = basename(__DIR__);

//---模組狀態資訊---//
$modversion['status_version'] = '2.1';
$modversion['release_date'] = '2020/02/27';
$modversion['module_website_url'] = 'https://tad0616.net';
$modversion['module_website_name'] = _MI_TADMEETIN_AUTHOR_WEB;
$modversion['module_status'] = 'release';
$modversion['author_website_url'] = 'https://tad0616.net';
$modversion['author_website_name'] = _MI_TADMEETIN_AUTHOR_WEB;
$modversion['min_php'] = '5.4';
$modversion['min_xoops'] = '2.5';

//---paypal資訊---//
$modversion['paypal'] = [];
$modversion['paypal']['business'] = 'tad0616@gmail.com';
$modversion['paypal']['item_name'] = 'Donation :' . _MI_TADMEETIN_AUTHOR;
$modversion['paypal']['amount'] = 0;
$modversion['paypal']['currency_code'] = 'USD';

//---安裝設定---//
$modversion['onInstall'] = 'include/onInstall.php';
$modversion['onUpdate'] = 'include/onUpdate.php';
$modversion['onUninstall'] = 'include/onUninstall.php';

//---啟動後台管理界面選單---//
$modversion['system_menu'] = 1;

//---資料表架構---//
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';
$modversion['tables'][1] = 'tad_meeting';
$modversion['tables'][2] = 'tad_meeting_cate';
$modversion['tables'][3] = 'tad_meeting_data';
$modversion['tables'][4] = 'tad_meeting_files_center';

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

//---樣板設定---//
$i = 0;
$modversion['templates'][$i]['file'] = 'tad_meeting_adm_main.tpl';
$modversion['templates'][$i]['description'] = 'tad_meeting_adm_main.tpl for bootstrap3';

$i++;
$modversion['templates'][$i]['file'] = 'tad_meeting_index.tpl';
$modversion['templates'][$i]['description'] = 'tad_meeting_index.tpl';

$i++;
$modversion['templates'][$i]['file'] = 'tad_meeting_adm_groupperm.tpl';
$modversion['templates'][$i]['description'] = 'tad_meeting_adm_groupperm.tpl';

//---區塊設定---//
$i = 0;
$i++;
$modversion['blocks'][$i]['file'] = 'tad_meeting_show1.php';
$modversion['blocks'][$i]['name'] = _MI_TAD_MEETING_SHOW1_BLOCK_NAME;
$modversion['blocks'][$i]['description'] = _MI_TAD_MEETING_SHOW1_BLOCK_DESC;
$modversion['blocks'][$i]['show_func'] = 'tad_meeting_show1';
$modversion['blocks'][$i]['template'] = 'tad_meeting_show1.tpl';
$modversion['blocks'][$i]['edit_func'] = 'tad_meeting_show1_edit';
$modversion['blocks'][$i]['options'] = '5';

//---偏好設定---//
$i = 0;
$i++;
$modversion['config'][$i]['name'] = 'meeting_place';
$modversion['config'][$i]['title'] = '_MI_TADMEETIN_MEETING_PLACE';
$modversion['config'][$i]['description'] = '_MI_TADMEETIN_MEETING_PLACE_DESC';
$modversion['config'][$i]['formtype'] = 'textbox';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = _MI_TADMEETIN_MEETING_PLACE_DEFAULT;

$i++;
$modversion['config'][$i]['name'] = 'meeting_unit';
$modversion['config'][$i]['title'] = '_MI_TADMEETIN_MEETING_UNIT';
$modversion['config'][$i]['description'] = '_MI_TADMEETIN_MEETING_UNIT_DESC';
$modversion['config'][$i]['formtype'] = 'textbox';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = _MI_TADMEETIN_MEETING_UNIT_DEFAULT;

$i++;
$modversion['config'][$i]['name'] = 'meeting_job';
$modversion['config'][$i]['title'] = '_MI_TADMEETIN_MEETING_JOB';
$modversion['config'][$i]['description'] = '_MI_TADMEETIN_MEETING_JOB_DESC';
$modversion['config'][$i]['formtype'] = 'textbox';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = _MI_TADMEETIN_MEETING_JOB_DEFAULT;

$i++;
$modversion['config'][$i]['name'] = 'file_title';
$modversion['config'][$i]['title'] = '_MI_TADMEETIN_FILE_TITLE';
$modversion['config'][$i]['description'] = '_MI_TADMEETIN_FILE_TITLE_DESC';
$modversion['config'][$i]['formtype'] = 'textbox';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = _MI_TADMEETIN_FILE_TITLE_DEFAULT;

$i++;
$modversion['config'][$i]['name'] = 'orderby';
$modversion['config'][$i]['title'] = '_MI_TADMEETIN_ORDERBY';
$modversion['config'][$i]['description'] = '_MI_TADMEETIN_ORDERBY_DESC';
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = 'auto';
$modversion['config'][$i]['options'] = ['_MI_TADMEETIN_ORDERBY_OPT1' => 'auto', '_MI_TADMEETIN_ORDERBY_OPT2' => 'tad_meeting_data_sort'];
