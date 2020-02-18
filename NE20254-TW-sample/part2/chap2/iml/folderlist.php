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
 *    2005-08-26 JuK Mod table layout.
 *    2005-03-29 JuK Mod check folder name is ASCII
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
require_once "config_util.php";
$param=read_config('config/param.xml');
include_once("config/imageparam.default.php");    // 讀入預設值

// initialize variables
$param_file = ".imageparam.php";
$param_template = "template/imageparam.template.php";

$cmd='';
if (! empty($_GET['cmd']))	$cmd=addevalslashes($_GET['cmd']);
$folder='';
if (! empty($_GET['folder']))	$folder=basefoldername($_GET['folder']);
$label='';
if (! empty($_GET['label']))	$label=strip_tags($_GET['label']);
$action = $_SERVER['PHP_SELF'];
$date_now = date("D M j G:i:s T Y");

//$Ver = explode(".",phpversion());
if ($Ver[0] > 4) {
  require_once "filetable.php";
  $ft = new FileTable( $param['LIST_FILE'] );
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
       // 顯示簡易樣版（注意文字內容： 不能使用 '"' ）
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
     if ( mb_detect_encoding($folder) != "ASCII" ) {
       Error("目錄名稱錯誤。 \"$folder\" 不是 ASCII 字串。", __LINE__, __FILE__);
       $action = $_SERVER['PHP_SELF'];
       echo "<a href=\"$action\">$action</a>";
       exit;
     }
     //
     // Create a new folder
     //
     $folder_path = $param['ROOT_DIRECTORY_PATH'].'/'.$param['DATA_FOLDER'].'/'.$folder;
     //echo "folder_path=$folder_path<br>";
     if ( file_exists($folder_path) ) {
       Error("無法建立圖片目錄。 \"$folder_path\" 已經存在。", __LINE__, __FILE__);
       $action = $_SERVER['PHP_SELF'];
       echo "<a href=\"$action\">$action</a>";
       exit;
     }
     if (! mkdir($folder_path) ) { // 0777
       Error("無法建立 \"$folder_path\" 圖片目錄。", __LINE__, __FILE__);
       $action = $_SERVER['PHP_SELF'];
       echo "<a href=\"$action\">$action</a>";
       exit;
     }
     chmod($folder_path, myfilemode() + 0111);
     $original_directory=$folder;
     $param_path = $folder_path.'/'.$param_file;
     include("eval_param.php");
     
     // 建立暫存目錄
     $thumbnail_path=$folder_path.'/'.$thumbnail_directory;
     if (! mkdir($thumbnail_path) ) { // 0777
       Error("無法建立縮圖目錄 \"$thumbnail_path\"。", __LINE__, __FILE__);
     }
     chmod($thumbnail_path, myfilemode() + 0111);
     $work_path=$folder_path.'/'.$work_directory;
     if (! mkdir($work_path) ) { // 0777
       Error("無法建立暫存目錄 \"$work_path\"。", __LINE__, __FILE__);
     }
     chmod($work_path, myfilemode() + 0111);
     
     // 更新清單
     //$list = join('\n', read_file_lock($param['LIST_FILE']));
     $list = "$folder\t$label\n";
     if ($Ver[0] > 4) {
       if ( $ft->addrow($list) === false ) {
         Error("無法新增至圖片目錄清單 (". $ft->geterr(). ")。", __LINE__, __FILE__);
       }
     } else {
       write_file_lock($param['LIST_FILE'], $list);
     }
   }
   break;
 default:
}

if ( empty($folder) ) {
  //
  // 顯示目錄清單、建立新目錄的表單
  //
  
  // 讀取清單檔加以顯示
  if ($Ver[0] > 4) {
    $contents = $ft->getall();
  } else {
    $contents = read_file_lock($param['LIST_FILE']);
  }
  echo "<table width=\"640\">\n";
  $i=1;
  foreach ($contents as $line) {
    $fields = explode("\t", $line);
    if ( $fields[0] == "." ) {
      echo "<tr><th align=\"left\" colspan=\"3\">\n";
      echo "<H1>$fields[1]</H1>\n";
      echo "</th><th></th><th></th></tr>\n";
    } elseif ( $fields[0] == "+" ) {
      echo "<tr><td></td></tr>\n";
      echo "<tr><td colspan=\"4\">\n";
      echo "<p>$fields[1]</p>\n";
      echo "</td></tr>\n";
      echo "<tr><td></td></tr>\n";
    } else {
      $action = "imagelist.php?folder=".$fields[0];
      echo "<tr><th>$i</th><td>$fields[1]</td><td>\n";
      echo "<a href=\"$action\">$fields[0]</a>";
      echo "</td></tr>\n";
      $i++;
    }
  }
  
  // 建立新目錄的表單
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
