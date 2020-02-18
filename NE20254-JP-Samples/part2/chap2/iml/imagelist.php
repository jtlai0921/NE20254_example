<?php
//
// Jun Kuwamura <juk@yokohama.email.ne.jp>
//               Tue Aug  8 13:36:12 JST 2000
//
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
//require_once "checkutil.php";
//require_once "fileutil.php";
require_once "config_util.php";
define('SITE_CONFIG', 'config/param.xml');
define('INSTALL_PHP', 'install.php');

if (! file_exists(SITE_CONFIG) ) {
    if (! file_exists(INSTALL_PHP) ) {
	die('�������������͡��������顦�������� "install.php" ��� "config" ���̡��ס����á��͡������������ޡ��ߡ��ơ��á��֡��ơ��顢����򧥦���䡣���������֥��ĥ��䡢�����ˡ��á���������������<br>');
    }
    include INSTALL_PHP;			// �������������͡������ۥ��ĥ���
    exit;
}
if ( file_exists(INSTALL_PHP) ) {
    Error( "���桦��������� \"".INSTALL_PHP."\" �������������ˡ��á���������������", __LINE__, __FILE__);
    exit;
}
$param=read_config(SITE_CONFIG);
if (! is_array($param) ) {
    Error( "���ࡦ�⣥��������桦�����������ۥ˥Ρ������������ҥ����̥䡢������������������", __LINE__, __FILE__);
}
include("config/imageparam.default.php");    // ���̡��桦�������ͥƥإ�����

if ( ! check_writable_folder ( $param['DATA_FOLDER'] ) ) {
    die ('���À���ĥ��إࡢ�ۡ��桦�������� "'.$param['DATA_FOLDER'].'" �����¥硢�����ˡ���Web�����������ߡ�����򿀀�奱�������̡��塢�����ȡ������������ˡ��á���������������');
}

$copyright="<A HREF=\"".$_SERVER['PHP_SELF']."\">".$_SERVER['PHP_SELF']."</A>
	<HR>
	(c)2000-2005 imagelist.php by Jun Kuwamura &lt;juk at yokohama.email.ne.jp&gt;.";

// Check Variables
// $_GET['folder'], $_GET['mode'], $_GET['simple'],
// $_GET['image'], $_GET['remark'], $_GET['rotate']

// �������衦�����ơ��͡������������ࡦ�⣥��������ۡ����������ơ��á��͡������ơ���
$imagename='';
if (! empty($_GET['image']))	$imagename=addslashes($_GET['image']);
$remarktext='';
if (! empty($_GET['remark']))	$remarktext=addevalslashes($_GET['remark']);
$rotateangle='';
if (! empty($_GET['rotate']))	$rotateangle=addevalslashes($_GET['rotate']);
$simplelist='';
if (! empty($_GET['simple'])) 	$simplelist = addevalslashes($_GET['simple']);
$mode = 'default';
if (! empty($_GET['mode'])) 	$mode = addevalslashes($_GET['mode']);

