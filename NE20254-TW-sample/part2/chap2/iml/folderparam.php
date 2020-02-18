<?php
/*
 *  folderparam
 *  -----------
 *   File:    folderparam.php
 *   Usage:   parameter setting for image folder, part of folderlist.php
 *   Date:    2005-02-20
 *   Auther:  Jun Kuwamura <juk at yokohama.email.ne.jp>
 *   Version: 0.1
 *    2005-02-26 JuK Mod myauth.php as wrapper of Auth class
 *    2005-02-20 JuK Add Authentication with PEAR Auth
 *    2005-02-20 JuK New diveded from folderlist.php.
 */
//
// Authentication
//
require_once 'myauth.php';
$auth = new MyAuth($param['AUTH_DSN'], 28800, 1800 );
$auth->start();

if ( $auth->checkAuth() ) {
    //
    // 設定各目錄單獨的圖片顯示設定
    //
    if ( is_dir($param['DATA_FOLDER'].'/'.$folder) ) {
        // eval_param.php 會用到 $param_path 變數
        $param_path=$param['DATA_FOLDER'].'/'.$folder."/".$param_file;
        if (! file_exists($param_path) ) {
            $original_directory=$folder;
            include("eval_param.php");
            //evalparam($param_template, $param_path);
        }
        
        // 顯示更新的變數
        if (! empty($_GET['edit_rmk_mode']) ) {
            while( list( $key, $val ) = each($_GET) ) {
                if (! is_array( $val ) ) {
                    $$key = quotemeta(strip_tags($_GET[$key]));
                    echo "$$key: $val <br>";
                }
            }
            include("eval_param.php");
            //evalparam($param_template, $param_path);
        }
        
        // 顯示圖片參數設定表單
        include($param_path);    // 設定預設值
        
        // 簡易樣版 (注意文字內容: 不能用到 '"')
        $contents = file("template/imageparam.template.html");
        $action = $_SERVER['PHP_SELF']."?folder=".$folder;
        $listaction = "imagelist.php?folder=".$folder;
        $uploadaction = "imageupload.php?folder=".$folder;
        $now = date("D M j G:i:s T Y");
        foreach ($contents as $line) {
            //echo htmlentities($line)."<br>\n";
            $ret = eval("echo \"$line\";");
        }
        
    } else {
        echo "<font color=\"red\">";
        echo '找不到 "'.$folder.'" 目錄。<br>';
        echo "</font>";
        exit;
    }
}
?>
