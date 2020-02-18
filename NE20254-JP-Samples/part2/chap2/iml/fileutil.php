<?php
//   File Check Utilities and the Other Functions
//
// Jun Kuwamura <juk@yokohama.email.ne.jp>
//	Sun Sep 15 23:02:49 JST 2002
//
// 2005-02-28 JuK add filepermision setting by myfilemode()
// 2003-11-23 JuK Add hidden option for get_file_list
// 2003-07-20 JuK Add zip file handling
// 2002-10-21 JuK 
//
require_once "checkutil.php";
require_once "dirfilelist.php";

///////////////////////////////////////////////////////////////////////
// check and unlink file
//  $filepath: file name
///////////////////////////////////////////////////////////////////////
function remove_file ( $filepath )
{
  if ( file_exists("$filepath") ) {
    unlink("$filepath");
  }
}

///////////////////////////////////////////////////////////////////////
// Read the file
//  $filepath: file name
///////////////////////////////////////////////////////////////////////
function read_file ( $filepath )
{
  return join('', file("$filepath"));
}

///////////////////////////////////////////////////////////////////////
// Write contents to the file
//  $filepath: file name
//  $contents: file contents
///////////////////////////////////////////////////////////////////////
function write_file ( $filepath, $contents )
{
  $fp = fopen( $filepath, 'w');
  if (! $fp ) {
    Error("write_file: file open error: $filepath");
    return false;
  } else {
    chmod($filepath, myfilemode());
    if ( fwrite($fp, $contents)  == -1 ) {
      Error("write_file: file output error: $filepath");
      fclose($fp);
      return false;
    }
    fclose($fp);
  }
  return true;
}


///////////////////////////////////////////////////////////////////////
// Read the file backup number included
//  $filepath: file name
///////////////////////////////////////////////////////////////////////
function read_file_lock ( $filepath )
{
    $buffer = array();
    if ( file_exists($filepath) ) {
	$buffer = file($filepath);
	$bknum = array_shift($buffer);
	return $buffer;
    } else {
	return $buffer;
    }
}

///////////////////////////////////////////////////////////////////////
// Write contents to the file with lock
//  $filepath: file name
//  $contents1: file contents to add
//  $contents2: file contents to add(optional)
///////////////////////////////////////////////////////////////////////
function write_file_lock ( $filepath, $content1, $content2 = '')
{
    define('BACKUP_NUM_LIMIT', 10);
    //    $code = mb_detect_encoding($content1, "auto");
    //    if ( $code != "EUC-JP" && $code != "ASCII" ) {
    //	echo "$code<br>";
    //	$content1 = mb_convert_encoding( $content1, "EUC-JP", "auto");
    //	$content2 = mb_convert_encoding( $content2, "EUC-JP", "auto");
    //    }

    // create lock file
    $lockfile = $filepath . ".lck";
    touch ($lockfile);
    if (! file_exists($filepath) ) {
	// ¥¹ò§¥£¡¦€€¥Í¡¦ê
	$buffer[0] = "000";
	$buffer[1] = $content1;
    } else {
	// ¥¨€€¥¯¡¦¥æ¡¦¡£¡¦¡¢¡¦ö¦€€¥í¥Û€€¥Ò¥Ë¥Î¥±€€¡¬
	$buffer = array();
	$buffer = file($filepath);
	// ¡¼ø»¥ä¥Õ¥ï¡¢¥Û¥³¥Ì¥¹¥§¡¦¥ß¡¦¥Æ¡¦¥Ã¡¦¡Ö¡¦¥Æ¡¦¥é¥Í¥è¥±ì¦€€¥©¡¦¥ò¡¦€€¥Í¡¦¡Ö¡¦¥Æ¡¦¥é
	$bkname = strtok($buffer[0],",");
	if ( (int)$bkname >= BACKUP_NUM_LIMIT ) {
	    $bkname = sprintf("%03d",1);
	} else {
	    $bkname = sprintf("%03d",($bkname + 1));
	}
	// ¥¯¥¹¥³¡¬¡¢¥Û¡¦¥ß¡¦¥Æ¡¦¥Ã¡¦¡Ö¡¦¥Æ¡¦¥é¡¢€€üÂ¥ç
	$backfile = "$filepath.$bkname";
	if (! copy($filepath, "$backfile") ) {
	    Error("DB file backup failed: $filepath", __LINE__, __FILE__);
	    unlink ("$lockfile");
	    exit;
	}
	chmod($backfile, myfilemode());
	// ¡¦¥ß¡¦¥Æ¡¦¥Ã¡¦¡Ö¡¦¥Æ¡¦¥é¥Í¥è¥±ì»¥±¥½¥­¡£¥½¥½¥­¡¦¥£¡¦€€¥Í¡¦ô¦€€¥Î¥¤¥Æ
	$buffer[0] = $bkname;
	$buffer[] = $content1;
    }

    // ¡¦¥§¡¦¥é¡¦¥­¡¦î§€€¥Ì¡¢ä¦¥ò¡¼ø»¥ä¥È¥Î¥¤¥Æ
    if (! empty($content2) ) {
	$buffer[] = $content2;
    }

    // ¥½¥­ DB ¡¦¥æ¡¦¡£¡¦¡¢¡¦ö¦€€¥ß¥Û¥Þ
    $fp = fopen($filepath, "w");
    while ( list($k, $v) = each($buffer) ) {
	$v = trim($v);
	if (! empty($v) ) {
	    if ( fwrite($fp, "$v\n") == -1 ) {
		Error("DB file writing failed: $filepath", __LINE__, __FILE__);
		fclose($fp);
		unlink ("$lockfile");
		exit;
	    }
	}
    }
    fclose($fp);
	chmod($filepath, myfilemode());
    // drop lock file
    unlink ($lockfile);
}


