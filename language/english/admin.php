<?php
include_once "../../tadtools/language/{$xoopsConfig['language']}/admin_common.php";
define('_TAD_NEED_TADTOOLS', 'This module needs TadTools module. You can download TadTools from <a href="http://www.tad0616.net/modules/tad_uploader/index.php?of_cat_sn=50" target="_blank">Tad Textbook </a>. ');

// index file
define("_MA_LUNCH_UPDATA", "import");
define("_MA_LUNCH_UPDATA_TEMP", "import template");
define("_MA_LUNCH_OUTDATA_TEMP", "export template");
define("_MA_LUNCH_UPDATA_README", "category number specification");
define ( "_ MA_LUNCH_README_BODY", "Type No principle <br> 0 ~ 9 Reserved <br> 10 ~ 19 staple <br> 20 ~ 29 soup dishes <br> 30 ~ 39 <br> 40 ~ 49 fruits <br> 50 ~ 59 Notes | 60 ~ 99 This range is all fields to see ");

define("_MA_LUNCH_NV", "dish name");
define("_MA_LUNCH_ERRMSG", "not archived, please check your imported file number, please refer to");
define("_MA_LUNCH_ITEMS", "pen");
define("_MA_LUNCH_HAVE", "yes");
define("_MA_LUNCH_SQLMSG", "pen number does not match, not deposited!");
define("_MA_LUNCH_NUMBERS", "number");
define("_MA_LUNCH_TMPERRMSG", "not archived, please check your imported file number, please refer to");
define("_MA_LUNCH_UPDATA_BROWS", 'Please click" Browse "to select import file source:');
define("_MA_LUNCH_UPDATA_SUBVAL", "batch build data");
define("_MA_LUNCH_UPDATA_README1L", "Food document batch file description:");
define("_MA_LUNCH_UPDATA_CSV", "csv file format");
define("_MA_LUNCH_UPDATA_EXAMPLE", "example");
define("_MA_LUNCH_UPDATA_README2L", "csv file first line header please keep");
define("_MA_LUNCH_UPDATA_README3L", "format: type, dish name, material, quantity (100 person), unit, material, quantity (100 person), unit, ....");
define("_MA_LUNCH_UPDATA_README4L", "Please modify the relevant data after import");
define("_MA_LUNCH_UPDATA_README5L", "please the same information only import once, do not repeat the import, otherwise the same food will have more than two.");
define("_MA_LUNCH_UPTEMP_README", "if you have the information, it will be the same number (1 ~ 159), and cover the old data.");
define("_MA_LUNCH_UPTEMP_READMESURE", "Are you sure?");

// Import user data
define("_MA_LUNCH_IN_ID", "number");
define("_MA_LUNCH_ITEM", "material");
define("_MA_LUNCH_NUMBER", "quantity (100 people)");
define("_MA_LUNCH_IN_ERR", 'This interface does not support the format you are importing. Please check your imported file format and <font color = "red"> keep the first column header </font>!' );



// add fun
// title
define("_MA_LUNCH_ADD_STAPLE", "staple");
define("_MA_LUNCH_ADD_DISH", "dish");
define("_MA_LUNCH_ADD_SOUP", "soup");
define("_MA_LUNCH_ADD_FRUIT", "fruit");
define("_MA_LUNCH_ADD_REM", "Remarks");
// dish sql
define("_MA_LUNCH_ADD_ONE", "add a new");
define("_MA_DISH_UNIT_README", "the number here is a hundred copies");
define("_MA_LUNCH_ADD_ID", "category");
define("_MA_LUNCH_ADD_ITEM_1", "material one");
define("_MA_LUNCH_ADD_ITEM_2", "material two");
define("_MA_LUNCH_ADD_ITEM_3", "material three");
define("_MA_LUNCH_ADD_ITEM_4", "material four");
define("_MA_LUNCH_ADD_ITEM_5", "material five");
define("_MA_LUNCH_ADD_ITEM_6", "material six");
define("_MA_LUNCH_ADD_ITEM_7", "material seven");
define("_MA_LUNCH_ADD_ITEM_8", "material eight");
define("_MA_LUNCH_ADD_ITEM_9", "material nine");
define("_MA_LUNCH_ADD_ITEM_10", "material ten");
define("_MA_LUNCH_ADD_NUMBER", "quantity");
define("_MA_LUNCH_ADD_UNIT", "unit");
define("_MA_LUNCH_EXE", "execute");

define("_MA_SQL_ERR", "query error!");
define("_MA_DEL_SQL_ERROR", "not deleted successfully!");
define("_MA_DEL_SQL_SAVEOK", "delete action completed!");
define("_MA_ERR", "wrong!");
define("_MA_OK", "success!");
define("_MA_ID_README", "type number repeat, see numbering");

// kind file
define("_MA_LUNCH_KIND_SN", "category number");
define("_MA_LUNCH_KIND_NAME", "category name");

// physical file
define("_MA_LUNCH_SHOW", "watch menu");
define("_MA_LUNCH_ADD", "Lunch Add (Form)");
define("_MA_LUNCH_ADD_MENU", "Lunch Add (Menu)");
define("_MA_LUNCH_VIEW_MENU", "menu table");
define("_MA_LUNCH_SET_POWER", "Nutritional lunch management permission setting");
define("_MA_LUNCH_README", 'If you want only the teacher to use the "menu design" function, then please add a new group, such as" teacher. "- Then, the teacher\'s account to join the group, then And then open the "menu design" permission to the group can be. ');


// config file
define("_MA_CONFIG_TITLE", "Please enter your school full title");
define("_MA_CONFIG_MASTER", "Please enter the name of the principal");
define("_MA_CONFIG_MASTER_J", "whether or not the name of the principal appears on the report");
define("_MA_CONFIG_SECRETARY", "Please enter your school lunch executive secretary");
define("_MA_CONFIG_SECRETARY_J", "whether to appear in the report lunch executive secretary's name");
define("_MA_CONFIG_DATE_B", "Please enter your school's school day");
define("_MA_CONFIG_DATE_E", "Please enter your school the end of the semester");
define("_MA_CONFIG_DATE_BEX", "Example: 2005-02-17");
define("_MA_CONFIG_DATE_EEX", "Example: 2005-06-30");
define("_MA_CONFIG_CHECKER_J", "whether to appear in the report on the recipient name");
define("_MA_CONFIG_DESIGN_J", "whether or not a designer name appears on the report");
define("_MA_CONFIG_NUMBERS", "Please enter the number of schools to provide nutritious lunch");
define("_MA_CONFIG_PEOPLE", "person");

define("_MA_CONFIG_HAVE_XBASE_README", "Do you have to install X learning system, do you want to introduce the latest information on X learning system? <br> Are you sure?");
define("_MA_CONFIG_UPDATA", "Introducing X Academic System Latest Relevant Information");

define("_MA_CONFIG_DATE_ERROR", "date input error!");
define("_MA_CONFIG_SELECT_ERROR", "can not get the right to use!");
define("_MA_CONFIG_SELECT_SAVEOK", "modify the action is complete!");

define("_MA_SQL_ERROR", "Import action is not successful, please check your imported file format!");
define("_MA_SQL_SAVEOK", "import action completed!");

define("_AC_MASTER", "principals");
define("_AC_NURSE", "nurse");

define("_MA_LUNCH_RESET", "rewrite");


