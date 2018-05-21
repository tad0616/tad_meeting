CREATE TABLE `tad_meeting` (
  `tad_meeting_sn` smallint(6) unsigned NOT NULL auto_increment COMMENT '會議編號',
  `tad_meeting_title` varchar(255) NOT NULL default '' COMMENT '會議名稱',
  `tad_meeting_cate_sn` tinyint(3) unsigned NOT NULL default '0' COMMENT '會議類別',
  `tad_meeting_datetime` datetime NOT NULL COMMENT '開會日期',
  `tad_meeting_place` varchar(255) NOT NULL default '' COMMENT '會議地點',
  `tad_meeting_chairman` varchar(255) NOT NULL default '' COMMENT '會議主席',
  `tad_meeting_note` text NOT NULL COMMENT '相關補充說明',
PRIMARY KEY  (`tad_meeting_sn`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `tad_meeting_cate` (
  `tad_meeting_cate_sn` smallint(5) unsigned NOT NULL auto_increment COMMENT '分類編號',
  `tad_meeting_cate_parent_sn` smallint(5) unsigned NOT NULL default '0' COMMENT '父分類',
  `tad_meeting_cate_title` varchar(255) NOT NULL default '' COMMENT '分類標題',
  `tad_meeting_cate_desc` varchar(255) NOT NULL default '' COMMENT '分類說明',
  `tad_meeting_cate_sort` smallint(5) unsigned NOT NULL default '0' COMMENT '分類排序',
  `tad_meeting_cate_enable` enum('1','0') NOT NULL default '1' COMMENT '狀態',
PRIMARY KEY  (`tad_meeting_cate_sn`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `tad_meeting_data` (
  `tad_meeting_data_sn` mediumint(9) unsigned NOT NULL auto_increment COMMENT '報告流水號',
  `tad_meeting_sn` smallint(6) unsigned NOT NULL default '0' COMMENT '會議編號',
  `tad_meeting_data_unit` varchar(255) NOT NULL default '' COMMENT '處室',
  `tad_meeting_data_job` varchar(255) NOT NULL default '' COMMENT '職務',
  `tad_meeting_data_title` varchar(255) NOT NULL default '' COMMENT '報告標題',
  `tad_meeting_data_content` text NOT NULL COMMENT '報告內容',
  `tad_meeting_data_uid` mediumint(9) unsigned NOT NULL default '0' COMMENT '報告者',
  `tad_meeting_data_sort` tinyint(3) unsigned NOT NULL default '0' COMMENT '排序',
  `tad_meeting_data_date` datetime NOT NULL COMMENT '最後編輯日期',
PRIMARY KEY  (`tad_meeting_data_sn`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `tad_meeting_files_center` (  
  `files_sn` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '檔案流水號',
  `col_name` varchar(255) NOT NULL default '' COMMENT '欄位名稱',
  `col_sn` smallint(5) unsigned NOT NULL default 0 COMMENT '欄位編號',
  `sort` smallint(5) unsigned NOT NULL default 0 COMMENT '排序',
  `kind` enum('img','file') NOT NULL default 'img' COMMENT '檔案種類',
  `file_name` varchar(255) NOT NULL default '' COMMENT '檔案名稱',
  `file_type` varchar(255) NOT NULL default '' COMMENT '檔案類型',
  `file_size` int(10) unsigned NOT NULL default 0 COMMENT '檔案大小',
  `description` text NOT NULL COMMENT '檔案說明',
  `counter` mediumint(8) unsigned NOT NULL default 0 COMMENT '下載人次',
  `original_filename` varchar(255) NOT NULL default '' COMMENT '檔案名稱',
  `hash_filename` varchar(255) NOT NULL default '' COMMENT '加密檔案名稱',
  `sub_dir` varchar(255) NOT NULL default '' COMMENT '檔案子路徑',
  PRIMARY KEY (`files_sn`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