///////////////////////////////////////////////////////////////////////
// Get file list from specified directory
//  $dir: directory name
//  $hidden: show hidden file(.file) or not
//  $sort: by what sort(name, mtime, size)
//  $cend: in which order(ascend, decend)
//  $selection: selection condition
///////////////////////////////////////////////////////////////////////
function get_file_list ( $dir, $hidden=true, $sort="name", $cend="ascend", $selection="type=file" )
{
  if ( empty($dir) ) {
    Error("get_file_list: empty dir: $dir");
    return;
  }
  if (! check_readable_folder($dir) ) {
    Error("get_file_list: note readable dir: $dir");
    return;
  }
  $file_list = dir_file_list ($dir, $sort, $cend, $selection);
  if ( empty($file_list) ) {
    Error("get_file_list: no file found");
    return;
  }

  // hide hiddenfile
  if ( $hidden == false ) {
    $new_list = array();
    while (list ($key,$val) = each ($file_list)) {
      if ( substr($key, 0, 1) != '.' ) {
        $new_list[$key] = $val;
      }
    }
    $file_list = $new_list;
  }
  return $file_list;
}

///////////////////////////////////////////////////////////////////////
// Get zip file entry infomations or extract the files
//  $zipfile: zip file name
//  $mode: mode(read, extract)
//  $dir: in which directory to extracted it
//  $mdsub: make sub directory or not
///////////////////////////////////////////////////////////////////////
function get_zip_entry ( $zipfile, $mode = 'info', $dir = '', $mdsub = false )
{
  if ( !extension_loaded('zip') ) {
    if (! dl('zip.so') ) {
      Error("file upload error: $new_filename, error to load zip.so", __LINE__, __FILE__);
      return;
    }
  }

  $zip = zip_open("$zipfile"); 
  if ($zip) {
    $zip_info = array();
    while ($zip_entry = zip_read($zip)) {
      $entry_info = array();
      $entry_info['Name'] = zip_entry_name($zip_entry);
      $entry_info['FileSize'] = zip_entry_filesize($zip_entry);
      $entry_info['CompressedSize'] = zip_entry_compressedsize($zip_entry);
      $entry_info['CompressionMethod'] = zip_entry_compressionmethod($zip_entry);
      if (zip_entry_open($zip, $zip_entry, "r")) {
        if ( $mode == 'read' || $mode == 'extract') {
          $entry_info['Contents'] = zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
          if ($mode == 'extract') {
            if ( $mdsub ) {
              $subdir = dirname($entry_info['Name']);
              if ( file_exists("$dir/$subdir") && (! is_dir("$dir/$subdir") ) ) {
                if (! unlink("$dir/$subdir") ) {
                  Error("get_zip_entry: subdir remove error: $zipfile($dir/$subdir)", __LINE__, __FILE__);
                }
              }
              if ( ( $subdir != '.' ) && (! file_exists("$dir/$subdir") ) ) {
                if (! mkdir("$dir/$subdir", myfilemode() + 0111) ) { // 0777
                  Error("get_zip_entry: subdir make error: $zipfile($dir/$subdir)", __LINE__, __FILE__);
                }
              }
              $newfilepath = $dir.'/'.$entry_info['Name'];
            } else {
              if ( $entry_info['FileSize'] > 0 ) {
                $newfilepath = $dir.'/'.basename($entry_info['Name']);
              }
            }
            // file_put_contents
            if (! write_file($newfilepath, $entry_info['Contents']) ) {
              Error("get_zip_entry: zip entry write_file error: $zipfile($zip_entry)", __LINE__, __FILE__);
              unset($entry_info);
            }
          }
        }
        zip_entry_close($zip_entry);
      } else {
        Error("get_zip_entry: zip entry open error: $zipfile($zip_entry)", __LINE__, __FILE__);
        unset($entry_info);
      }
      if ( isset($entry_info) ) {
        $zip_info[] = $entry_info;
      }
    }
    zip_close($zip);
    if ( $mode == 'extract' ) {
      if (! unlink($zipfile) ) {
        Error("get_zip_entry: zip file remove error: $zipfile", __LINE__, __FILE__);
      }
    }
    return $zip_info;
  } else {
    Error("get_zip_entry: file open error: $zipfile", __LINE__, __FILE__);
    return;
  }
}

?>
