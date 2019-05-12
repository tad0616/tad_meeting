<?php
use XoopsModules\Tadtools\Utility;

//區塊主函式 (tad_meeting_show1)
function tad_meeting_show1($options)
{
    global $xoopsDB;

    //{$options[0]} : 顯示資料數
    $block['options0'] = $options[0];
    $limit = empty($options[0]) ? 5 : $options[0];
    $sql = 'SELECT * FROM `' . $xoopsDB->prefix('tad_meeting') . "` ORDER BY `tad_meeting_datetime` DESC limit 0,$limit";
    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);
    $content = [];
    $i = 0;
    while (false !== ($all = $xoopsDB->fetchArray($result))) {
        $content[$i] = $all;
        $i++;
    }
    $block['content'] = $content;

    return $block;
}

//區塊編輯函式 (tad_meeting_show1_edit)
function tad_meeting_show1_edit($options)
{
    $form = "
    <ol class='my-form'>
        <li class='my-row'>
            <lable class='my-label'>" . _MB_TAD_MEETING_SHOW1_OPT0 . "</lable>
            <div class='my-content'>
                <input type='text' class='my-input' name='options[0]' value='{$options[0]}' size=6>
            </div>
        </li>
    </ol>";

    return $form;
}
