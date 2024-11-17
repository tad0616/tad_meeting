<?php
//判斷是否對該模組有管理權限
if (!isset($tad_meeting_adm)) {
    $tad_meeting_adm = isset($xoopsUser) && \is_object($xoopsUser) ? $xoopsUser->isAdmin() : false;
}

$interface_menu[_MD_TADMEETIN_INDEX] = 'index.php';
$interface_icon[_MD_TADMEETIN_INDEX] = 'fa-users';
