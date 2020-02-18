<?php
require_once 'HTML/Template/IT.php';            // HTML_Template_IT 類別
require_once "config_util.php";
$param=read_config('config/param.xml');         // 讀入參數
include("config/imageparam.default.php");       // 預設值定義
require_once "imagetool.php";

function image_upload( $cmd, $folder, $org_path, $org_uri, $tn_dir, $wk_dir, $max_uploads )
{

    $tpl = new HTML_Template_IT('./template/');
    $tpl->loadTemplatefile('imageupload.template.html', true, true);
    $tpl->setVariable('ACTION', $_SERVER['PHP_SELF']);
    $tpl->setVariable('FOLDER', $folder);
    switch ($cmd) {
     case 'upload':
         // upload處理
         break;
     case 'delete':
         // delete處理
         break;
     default:
         // 無處理
     }

     // 檔案清單
     $file_list = get_file_list($org_path, false, 'name', 'ascend', 'type=file');
     $cnt = count($file_list);
     if ( $cnt >= $max_uploads ) {
         Error("image_upload: maximum number of files uploaded $cnt>=$max_uploads", __LINE__, __FILE__);
     } else {
         $tpl->setCurrentBlock('upload_form');
         $tpl->parseCurrentBlock();
     }

     if ( empty($file_list) ) {
         //Error("image_upload: empty file_list", __LINE__, __FILE__);
         $file="     --- no files ---";
         $data_size="     ...     ";
         $timestamp="     ...     ";
         $data_kind="     ...     ";
         $list_id='';
         $checked='';
         pane_order_upload($tpl, $file, $data_size, $timestamp, $data_kind, $list_id, $checked);
     } else {
        $n=0;
        while ( list($filename, $fileattr) = each($file_list) ) {
             if ( $filename != '.' || $filename != '..' ) {
                 // $icon_name= "$org_uri/$tn_dir/fav.".$filename.'.png';
                 $icon_name= "$org_path/$tn_dir/fav.".$filename.'.png';
                 $data_size=$fileattr['size'];
                 $timestamp=date('Y-m-d H:i:s', $fileattr['mtime']);
                 $data_kind= GetImgTypeString( "$org_path/$filename" );
                 $list_id=$n;
                 $checked='';
                 pane_order_upload($tpl, $filename, $data_size, $timestamp, $data_kind, $list_id, $checked, $icon_name);
                 $n++;
             }
          }
     }
     $tpl->setVariable('ACTION', $_SERVER['PHP_SELF']);
     $tpl->setVariable('FOLDER', $folder);
     $tpl->show();
}

function pane_order_upload ( &$tpl, $file_name, $data_size, $timestamp, $data_kind, $list_id, $checked, $icon_name='' )
 {
     $tpl->setCurrentBlock('upload_files');
     $tpl->setVariable('FILE_NAME', $file_name);
     $tpl->setVariable('ICON_NAME', $icon_name);
     $tpl->setVariable('DATA_SIZE', $data_size);
     $tpl->setVariable('TIMESTAMP', $timestamp);
     $tpl->setVariable('DATA_KIND', $data_kind);
     $tpl->setVariable('LIST_ID', $list_id);
     $tpl->setVariable('CHECKED', $checked);
     $tpl->parseCurrentBlock();
 }
?>

