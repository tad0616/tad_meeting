<?php
use XoopsModules\Tadtools\Utility;

//區塊主函式 (tad_meeting_show1)
function tad_meeting_show1($options)
{
    global $xoopsDB;

    //{$options[0]} : 顯示資料數
    $today = date('Y-m-d 00:00:00');
    $after_today = $options[1] ? "WHERE tad_meeting_datetime >= ?" : '';

    $limit = empty($options[0]) ? 5 : (int) $options[0];
    $sql = "SELECT * FROM `" . $xoopsDB->prefix('tad_meeting') . "` $after_today ORDER BY `tad_meeting_datetime` DESC LIMIT 0, ?";

    $params = $options[1] ? [$today, $limit] : [$limit];
    $types = $options[1] ? 'si' : 'i';
    $result = Utility::query($sql, $types, $params) or Utility::web_error($sql, __FILE__, __LINE__);

    $block = [];
    $i = 0;
    while (false !== ($all = $xoopsDB->fetchArray($result))) {
        $block[$i] = $all;
        $i++;
    }

    return $block;
}

//區塊編輯函式 (tad_meeting_show1_edit)
function tad_meeting_show1_edit($options)
{
    $options1_1 = $options[1] == 1 ? 'checked' : '';
    $options1_0 = $options[1] == 0 ? 'checked' : '';

    $form = "
    <ol class='my-form'>
        <li class='my-row'>
            <lable class='my-label'>" . _MB_TAD_MEETING_SHOW1_OPT0 . "</lable>
            <div class='my-content'>
                <input type='text' class='my-input' name='options[0]' value='{$options[0]}' size=6>
            </div>
        </li>
        <li class='my-row'>
            <lable class='my-label'>" . _MB_TAD_MEETING_SHOW1_OPT1 . "</lable>
            <div class='my-content'>
                <div class='form-check-inline radio-inline'>
                    <label class='form-check-label'>
                        <input class='form-check-input' type='radio' name='options[1]' value='1' $options1_1>
                        " . _YES . "
                    </label>
                </div>
                <div class='form-check-inline radio-inline'>
                    <label class='form-check-label'>
                        <input class='form-check-input' type='radio' name='options[1]' value='0' $options1_0>
                        " . _NO . "
                    </label>
                </div>
            </div>
        </li>
    </ol>";

    return $form;
}
