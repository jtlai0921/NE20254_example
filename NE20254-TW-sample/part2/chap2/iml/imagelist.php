<?php
//
// Jun Kuwamura <juk@yokohama.email.ne.jp>
//               Tue Aug  8 13:36:12 JST 2000
//
// 2005-10-13 JuK Add name attribute anchor for browse mode
// 2005-10-12 JuK Add print format.
// 2005-10-06 JuK Add more resize options to SaveImgRemarks
// 2005-10-04 JuK Add editmax mode
// 2005-10-03 JuK Add browse mode(imagelistbrowse.php).
// 2005-10-03 JuK Mod remark file i/o({add|strip}slashes).
// 2005-02-26 JuK Mod myauth.php as wrapper of Auth class
// 2005-02-01 JuK Mod user config/param.xml
// 2005-02-01 JuK mod create config and template folder.
// 2004-11-28 JuK Add link to SetUp, adjust font size
// 2003-12-08 JuK Add frame label parameter to ReCreatImg
// 2003-12-07 JuK Add ImageResample option for smoothing resize.
// 2003-11-24 JuK Add frame size parameter.
// 2003-11-23 JuK Add folder name specification.
// 2003-08-10 JuK Add link to imageupload.php as labeled "File List"
// 2003-07-27 JuK Add filname on title.
// 2003-07-20 JuK Add web uri beside of directory path.
// 2002-09-16 JuK Use file list instead of directory info. in while loop.
// 2002-09-15 JuK Add simple header and footer.
// 2002-08-28 JuK Add ReCreate image for zero sized file.
// 2002-08-28 JuK Add edit mode for remarks(readonly or none)
// 2002-07-04 JuK Add original image viewer.
// 2002-07-04 JuK Add edit mode for remarks(append or overwrite)
// 2002-03-15 JuK Mod independent browse size.
// 2002-02-17 JuK Mod devide functions into another files.
// 2002-02-15 JuK Mod modularized by small functions with debug print.
// 2002-02-14 JuK Add $original directory.
// 2002-02-13 JuK Mod for register_globals=Off, register_argc_argv=Off.
// 2001-12-09 JuK Add up/previous/next navigators for zoom page.
// 2001-08-22 JuK Add PHPSELF before all '?'
// 2001-06-03 JuK generate present(browse size) file in work directory.
// 2001-05-05 JuK eliminate directory from GetImageSize.
// 2001-01-21 JuK adds table layout and comment editor.
//
$copyright="(c)2000-2005 imagelist.php by Jun Kuwamura &lt;juk at yokohama.email.ne.jp&gt;.";
//require_once "checkutil.php";
//require_once "fileutil.php";
require_once "config_util.php";
define('SITE_CONFIG', 'config/param.xml');
define('INSTALL_PHP', 'install.php');

header('Content-Type: text/html; charset=utf-8');

$Ver = explode(".",phpversion());
if ($Ver[0] < 4 ) die("PHP version must be greater than or eaqual to 4!<br>");

if (! file_exists(SITE_CONFIG) ) {
    if (! file_exists(INSTALL_PHP) ) {
	die('請從 "config" 目錄或備份檔將 "install.php" 複製出來，並且執行。<br>');
    }
    include INSTALL_PHP;			// 執行安裝程式
    exit;
}
if ( file_exists(INSTALL_PHP) ) {
    Error( "請刪除 \"".INSTALL_PHP."\" 檔。", __LINE__, __FILE__);
    exit;
}
$param=read_config(SITE_CONFIG);
if (! is_array($param) ) {
    Error( "參數檔讀取失敗。", __LINE__, __FILE__);
}
include("config/imageparam.default.php");    // 設定預設值

if ( ! check_writable_folder ( $param['DATA_FOLDER'] ) ) {
    die ('請建立儲存圖片的 "'.$param['DATA_FOLDER'].'" 目錄、並賦予 Web 伺服器寫入權限。');
}

// Check Variables
// $_GET['folder'], $_GET['mode'], $_GET['listtype'],
// $_GET['image'], $_GET['remark'], $_GET['rotate']

// 檢查、設定傳入的參數
$imagename='';
if (! empty($_GET['image']))	$imagename=addslashes($_GET['image']);
$remarktext='';
if (! empty($_GET['remark']))	$remarktext=addslashes($_GET['remark']);
$rotateangle='';
if (! empty($_GET['rotate']))	$rotateangle=addevalslashes($_GET['rotate']);
$mode = 'default';
if (! empty($_GET['mode'])) 	$mode = addevalslashes($_GET['mode']);
$print = 0;
if (! empty($_GET['print'])) 	$print = addevalslashes($_GET['print']);
// 預設值是 .imageparam.php 裡面的東西
$listtype=$list_type;
if (isset($_GET['listtype'])) $listtype = (int)$_GET['listtype'];
$smooth=$smooth_resize;
if (isset($_GET['smooth']))	$smooth=(int)$_GET['smooth'];
$zoom=$zoom_in_out;
if (isset($_GET['zoom']))	$zoom=(int)$_GET['zoom'];
$aspect=$resize_aspect;
if (isset($_GET['aspect']))	$aspect=(int)$_GET['aspect'];
$pic_frm=$pict_frame_band;
if (isset($_GET['pic_frm']))	$pic_frm=(int)$_GET['pic_frm'];
$frm_lbl=$pict_frame_label;
if (isset($_GET['frm_lbl']))	$frm_lbl=(int)$_GET['frm_lbl'];

