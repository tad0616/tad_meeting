<?php
use XoopsModules\Tadtools\Utility;

require_once dirname(dirname(__DIR__)) . '/mainfile.php';
require_once __DIR__ . '/function.php';

//判斷目前使用者是否有：觀看會議內容
$read_report = Utility::power_chk('tad_meeting', 3);
if (!$read_report) {
    redirect_header('index.php', 3, _TAD_PERMISSION_DENIED);
}

$tad_meeting_sn = (int)$_REQUEST['tad_meeting_sn'];

$tad_meeting = get_tad_meeting($tad_meeting_sn);

//取得分類資料(tad_meeting_cate)
$tad_meeting_cate_arr = get_tad_meeting_cate($tad_meeting['tad_meeting_cate_sn']);

$page_title = "{$xoopsModuleConfig['file_title']}{$tad_meeting['tad_meeting_title']}";
$filename = str_replace(' ', '', $page_title);

require_once XOOPS_ROOT_PATH . '/modules/tadtools/PHPWord.php';
$PHPWord = new PHPWord();
$PHPWord->setDefaultFontName('標楷體'); //設定預設字型
$PHPWord->setDefaultFontSize(11); //設定預設字型大小
$section = $PHPWord->createSection($sectionStyle); //建立一個頁面

$h1Style = ['color' => '000000', 'size' => 18, 'bold' => true]; //文字樣式設定
$h1aragraph = ['align' => 'both', 'spaceAfter' => 300]; //段落設定
$PHPWord->addTitleStyle(1, $h1Style, $h1aragraph); //設定標題樣式

$h2Style = ['color' => '000000', 'size' => 14, 'bold' => true]; //文字樣式設定
$h2Paragraph = ['align' => 'both', 'spaceAfter' => 100]; //段落設定
$PHPWord->addTitleStyle(2, $h2Style, $h2Paragraph); //設定標題樣式

$section->addTitle($page_title, 1); //新增標題

$styleTable = ['borderColor' => '000000', 'borderSize' => 1, 'cellMargin' => 50]; //表格樣式
$PHPWord->addTableStyle('myTable', $styleTable); //建立表格樣式
$table = $section->addTable('myTable'); //建立表格
// $cellStyle = array('textDirection' => PHPWord_Style_Cell::TEXT_DIR_BTLR, 'bgColor' => 'FFFFFF'); //儲存格樣式

$cellStyle = ['valign' => 'center']; //儲存格樣式（設定項：valign、textDirection、bgColor、borderTopSize、bord
$headStyle = ['color' => '000000', 'size' => 12, 'bold' => true]; //文字樣式設定
$fontStyle = ['color' => '000000', 'size' => 12, 'bold' => false]; //文字樣式設定
$contentfontStyle = ['color' => '000000', 'size' => 11, 'bold' => false]; //文字樣式設定
$paraStyle = ['align' => 'center'];

$table->addRow(); //新增一列
$table->addCell(1500, $cellStyle)->addText(_MD_TADMEETIN_TAD_MEETING_CATE_SN, $headStyle, $paraStyle);
$table->addCell(3100, $cellStyle)->addText($tad_meeting_cate_arr['tad_meeting_cate_title'], $fontStyle, $paraStyle);
$table->addCell(1500, $cellStyle)->addText(_MD_TADMEETIN_TAD_MEETING_DATETIME, $headStyle, $paraStyle);
$table->addCell(3100, $cellStyle)->addText($tad_meeting['tad_meeting_datetime'], $fontStyle, $paraStyle);

$table->addRow(); //新增一列
$table->addCell(1500, $cellStyle)->addText(_MD_TADMEETIN_TAD_MEETING_PLACE, $headStyle, $paraStyle);
$table->addCell(3100, $cellStyle)->addText($tad_meeting['tad_meeting_place'], $fontStyle, $paraStyle);
$table->addCell(1500, $cellStyle)->addText(_MD_TADMEETIN_TAD_MEETING_CHAIRMAN, $headStyle, $paraStyle);
$table->addCell(3100, $cellStyle)->addText($tad_meeting['tad_meeting_chairman'], $fontStyle, $paraStyle);
$section->addTextBreak(1);
$meeting_data = list_tad_meeting_data($tad_meeting_sn, 'return', 'file_text_url');

$paragraphStyle = ['indentLeft' => 550];
$listParagraphStyle = ['align' => 'left', 'spaceBefore' => '0', 'indentLeft' => 900];
// $styleTable         = array('borderColor' => 'ffffff', 'borderSize' => 0, 'cellMargin' => 50); //表格樣式
$listStyle = ['listType' => PHPWord_Style_ListItem::TYPE_BULLET_FILLED, 'spaceAfter' => 0, 'spaceBefore' => 0, 'spacing' => 0];
foreach ($meeting_data as $i => $data) {
    $section->addTitle($data['number2chinese'] . _MD_TADMEETIN_COMMA . $data['tad_meeting_data_title'], 2);

    $tad_meeting_data_content = $data['tad_meeting_data_content'] ?: _MD_TADMEETIN_NONE;

    $section->addText($tad_meeting_data_content, $contentfontStyle, $paragraphStyle); //新增文字段落

    if ($data['list_file']) {
        $section->addTextBreak(1);
        $list_file = explode(',', $data['list_file']);
        foreach ($list_file as $list) {
            if ($list) {
                $section->addListItem($list, 0, $contentfontStyle, $listStyle, $listParagraphStyle); //新增清單項目
            }
        }
    }
    $section->addTextBreak(1);
}

//內容設定
$filename = iconv('UTF-8', 'Big5', $filename);
header('Content-Type: application/vnd.ms-word');
header("Content-Disposition: attachment;filename={$filename}.docx");
header('Cache-Control: max-age=0');
$objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
$objWriter->save('php://output');
