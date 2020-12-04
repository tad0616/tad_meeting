<?php

namespace XoopsModules\Tad_meeting;

/*
Update Class Definition

You may not change or alter any portion of this comment or credits of
supporting developers from this source code or any supporting source code
which is considered copyrighted (c) material of the original comment or credit
authors.

This program is distributed in the hope that it will be useful, but
WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * @license      http://www.fsf.org/copyleft/gpl.html GNU public license
 * @copyright    https://xoops.org 2001-2017 &copy; XOOPS Project
 * @author       Mamba <mambax7@gmail.com>
 */

/**
 * Class Update
 */
class Update
{

    //新增檔案欄位
    public static function chk_fc_tag()
    {
        global $xoopsDB;
        $sql = 'SELECT count(`tag`) FROM ' . $xoopsDB->prefix('tad_meeting_files_center');
        $result = $xoopsDB->query($sql);
        if (empty($result)) {
            return true;
        }

        return false;
    }

    public static function go_fc_tag()
    {
        global $xoopsDB;
        $sql = 'ALTER TABLE ' . $xoopsDB->prefix('tad_meeting_files_center') . "
        ADD `upload_date` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '上傳時間',
        ADD `uid` MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT 0 COMMENT '上傳者',
        ADD `tag` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '註記'
        ";
        $xoopsDB->queryF($sql) or redirect_header(XOOPS_URL . '/modules/system/admin.php?fct=modulesadmin', 30, $xoopsDB->error());
    }

    //修改權限
    public static function chk_permission()
    {
        global $xoopsDB;
        $sql = 'SELECT count(*) FROM ' . $xoopsDB->prefix('group_permission') . " where gperm_name='tad_meeting'";
        $result = $xoopsDB->query($sql);
        list($count) = $xoopsDB->fetchRow($result);
        if (!empty($count)) {
            return true;
        }

        return false;
    }

    public static function go_permission()
    {
        global $xoopsDB;
        $permission[1] = 'create_meeting';
        $permission[2] = 'post_meeting';
        $permission[3] = 'view_meeting';
        $permission[4] = 'sort_meeting';

        $sql = "SELECT `tad_meeting_cate_sn` FROM `" . $xoopsDB->prefix('tad_meeting_cate') . "`";
        $result = $xoopsDB->queryF($sql);
        while (list($tad_meeting_cate_sn) = $xoopsDB->fetchRow($result)) {
            foreach ($permission as $gperm_itemid => $gperm_name) {
                $sql = "SELECT `gperm_groupid`, `gperm_modid` FROM `" . $xoopsDB->prefix('group_permission') . "` where `gperm_name`='tad_meeting' and `gperm_itemid`='$gperm_itemid'";
                $result1 = $xoopsDB->queryF($sql);
                while (list($gperm_groupid, $gperm_modid) = $xoopsDB->fetchRow($result1)) {
                    $sql = "insert into `" . $xoopsDB->prefix('group_permission') . "` (`gperm_groupid`, `gperm_itemid`, `gperm_modid`, `gperm_name`)
                    values('$gperm_groupid', '$tad_meeting_cate_sn', '$gperm_modid', '$gperm_name')";
                    $xoopsDB->queryF($sql);
                }
            }
        }

        $sql = "delete from `" . $xoopsDB->prefix('group_permission') . "` where `gperm_name`='tad_meeting'";
        $xoopsDB->queryF($sql);
    }
}
