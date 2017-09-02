<?php
include_once "../../mainfile.php";
include_once "function.php";

//判斷目前使用者是否有：觀看會議內容
$read_report = power_chk("tad_meeting", 3);
if (!$read_report) {
    redirect_header('index.php', 3, _TAD_PERMISSION_DENIED);
}

set_time_limit(0);
ini_set("memory_limit", "150M");

$tad_meeting_sn = (int)$_REQUEST['tad_meeting_sn'];

$tad_meeting = get_tad_meeting($tad_meeting_sn);

//取得分類資料(tad_meeting_cate)
$tad_meeting_cate_arr = get_tad_meeting_cate($tad_meeting['tad_meeting_cate_sn']);

$page_title = "{$xoopsModuleConfig['file_title']}{$tad_meeting['tad_meeting_title']}";
$filename   = str_replace(" ", "", $page_title);

require_once XOOPS_ROOT_PATH . '/modules/tadtools/tcpdf/tcpdf.php';
$pdf = new TCPDF('PDF_PAGE_ORIENTATION', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->setPrintHeader(false); //不要頁首
$pdf->setPrintFooter(false); //不要頁尾
$pdf->SetMargins(15, 15);
$pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM); //設定自動分頁
$pdf->setLanguageArray($l); //設定語言相關字串
$pdf->setFontSubsetting(true); //產生字型子集（有用到的字才放到文件中）
$pdf->SetFont('droidsansfallback', '', 12, '', true); //設定字型
$pdf->AddPage(); //新增頁面
//$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));//文字陰影

$pdf->SetFont('droidsansfallback', '', 16, '', true); //設定字型
$pdf->Cell(180, 20, $page_title, 0, 1, 'C');

$pdf->SetFont('droidsansfallback', '', 12, '', true); //設定字型
$pdf->MultiCell(30, 10, _MD_TADMEETIN_TAD_MEETING_CATE_SN, 1, 'C', false, 0, null, null, true, 0, false, true, 12, 'M', null, null, true, 0, false, true, 12, 'M');
$pdf->MultiCell(60, 10, $tad_meeting_cate_arr['tad_meeting_cate_title'], 1, 'C', false, 0, null, null, true, 0, false, true, 12, 'M', null, null, true, 0, false, true, 12, 'M');
$pdf->MultiCell(30, 10, _MD_TADMEETIN_TAD_MEETING_DATETIME, 1, 'C', false, 0, null, null, true, 0, false, true, 12, 'M');
$pdf->MultiCell(60, 10, $tad_meeting['tad_meeting_datetime'], 1, 'C', false, 1, null, null, true, 0, false, true, 12, 'M');

$pdf->MultiCell(30, 10, _MD_TADMEETIN_TAD_MEETING_PLACE, 1, 'C', false, 0, null, null, true, 0, false, true, 12, 'M');
$pdf->MultiCell(60, 10, $tad_meeting['tad_meeting_place'], 1, 'C', false, 0, null, null, true, 0, false, true, 12, 'M');
$pdf->MultiCell(30, 10, _MD_TADMEETIN_TAD_MEETING_CHAIRMAN, 1, 'C', false, 0, null, null, true, 0, false, true, 12, 'M');
$pdf->MultiCell(60, 10, $tad_meeting['tad_meeting_chairman'], 1, 'C', false, 1, null, null, true, 0, false, true, 12, 'M');

$pdf->Ln(2);

$meeting_data = list_tad_meeting_data($tad_meeting_sn, "return", 'file_url');
foreach ($meeting_data as $data) {
    $pdf->SetFont('droidsansfallback', '', 12, '', true); //設定字型
    $pdf->setCellHeightRatio(1);
    $pdf->MultiCell(180, 11, $data['number2chinese'] . _MD_TADMEETIN_COMMA . $data['tad_meeting_data_title'], 0, 'L', false, 1, null, null, true, 0, false, true, 12, 'M');

    $pdf->SetFont('droidsansfallback', '', 10, '', true); //設定字型
    $pdf->setCellHeightRatio(1.8);
    $tad_meeting_data_content = $data['tad_meeting_data_content'] ? $data['tad_meeting_data_content'] : _MD_TADMEETIN_NONE;
    $pdf->MultiCell(172, 13, $tad_meeting_data_content, 0, 'J', false, 1, $pdf->GetX() + 8, null, true, 0, false, true);

    if ($data['list_file']) {
        $pdf->SetFont('droidsansfallback', '', 10, '', true); //設定字型
        $pdf->setCellHeightRatio(1.5);
        $pdf->writeHTMLCell(172, 13, $pdf->GetX(), $pdf->GetY(), $data['list_file'], 0, 1, false);
    } else {
        $pdf->Ln(2);
    }
}
$filename = iconv('UTF-8', 'Big5', $filename);
$pdf->Output("{$filename}.pdf", 'D');
