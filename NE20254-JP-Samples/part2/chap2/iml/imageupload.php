<?php
/*
 *  imageupload
 *  -----------
 *   File:    imageupload.php
 *   Usage:   upload and list files
 *   Date:    2003-07-20
 *   Auther:  Jun Kuwamura <juk@yokohama.email.ne.jp>
 *   Version: 0.5
 *   History:
 *    2005-02-28 JuK add filepermision setting by myfilemode()
 *    2005-02-26 JuK Mod myauth.php as wrapper of Auth class
 *    2005-02-20 JuK Add Authentication with PEAR Auth
 *    2005-02-01 JuK Mod user config/param.xml
 *    2003-11-23 JuK Add folder name specification.
 *    2003-07-27 JuK add for parameter specification
 *
 */
require_once 'HTML/Template/IT.php';
require_once "config_util.php";
$param=read_config('config/param.xml');
include("config/imageparam.default.php");    // ¡¦¥Ì¡¦¥æ¡¦¥¥¡¦ö§¥Í¥Æ¥Ø¥Èô·¥Á
require_once "imagetool.php";

function image_upload( $cmd, $folder, $org_path, $org_uri, $tn_dir, $wk_dir, $max_uploads ) {

  if ( isset($_POST['list_id']) ) {
    if ( is_array($_POST['list_id']) ) {
	    while( list($i, $val) = each($_POST['list_id']) ) {
        $list_id[$i] = $val;
	    }
    } else {
	    $list_id = quotemeta($_POST['list_id']);
    }
  }
  
  $tpl = new HTML_Template_IT('./template/');
  $tpl->loadTemplatefile('imageupload.html', true, true);
  $tpl->setVariable('ACTION', $_SERVER['PHP_SELF']);
  $tpl->setVariable('FOLDER', $folder);
  
  switch ($cmd) {
    // ¡¦¡Ö¡¦¥Æ¡¦¥é¡¦ú£¥·¡¦¥Î¥¹ðÏý
  case 'upload':
    $new_filename = basename($_FILES['sourcedata']['name']);
    $new_filepath = $org_path.'/'.$new_filename;
    if ( file_exists($new_filepath) ){
      Error("file upload warning: $new_filepath, overwritten", __LINE__, __FILE__);
    }
    if ( move_uploaded_file($_FILES['sourcedata']['tmp_name'], $new_filepath) ) {
      // ¡¦¥ª¡£¥·¡¦¥ß¡¦¡«¡¦¥­¡¦€€ê¦¥Û¡¼ø½€€¥æ¡¦¡£¡¦¡¢¡¦öÎ¥»//  $_FILES['sourcedata']['tmp_name']
      // ¥Á€€ô¾ôÄ¥ò¡¢¥Û¡¦¥§¡¦ô§¥¯¡¦¥Ï¡¦ö£¥ò¡¦¥æ¡¦¡£¡¦¡¢¡¦öÎ¥»//  $_FILES['sourcedata']['name']
      // ¡¦¡Ö¡¦¥Æ¡¦¥é¡¦ú£¥·¡¦¥Î¡¢¥ª¡¢ø¦¥½¡¦¥ß¡¦¡¢¡¦¥Í¡¦¥ª¡¦¡¢¡¦¥³//  $_FILES['sourcedata']['size']
      // ¡¦¥è¡¦ò§¥ò¡¦¥«¡¢¥ã¥¿¥¯¥¿¥ç¡¢¥­¡¢¥½MIME¡¦¥½¡¦¡¢¡¦¥é//  $_FILES['sourcedata']['type']
      // ¡¦¡Ö¡¦¥Æ¡¦¥é¡¦ú£¥·¡¦¥Î¡¢¥Ò¥¨¥ê¡¢¥±¡¢ö§¥£¡¦ò£¥·¡¦¥¦¡£¥·¡¦¥Î//  $_FILES['sourcedata']['error']
      // ¥Æú£¥¡ php.ini¡¢¥Û file_uploads, upload_max_filesize, upload_tmp_dir, post_max_size ¡¦¥Ì¡¦¡×¡¦ø§¥Ã¡¦¥Ë¡¦¡×¡¦¥è¡¢ä½¥¤¥»¥Í¡¢¥Û¡¢¥¦¡¢¥Í
      chmod($new_filepath, myfilemode());

      // Zip¡¦¥æ¡¦¡£¡¦¡¢¡¦ö¦¥Û¥Ê¥¯¥¦¥©¥¹ðÏý
      $path_parts = pathinfo( $new_filepath );
	    if ( $path_parts['extension'] == 'zip' ) {
        $zip_info = $path_parts;
        $zip_info = get_zip_entry( $new_filepath, 'extract', $org_path );
        if (! empty($zip_info) ) {
          while ( list($i, $entry_info) = each($zip_info) ) {
            $newfilename = basename($entry_info['Name']);
            if (! ResizeImg( 24, 18, $newfilename, "$org_path/$tn_dir", $org_path, true, 'fav.', 'png') ) {
              Error("creating favicon size image.", __LINE__);
            }
          }
        }
	    } else {
        if (! ResizeImg( 24, 18, $new_filename, "$org_path/$tn_dir", $org_path, true, 'fav.', 'png') ) {
          Error("creating favicon size image.", __LINE__);
        }
	    }
    } else {
	    //echo " ... failed.";
	    Error("file upload error: $new_filepath,error(".$_FILES['sourcedata']['error'].")", __LINE__, __FILE__);
    }
    break;
    // ¡¦¥Ì¡¦ô£¥·¡¦¥Í¥¹ðÏý
  case 'delete':
    if (! empty($list_id) ) {
	    while ( list($key, $del_filename) = each($list_id) ) {
        if ( unlink("$org_path/$del_filename") ) {
          RmWorkImg($org_path, $tn_dir, $wk_dir, $del_filename);
        } else {
          Error("file delete error: $del_filename", __LINE__, __FILE__);
        }
	    }
    }
    break;
    // ¥³ü¸¥Í¡¦¥æ¡¦¡£¡¦¡¢¡¦ö¦¥Û¡¢¡¬¡¦¥Ì¡¦ô£¥·¡¦¥Í¥¹ðÏý
  case 'remove_work':
    $items = array_keys(get_file_list($org_path, $hidden=false, $sort="name", $cend="ascend", $selection="type=file"));
    if (! empty($items) ) {
	    while ( list($key, $del_filename) = each($items) ) {
        RmWorkImg($org_path, $tn_dir, $wk_dir, $del_filename);
	    }
    }
    break;
  default:
    // ¥¹ðÏ€€¥Ï¡¢¥­
  }
  
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
    if ( $n >= $max_uploads ) {
	    $file="     --- maximum upload files  ---";
	    $data_size="     ---     ";
	    $timestamp="     ---     ";
	    $data_kind="     ---     ";
	    $list_id='';
	    $checked='';
	    pane_order_upload($tpl, $file, $data_size, $timestamp, $data_kind, $list_id, $checked);
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


//
// Authentication
//
require_once 'myauth.php';
$auth = new MyAuth($param['AUTH_DSN'], 28800, 1800 );
$auth->start();

if ( $auth->checkAuth() ) {
    //
    // Image Folder Manupilation
    //

    $cmd = "list";
    if ( isset($_POST['cmd']) ) {
        $cmd=addevalslashes($_POST['cmd']);
    }
    $folder='';
    if (! empty($_GET['folder']) )	$folder=basefoldername($_GET['folder']);
    
    // include parameters
    if ( !empty($folder) ) {
        $param_file = $param['DATA_FOLDER']."/".$folder."/.imageparam.php";
    }
    if ( file_exists($param_file) ) {
        require_once($param_file);
    } else {
        echo "No parameter file($param_file) found.<br>";
        exit;
    }

    $uparams['upload_max_filesize'] = ini_get('upload_max_filesize');
    $uparams['upload_tmp_dir'] = ini_get('upload_tmp_dir');
    $uparams['post_max_size'] = ini_get('post_max_size');
    $uparams['memory_limit'] = ini_get('memory_limit');
    if ( empty($uparams['upload_tmp_dir']) ) {
        $uparams['upload_tmp_dir'] = $param['ROOT_DIRECTORY_PATH'].'/'.$param['DATA_FOLDER'];
        //ini_set('upload_tmp_dir', $uparams['upload_tmp_dir']);
}
    if (! check_writable_folder($uparams['upload_tmp_dir']) ) {
        Error("upload_tmp_dir is not set in php.ini", __LINE__, __FILE__);
    }
    if ( $uparams['memory_limit'] < $uparams['post_max_size'] ) {
        $uparams['memory_limit'] = '10M';//$uparams['post_max_size'];
    }
    if ( $uparams['upload_max_filesize'] > $uparams['post_max_size'] ) {
        //echo "upload_max_filesize(".$uparams['upload_max_filesize'].")>post_max_size(".$uparams['post_max_size'].")<br>";
        $uparams['upload_max_filesize'] = $uparams['post_max_size'];
    }
    //var_export($uparams);echo "<br>";
    //pre_var_dump($_POST);
    echo "upload max filesize = ".$uparams['upload_max_filesize'];
    echo " / "."max number of uploaded files = ".$max_uploads;
    echo "<br>";

    $original_directory_path = $param['ROOT_DIRECTORY_PATH'].'/'.$param['DATA_FOLDER'].'/'.$original_directory;
    $original_directory_uri = $param['ROOT_DIRECTORY_URI'].'/'.$param['DATA_FOLDER'].'/'.$original_directory;
    if (! check_writable_folder($original_directory_path) ) {
        Error("folder is not writeable: $original_directory_path", __LINE__, __FILE__);
    }
    if (! check_writable_folder("$original_directory_path/$thumbnail_directory") ) {
        Error("folder is not writeable: $original_directory_path/$thumbnail_directory", __LINE__, __FILE__);
    }
    if (! check_writable_folder("$original_directory_path/$work_directory") ) {
        Error("folder is not writeable: $original_directory_path/$work_directory", __LINE__, __FILE__);
    }

    image_upload($cmd, $folder, $original_directory_path, $original_directory_uri, $thumbnail_directory, $work_directory, $max_uploads);
}

?>
