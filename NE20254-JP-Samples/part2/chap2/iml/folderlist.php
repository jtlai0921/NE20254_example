<?php
/*
 *  folderlist
 *  --------------------
 *   File:    folderlist.php
 *   Usage:   show folder list and set parameters for imagelist
 *   Date:    2003-07-20
 *   Auther:  Jun Kuwamura <juk@yokohama.email.ne.jp>
 *   Version: 0.5
 *   History:
 *    2005-02-28 JuK add filepermision setting by myfilemode()
 *    2005-02-26 JuK Mod myauth.php as wrapper of Auth class
 *    2005-02-20 JuK Mod seperate parameter setting into folderparam.php
 *    2005-02-01 JuK Mod user config/param.xml
 *    2005-02-01 JuK mod move template to new template folder.
 *    2004-11-28 JuK mod change template file names(imageparam.template.php, folderlist.template.html)
 *    2004-11-28 JuK ren renamed from index.php
 *    2003-12-07 JuK add new folder create option
 *    2003-12-07 JuK mod change template file names(param.template.html, folder.template.html).
 *    2003-11-23 JuK add folder list
 *    2003-07-20 JuK add icon image
 *
 */
$Ver = explode(".",phpversion());
if ($Ver[0] < 4 ) die("PHP version must be greater than 4!<br>");

require_once "config_util.php";
$param=read_config('config/param.xml');
include_once("config/imageparam.default.php");    // ���̡��桦�������ͥƥإ�����

// initialize variables
$param_file = ".imageparam.php";
$param_template = "template/imageparam.template.php";

$cmd='';
$folder='';
$label='';
if (! empty($_GET['cmd']))	$cmd=addevalslashes($_GET['cmd']);
if (! empty($_GET['folder']))	$folder=basefoldername($_GET['folder']);
if (! empty($_GET['label']))	$label=strip_tags($_GET['label']);
$action = $_SERVER['PHP_SELF'];
$date_now = date("D M j G:i:s T Y");
$i_enc = mb_internal_encoding();
$d_enc = mb_detect_encoding($date_now);
if (! empty($d_enc) ) {
    $date_now = mb_convert_encoding($date_now, $i_enc, $d_enc);
}

echo "$date_now<br>";
echo "$action/$cmd/$folder<br>";


switch ($cmd) {
 case 'create':
     if ( empty($folder) ) {
         require_once 'myauth.php';
         $auth = new MyAuth($param['AUTH_DSN'], 28800, 1800 );
         $auth->start();
         if ( $auth->checkAuth() ) {
             // ���������顦���ˡ����顦�������͡��ҡ��˥Υ��������ϥϥ������ҥ����档�� '"' ���ޥ��͡������ϡ�������
             $template = file("template/folderlist.template.html");
             $action = $_SERVER['PHP_SELF']."?cmd=create";
             $now = date("D M j G:i:s T Y");
             foreach ($template as $line) {
                 //echo htmlentities($line)."<br>\n";
                 $ret = eval("echo \"$line\";");
             }
         }
         exit;
     } else {
         //
         // Create a new folder
         //
         $folder_path = $param['ROOT_DIRECTORY_PATH'].'/'.$param['DATA_FOLDER'].'/'.$folder;
         //echo "folder_path=$folder_path<br>";
         if ( file_exists($folder_path) ) {
             Error("���À��桦�����������¥硦����򣥷���� \"$folder_path\" ���ޥ����ҥĥ���������������������", __LINE__, __FILE__);
             $action = $_SERVER['PHP_SELF'];
             echo "<a href=\"$action\">$action</a>";
             exit;
         }
         if (! mkdir($folder_path) ) { // 0777
             Error("���À��桦�������� \"$folder_path\" ���ۥ��¥硢�ҥ����̥䡢������������������", __LINE__, __FILE__);
             $action = $_SERVER['PHP_SELF'];
             echo "<a href=\"$action\">$action</a>";
             exit;
         }
         chmod($folder_path, myfilemode() + 0111);
         $original_directory=$folder;
         $param_path = $folder_path.'/'.$param_file;
         include("eval_param.php");
         
         // �����͡��̡��ס����á��͡����¥�
         $thumbnail_path=$folder_path.'/'.$thumbnail_directory;
         if (! mkdir($thumbnail_path) ) { // 0777
             Error("������৥ء��������桦�������� \"$thumbnail_path\" ���ۥ��¥硢�ҥ����̥䡢������������������", __LINE__, __FILE__);
         }
         chmod($thumbnail_path, myfilemode() + 0111);
         $work_path=$folder_path.'/'.$work_directory;
         if (! mkdir($work_path) ) { // 0777
             Error("�����ͥإࡦ�桦�������� \"$work_path failed \" ���ۥ��¥硢�ҥ����̥䡢������������������", __LINE__, __FILE__);
         }
         chmod($work_path, myfilemode() + 0111);
         
         // ���������͡��֡��ơ��顦�̡�������
         //$list = join('\n', read_file_lock($param['LIST_FILE']));
         $list = "$folder\t$label\n";
         write_file_lock($param['LIST_FILE'], $list);
     }
     break;
 default:
}

if ( empty($folder) ) {
    //
    // ���桦�����������������͡��ۥΥ��������͡��֥������㡦�桦�����������¥硦��������ۡ��桦���������
    //
    
    // ���������͡��桦�����������ۥ˥Ρ������ߡ������ͥΥ�����
    $contents = read_file_lock($param['LIST_FILE']);
    echo "<table width=\"640\">\n";
    foreach ($contents as $line) {
	$fields = explode("\t", $line);
	if ( $fields[0] == "." ) {
	    echo "<tr><th align=\"left\">\n";
	    echo "<H1>$fields[1]</H1>\n";
	    echo "</th><th></th><th></th></tr>\n";
	} elseif ( $fields[0] == "+" ) {
	    echo "<tr><td colspan=\"4\">\n";
	    echo "<p>$fields[1]</p>\n";
	    echo "</td></tr>\n";
	} else {
	    $action = "imagelist.php?folder=".$fields[0];
	    echo "<tr><th></th><td>$fields[1]</td><td>\n";
	    echo "<a href=\"$action\">$fields[0]</a>";
	    echo "</td></tr>\n";
	}
    }
    
    // �������桦�����������¥硦��������ۡ��桦���������
    echo " <tr>\n";
    echo "  <td colspan='3'>\n";
    echo "  </td>\n";
    echo "  <td>\n";
    echo "   <form method=get action='${_SERVER['PHP_SELF']}'>\n";
    echo "   <input type='hidden' name='cmd' value='create' />\n";
    echo "   <input type='hidden' name='folder' value='' />\n";
    echo "   <input type='submit' value='New Folder'>\n";
    echo "   </form>\n";
    echo "  </td>\n";
    echo " </tr>\n";
    
    echo "</table>\n";
    exit;
    
} else {
    include "folderparam.php";
}

?>
