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
    // ・ユ・ゥ・�Д織謄◆璽奸▲漫▲曄Α◆�癸シ・クノスシィ・ム・鬣癸シ・ソタ゜ト�
    //
    if ( is_dir($param['DATA_FOLDER'].'/'.$folder) ) {
        // $param_path ハムソ��� eval_param.php ニ筅ヌサネヘム
        $param_path=$param['DATA_FOLDER'].'/'.$folder."/".$param_file;
        if (! file_exists($param_path) ) {
            $original_directory=$folder;
            include("eval_param.php");
            //evalparam($param_template, $param_path);
        }
        
        // ケケソキサ��ヒハムソ��ヘ、ホノスシィ
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
        
        // ・、・癸シ・ク・ム・鬣癸シ・ソタ゜ト�Д罅Εァ�シ・爨ホノスシィ
        include($param_path);    // ・ヌ・ユ・ゥ・�Д優謄悒飛轡�
        
        // ・キ・��ラ・�Д法���ラ・��シ・ネ、ヒ、ニ。ハハクサ��ヒテ�殴罅�ァ '"' 、マサネ、ィ、ハ、、。ヒ
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
        echo '・ユ・ゥ・�Д� "'.$folder.'" 、ャクォ、ト、ォ、熙゛、サ、��」<br>';
        echo "</font>";
        exit;
    }
}
?>
