<?php

/**
 * T module
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright  XOOPS Project (https://xoops.org)
 * @license    http://www.fsf.org/copyleft/gpl.html GNU public license
 * @package    T
 * @since      t
 * @author     t
 * @version    $Id $
 * @param mixed $options
 *
 * @return mixed
 */

//區塊主函式 (tad_meeting_show1)
function tad_meeting_show1($options)
{
    global $xoopsDB;

    //{$options[0]} : 顯示資料數
    $block['options0'] = $options[0];
    $limit = empty($options[0]) ? 5 : $options[0];
    $sql = 'SELECT * FROM `' . $xoopsDB->prefix('tad_meeting') . "` ORDER BY `tad_meeting_datetime` DESC limit 0,$limit";
    $result = $xoopsDB->query($sql) or web_error($sql, __FILE__, __LINE__);
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