// $foldername required as a global variable.
$foldername='';
if ( isset($_GET['folder']))	$foldername=basefoldername($_GET['folder']);
if ( empty($foldername) ) {
    include 'folderlist.php';			// ���桦�����������������͡��ۥ��ĥ���
    exit;
} else {
    // ������⣥��������桦�����������ۡ��������������ࡦ�⣥��������桦�����������ۥ������
    $paramfile = $param['DATA_FOLDER'].'/'.$foldername."/.imageparam.php";
    if (! file_exists($paramfile) ) {
	include 'folderlist.php';			// ���桦�����������������͡��ۥ��ĥ���
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
    $header="<html><header>\n<title>$title</title>\n</header><body>\n";
    $footer="</body></html>\n";
    
}

// ������⣥��������桦�����������ۡ��������������ࡦ�⣥����������Ρ��������
require_once($paramfile);

// ���á�򧡢���֡����͡��ۡ��塦槥ơ�����ꦀ������桢�ҡ������
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

// �̥����쥻�����ۥ��ƥ��
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
// ���À��π��꥽���ۥ˥Ρ���������
require_once('imagemode.php');

// ���ࡦ�����ۥ������
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
    Error("�������������ϡ����À��ࡢ�ۡ��桦���������������ȥΡ������ߡ������㡢�̡��塢���������: $original_directory_path", __LINE__);
    exit;
}
if ($edit_rmk_mode == "a" || $edit_rmk_mode == "o") {
    // Check the directory in which thumbnail image is created.
    $filename = ChkWritable("$thumbnail_directory_path", ".", __LINE__);
    if ( empty($filename) ) {
	Error("������৥ء������ϥࡢ�ۡ��桦������������ĥ������������ϡ����������֡����������ޡ��֥����奱�������㡢�̡��塢���������: $thumbnail_directory_path", __LINE__);
	exit;
    }
    // Check the directory in which browsable image is created.
    $filename = ChkWritable("$work_directory_path", ".", __LINE__);
    if ( empty($filename) ) {
	Error("�����ͥإࡢ�ۡ��桦������������ĥ������������ϡ����������֡����������ޡ��֥����奱�������㡢�̡��塢���������: $work_directory_path", __LINE__);
	exit;
    }
} elseif ($edit_rmk_mode == "r") {
    $filename = ChkReadable("$thumbnail_directory_path", ".", __LINE__);
    if ( empty($filename) ) {
	Error("������৥ء������ϥࡢ�ۡ��桦������������ĥ������������ϡ����������֡����������ޡ��֥˥Ρ������ߡ������㡢�̡��塢���������:
 $thumbnail_directory_path", __LINE__);
	exit;
    }
}

// ������⣥��������桦�����������ۡ��桦�����������������͡����ȥ�
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
// mode ���ۥ�������ҡ�����꥽�����ˡ��⥹�ߡ���
//
switch ( $mode ) {
 case "create":
     CreatThumbNails( $original_directory_path,
		      $thumbnail_directory_path, $thumbnail_directory_uri,
		      $work_directory_path,  $work_directory_uri,  $items,
		      $thumbnail_width, $thumbnail_height,
		      $work_width, $work_height,
		      $imagename, $_SERVER['PHP_SELF'],
		      $pict_frame_band, $pict_frame_label, $smooth_resize );
     break;
 case "list":
     ListImgDir( $original_directory_path, $items, $_SERVER['PHP_SELF'] );
     break;
 case "edit":
     EditImgRemarks( $original_directory_path, $original_directory_uri,
		     $thumbnail_directory_path, $thumbnail_directory_uri,
		     $imagename, $_SERVER['PHP_SELF'], $edit_rmk_mode );
     break;
 case "save":
     SaveImgRemarks( $original_directory_path, $original_directory_uri,
		     $thumbnail_directory_path, $thumbnail_directory_uri,
		     $work_directory_path,
		     $work_width, $work_height,
		     $imagename, $remarktext, $rotateangle, $_SERVER['PHP_SELF'],
		     $edit_rmk_mode);
     //no break;
 case "show":
     ShowImgUp( $original_directory_path, $thumbnail_directory_path,
		$work_directory_path, $work_directory_uri, $items,
		$imagename, $remarktext, $_SERVER['PHP_SELF'],
		$edit_rmk_mode );
     break;
 case "max":
     if (! file_exists("$work_directory_path/org.$imagename") ) {
         if (! ReCreatImg( 0, 0, -1, 0, $imagename, $work_directory_path, $original_directory_path, $remarktext, $rotateangle, "jpeg" ) ) {
             Error("creating original size image.", __LINE__);
         }
     }
     ShowImgMax( $original_directory_path, $thumbnail_directory_path,
		 $work_directory_path, $work_directory_uri,
		 $imagename, $remarktext, $_SERVER['PHP_SELF'] );
     break;
 default:
     //
     // ������⣥��������������͡��ۡ��̡��桦�������ͥΥ��������ޡ��ˡ������衦���桦�������������ơ��͡����͡��򡣡�
     // (�ƥ���槥桦�������������ơ��͡��̡��ޡ��ϡ���)
     //
     if  ( empty($simplelist) ) {
         include 'imagelisttable.php';
     } else {
         include 'imagelistsimple.php';
     }
     break;
}

// ���˥����̥����ꡢ�ۡ������á���������
if ($edit_rmk_mode == "a" || $edit_rmk_mode == "o") {
    echo "<div align=\"right\">\n";
    echo "<a href=\"folderlist.php?folder=$foldername\">SetUp</a></div>\n";
    echo "<div align=\"right\">";
    echo "<a href=\"imageupload.php?folder=$foldername\">UploadList</a></div>\n";
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
echo "$copyright";
echo "$footer";
?>
