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
    // ¡¦¥æ¡¦¥¥¡¦ö§¥¿¥Æ¥¢¡¼¥Õ¡¢¥Ì¡¢¥Û¡¦¡¢¡¦â£¥·¡¦¥¯¥Î¥¹¥·¥£¡¦¥à¡¦ò§â£¥·¡¦¥½¥¿¡¬¥Èê
    //
    if ( is_dir($param['DATA_FOLDER'].'/'.$folder) ) {
        // $param_path ¥Ï¥à¥½€€ò eval_param.php ¥Ëä¦¥Ì¥µ¥Í¥Ø¥à
        $param_path=$param['DATA_FOLDER'].'/'.$folder."/".$param_file;
        if (! file_exists($param_path) ) {
            $original_directory=$folder;
            include("eval_param.php");
            //evalparam($param_template, $param_path);
        }
        
        // ¥±¥±¥½¥­¥µ€€¥Ò¥Ï¥à¥½€€¥Ø¡¢¥Û¥Î¥¹¥·¥£
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
        
        // ¡¦¡¢¡¦â£¥·¡¦¥¯¡¦¥à¡¦ò§â£¥·¡¦¥½¥¿¡¬¥Èô§¥æ¡¦¥¥¡£¥·¡¦à¦¥Û¥Î¥¹¥·¥£
        include($param_path);    // ¡¦¥Ì¡¦¥æ¡¦¥¥¡¦ö§¥Í¥Æ¥Ø¥Èô·¥Á
        
        // ¡¦¥­¡¦€€¥é¡¦ö§¥Ë¡¦€€¥é¡¦ø£¥·¡¦¥Í¡¢¥Ò¡¢¥Ë¡£¥Ï¥Ï¥¯¥µ€€¥Ò¥Æú²¥æ¡£¥¡ '"' ¡¢¥Þ¥µ¥Í¡¢¥£¡¢¥Ï¡¢¡¢¡£¥Ò
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
        echo '¡¦¥æ¡¦¥¥¡¦ö§¥¿ "'.$folder.'" ¡¢¥ã¥¯¥©¡¢¥È¡¢¥©¡¢ô¦¡«¡¢¥µ¡¢€€¡×<br>';
        echo "</font>";
        exit;
    }
}
?>
