<?php
//會議系統搜尋程式
function tad_meeting_search($queryarray, $andor, $limit, $offset, $userid)
{
    global $xoopsDB;
    if (get_magic_quotes_gpc()) {
        foreach ($queryarray as $k => $v) {
            $arr[$k] = addslashes($v);
        }
        $queryarray = $arr;
    }
    $sql = 'SELECT `tad_meeting_sn`,`tad_meeting_data_sn`,`tad_meeting_data_title`,`tad_meeting_data_date`, `tad_meeting_data_uid` FROM ' . $xoopsDB->prefix('tad_meeting_data') . ' WHERE 1';
    if (0 != $userid) {
        $sql .= ' AND uid=' . $userid . ' ';
    }
    if (is_array($queryarray) && $count = count($queryarray)) {
        $sql .= " AND ((`tad_meeting_data_title` LIKE '%{$queryarray[0]}%'  OR `tad_meeting_data_content` LIKE '%{$queryarray[0]}%' OR  `tad_meeting_data_unit` LIKE '%{$queryarray[0]}%')";
        for ($i = 1; $i < $count; $i++) {
            $sql .= " $andor ";
            $sql .= "(`tad_meeting_data_title` LIKE '%{$queryarray[$i]}%' OR  `tad_meeting_data_content` LIKE '%{$queryarray[$i]}%'  OR  `tad_meeting_data_unit` LIKE '%{$queryarray[$i]}%')";
        }
        $sql .= ') ';
    }
    $sql .= 'ORDER BY  `tad_meeting_data_date` DESC';
    $result = $xoopsDB->query($sql, $limit, $offset);
    $ret = [];
    $i = 0;
    while ($myrow = $xoopsDB->fetchArray($result)) {
        $ret[$i]['image'] = 'images/layout_sidebar.png';
        $ret[$i]['link'] = 'index.php?tad_meeting_sn=' . $myrow['tad_meeting_sn'];
        $ret[$i]['title'] = $myrow['tad_meeting_data_title'];
        $ret[$i]['time'] = strtotime($myrow['tad_meeting_data_date']);
        $ret[$i]['uid'] = $myrow['tad_meeting_data_uid'];
        $i++;
    }

    return $ret;
}
