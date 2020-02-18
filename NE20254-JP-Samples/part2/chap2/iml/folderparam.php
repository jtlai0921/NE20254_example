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
    // ���桦���������ƥ����ա��̡��ۡ�����⣥������Υ��������ࡦ�⣥������������
    //
    if ( is_dir($param['DATA_FOLDER'].'/'.$folder) ) {
        // $param_path �ϥॽ��� eval_param.php ��䦥̥��ͥإ�
        $param_path=$param['DATA_FOLDER'].'/'.$folder."/".$param_file;
        if (! file_exists($param_path) ) {
            $original_directory=$folder;
            include("eval_param.php");
            //evalparam($param_template, $param_path);
        }
        
        // �������������ҥϥॽ���ء��ۥΥ�����
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
        
        // ������⣥��������ࡦ�⣥��������������桦��������থۥΥ�����
        include($param_path);    // ���̡��桦�������ͥƥإ�����
        
        // ���������顦���ˡ����顦�������͡��ҡ��ˡ��ϥϥ������ҥ����档�� '"' ���ޥ��͡������ϡ�������
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
        echo '���桦�������� "'.$folder.'" ���㥯�����ȡ�������������������<br>';
        echo "</font>";
        exit;
    }
}
?>