// $foldername required as a global variable.
$foldername='';
if ( isset($_GET['folder']))	$foldername=basefoldername($_GET['folder']);

if ( empty($foldername) ) {
    include 'folderlist.php';			// 執行目錄清單
    exit;
} else {
    // 設定圖片目錄的本地參數檔
    $paramfile = $param['DATA_FOLDER'].'/'.$foldername."/.imageparam.php";
    if (! file_exists($paramfile) ) {
	include 'folderlist.php';			// 執行目錄清單
	exit;
    }
    
    // set header title
    if (! empty($imagename) ) {
	$title = "imagelist($foldername/".$imagename.").$mode";
    } else {
	if (! empty($mode) ) {
	    $title = "imagelist($foldername/index).$mode";
	} else {
	    $title = "imagelist($foldername/index)";
	}
    }
    header('Content-Type: text/html; charset=utf-8');
    $header="<html><head>\n<title>$title</title>\n</head><body>\n";
    $footer="<HR>\n$copyright\n</body></html>\n";
}

// 讀入圖片目錄的本地設定檔
require_once($paramfile);

// 關閉客戶端快取
Header("Expires: Tue, 08 Aug 2000 05:00:00 UTC");
Header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
Header("Cache-Control: no-cache, must-revalidate");     // HTTP/1.1
Header("Pragma: no-cache");                             // HTTP/1.0

// header print
echo "$header";

// debug
if ( $TEST > 1 ) {
  include( "print_var_dump.php" );
}

// 刪去認證資料
session_start();
include 'myauth.php';
$auth = new MyAuth($param['AUTH_DSN'], 28800, 1800 );
$auth->logout();
session_destroy();

//////////////////////////////////////////
//
// Main ImageList Program Start from here
//
//////////////////////////////////////////
// 讀入圖片處理函式
require_once('imagemode.php');

// 設定路徑
$original_directory_path = $param['ROOT_DIRECTORY_PATH'].'/'.$param['DATA_FOLDER'].'/'.$original_directory;
$thumbnail_directory_path = $original_directory_path.'/'.$thumbnail_directory;
$work_directory_path = $original_directory_path.'/'.$work_directory;
$original_directory_uri = $param['ROOT_DIRECTORY_URI'].'/'.$param['DATA_FOLDER'].'/'.$original_directory;
$thumbnail_directory_uri = $original_directory_uri.'/'.$thumbnail_directory;
$work_directory_uri = $original_directory_uri.'/'.$work_directory;
check_writable_folder( $original_directory_path );

// Check the directory in which original image is existed.
$filename = ChkReadable("$original_directory_path", ".", __LINE__);
if ( empty($filename) ) {
    Error("無法讀取原始圖片用的目錄: $original_directory_path", __LINE__);
    exit;
}
if ($edit_rmk_mode == "a" || $edit_rmk_mode == "o") {
    // Check the directory in which thumbnail image is created.
    $filename = ChkWritable("$thumbnail_directory_path", ".", __LINE__);
    if ( empty($filename) ) {
	Error("縮圖目錄不存在或無法寫入: $thumbnail_directory_path", __LINE__);
	exit;
    }
    // Check the directory in which browsable image is created.
    $filename = ChkWritable("$work_directory_path", ".", __LINE__);
    if ( empty($filename) ) {
	Error("暫存目錄不存在或無法寫入: $work_directory_path", __LINE__);
	exit;
    }
} elseif ($edit_rmk_mode == "r") {
    $filename = ChkReadable("$thumbnail_directory_path", ".", __LINE__);
    if ( empty($filename) ) {
	Error("縮圖目錄不存在或無法寫入: $thumbnail_directory_path", __LINE__);
	exit;
    }
}

// 取得圖片目錄的檔案清單
$items = array_keys(get_file_list($original_directory_path,
				  $hidden=false, $sort="name", 
				  $cend="ascend", $selection="type=file")
		    );
//var_dump($items);

if ( $TEST > 1 ) {
    echo "$original_directory_path<br>";
    echo "$original_directory_uri<br>";
}

//
// mode 是 save 的話，儲存並轉換模式
//
if ($mode == "save") {
     SaveImgRemarks( $original_directory_path, $original_directory_uri,
		     $thumbnail_directory_path, $thumbnail_directory_uri,
		     $work_directory_path,
		     $work_width, $work_height,
		     $imagename, $remarktext, $rotateangle,
                     $smooth, $zoom, $aspect,
                     $_SERVER['PHP_SELF'],
		     $edit_rmk_mode, $pic_frm, $frm_lbl);
     if ($listtype == 1) {
       $mode = "";
     } else {
       $mode = "show";
     }
}

//
// 根據mode呼叫對應的函式
//
switch ( $mode ) {
 case "create":
     CreatThumbNails( $original_directory_path,
		      $thumbnail_directory_path, $thumbnail_directory_uri,
		      $work_directory_path,  $work_directory_uri,  $items,
		      $thumbnail_width, $thumbnail_height,
		      $work_width, $work_height,
		      $imagename, $_SERVER['PHP_SELF'],
		      $pict_frame_band, $pict_frame_label, $smooth_resize,
                      $zoom_in_out, $resize_aspect);
     break;
 case "list":
     ListImgDir( $original_directory_path, $items, $_SERVER['PHP_SELF'] );
     break;
 case "edit":
     EditImgRemarks( $original_directory_path, $original_directory_uri,
		     $thumbnail_directory_path, $thumbnail_directory_uri,
		     $imagename, $_SERVER['PHP_SELF'], $edit_rmk_mode );
     break;
 case "editmax":
     EditImgRemarks( $original_directory_path, $original_directory_uri,
		     $thumbnail_directory_path, $thumbnail_directory_uri,
		     $imagename, $_SERVER['PHP_SELF'], $edit_rmk_mode, 1 );
     break;
 case "save":
     SaveImgRemarks( $original_directory_path, $original_directory_uri,
		     $thumbnail_directory_path, $thumbnail_directory_uri,
		     $work_directory_path,
		     $work_width, $work_height,
		     $imagename, $remarktext, $rotateangle,
                     $smooth, $zoom, $aspect,
                     $_SERVER['PHP_SELF'],
		     $edit_rmk_mode, $pic_frm, $frm_lbl);
     //no break;
 case "show":
     ShowImgUp( $original_directory_path, $thumbnail_directory_path,
		$work_directory_path, $work_directory_uri, $items,
		$imagename, $remarktext, $_SERVER['PHP_SELF'],
		$edit_rmk_mode );
     break;
 case "max":
     if (! file_exists("$work_directory_path/org.$imagename") ) {
         if (! ReCreatImg( 0, 0, -1, 0, $imagename, $work_directory_path, $original_directory_path, $remarktext, $rotateangle, $smooth, $zoom, $aspect, "jpeg" ) ) {
             Error("creating original size image.", __LINE__);
         }
     }
     ShowImgMax( $original_directory_path, $thumbnail_directory_path,
		 $work_directory_path, $work_directory_uri,
		 $imagename, $remarktext, $_SERVER['PHP_SELF'] );
     break;
 default:
     //
     // 預設以表格形式顯示圖片清單 (不是簡易模式)
     //
     if ( $print != 1 ) {
	//echo "<table boder='0'><tr><td>\n";
	//echo "</td><td><p align='right'>\n";
	echo "<a href=\"".$_SERVER['PHP_SELF']."\">_.:^:._</a><br>\n";
	echo "<a href=\"".$_SERVER['PHP_SELF']."?folder=$foldername&listtype=0\">table</a>\n";
	echo "<a href=\"".$_SERVER['PHP_SELF']."?folder=$foldername&listtype=1\">browse</a>\n";
	//echo "</p></td></tr></table>\n";
        echo "<p align=\"right\"><a href=\"".$_SERVER['PHP_SELF']."?folder=$foldername&listtype=1&print=1\" target=_print>print</a></p>\n";
     }
     if  ( empty($listtype) || $listtype == 0) {
         include 'imagelisttable.php';
     } elseif ($listtype == 1) {
         include 'imagelistbrowse.php';
     } else {
         include 'imagelistsimple.php';
     }
     break;
}


// 頁尾
// 顯示各項機能的連結
if ( $print != 1 ) {
  if ($edit_rmk_mode == "a" || $edit_rmk_mode == "o") {
    echo "<div align=\"right\">\n";
    echo "<a href=\"folderlist.php?folder=$foldername\">SetUp</a></div>\n";
    echo "<div align=\"right\">";
    echo "<a href=\"imageupload.php?folder=$foldername\">UploadList</a></div>\n";
  }
  echo "<A HREF=\"".$_SERVER['PHP_SELF']."\">".$_SERVER['PHP_SELF']."</A>\n";
}
if (empty($items)) {
    echo <<<__TRAILER__
	<table cellpadding='2' cellspacing='0' border='0' width='100%'>
	<tbody>
	<tr>
	<td valign='top' align='left' bgcolor='#ccffff'>
	<a href='folderlist.php?folder=$foldername'>SetUp</a>
	</td>
	<td align='right' bgcolor='#ccffff'>
	<a href='imageupload.php?folder=$foldername'>ImageUpload</a>
	</td>
	</tr>
	</tbody>
	</table>
__TRAILER__;
}

// End of Program.
echo "$footer";
?>
