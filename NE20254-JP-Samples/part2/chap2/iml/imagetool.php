<?php
//   Tool Functions for Image List Creation
//
// Jun Kuwamura <juk@yokohama.email.ne.jp>
//	Mon Jan 22 01:22:57 JST 2001
//
// 2005-02-28 JuK add filepermision setting by myfilemode()
// 2005-02-07 JuK Mod add BMP, TIFF and XPM operateions
// 2004-11-28 JuK Mod add GIF image creation
// 2003-12-08 JuK Add frame label parameter to ReCreatImg
// 2003-12-07 JuK Add ImageResample option for smoothing resize.
// 2003-11-24 JuK Add frame size parameter to ReCreatImg
// 2003-11-24 JuK Add RmWorkImg
// 2003-11-23 JuK Add folder name specification.
// 2003-11-23 JuK Mod check encoding before mb_convert_encoding
// 2003-09-26 JuK Mod using bundled GD imagerotate
// 2003-08-28 JuK Mod set encoding(UTF-8) for image string
// 2003-08-10 JuK Add rotate functionarity in ReCreatImg
// 2003-07-27 JuK Add GetImgTypeName, ResizeImg
// 2003-07-21 JuK Add GetImgTypeString
// 2002-09-16 JuK Add extra info from server in remarks.
// 2002-09-15 JuK Seperate utility and file check functions to another file.
// 2002-08-28 JuK Mod ReCreatImg for zero sized file in black.
// 2002-07-04 JuK Mod ReCreatImg for original sized image.
// 2002-07-04 JuK Add image modtime function.
// 2002-02-17 JuK devide tool functions to here.
//
require_once("imagekanji.php");
require_once("checkutil.php");

///////////////////////////////////////
// Check GD module and load it if not
///////////////////////////////////////
if(!extension_loaded('gd')){
  if(!dl('gd.so')){
    echo 'error';
    exit;
  }
}

///////////////////////////////////////////////////////////////////////
// Get image type in string
//	$img_path: image file path
// (Unix file command used for unknown formats)
///////////////////////////////////////////////////////////////////////
function GetImgTypeString( $img_path )
{
  if ( $itype = getimagesize( $img_path ) ) {
    return $itype['mime'];
  } else {
    return `file $img_path | cut -f2 -d:`;
  }
}

///////////////////////////////////////////////////////////////////////
// Get image format type
//	$img_path: image file path
// (Unix file command used for XPM format, which size is directly read)
///////////////////////////////////////////////////////////////////////
function GetImgType( $img_path )
{
  if ( ! file_exists("$img_path") ) {
    Debug("Error:  File is not existed:  $img_path", 9);
    return 0;
  }
  if ( is_dir("$img_path") ) {
    Debug("Error:  File is a directory:  $img_path", 9);
    return 0;
  }
  $iminfo = array();
  if ( filesize($img_path) == 0 ) {
    $iminfo[0]=0;
    $iminfo[1]=0;
    $iminfo[2]=0;
  } else {
    $iminfo = GetImageSize("$img_path");
    if ( empty($iminfo) ) {
      $iminfo[0]=0;
      $iminfo[1]=0;
      $iminfo[2]=0;
      $ret = `file $img_path | cut -f2 -d:`;
      if ( strpos( $ret , "X pixmap" ) ) {
	$i = implode(',',file($img_path));
	$a = explode('"',$i);
	$s = explode(' ',$a[1]);
	$iminfo[0]=$s[0];
	$iminfo[1]=$s[1];
	$iminfo[2]=17;
      }
    }
  }
  // $iminfo[2](from ext/standard/php_image.h):
  //	 UNKNOWN=0,GIF=1,JPEG=2,PNG=3,SWF=4,PSD=5,BMP=6,
  //	 TIFF_II=7(intel),TIFF_MM=8(motorola),JPC=9,JP2=10,JPX=11,JB2=12,
  //	 SWC=13,IFF=14,WBMP=15,XBM=16
  return $iminfo[2];
}

///////////////////////////////////////////////////////////////////////
// Get image pixels in "{width}x{height}" format
//	$img_path: image file path
///////////////////////////////////////////////////////////////////////
function GetImgPixels( $img_path )
{
  $iminfo = array();
  if ( file_exists($img_path) ) {
    if ( filesize($img_path) == 0 ) {
      $iminfo[0]=0;
      $iminfo[1]=0;
      $iminfo[2]=0;
    } else {
      $iminfo=GetImageSize("$img_path");
      if ( empty($iminfo) ) {
        $iminfo[0]=0;
        $iminfo[1]=0;
        $iminfo[2]=0;
      }
    }
  } else {
    Error("File is not existed: $img_path", __LINE__);
    return;
  }
  Debug("File:$img_path type = $iminfo[2]", 5);
  $img_pixels=$iminfo[0]."x".$iminfo[1];
  Debug("pixcels=$img_pixels", 9);
  return $img_pixels;
}

///////////////////////////////////////////////////////////////////////
// Get IPTC data item from jpeg file
//	$jpegfile: jpeg image file path
///////////////////////////////////////////////////////////////////////
function GetIPTCData( $jpegfile, $keyword='THUMBNAIL' )
{
    $size = getimagesize ($jpegfile, $info);
    if (isset ($info["APP13"])) {
        $iptc = iptcparse ($info["APP13"]);
        //var_dump ($iptc);
	return($iptc);
    }
}

///////////////////////////////////////////////////////////////////////
// Get EXIF data item from jpeg file
//	$jpegfile: jpeg image file path
///////////////////////////////////////////////////////////////////////
function GetExifData( $jpegfile, $keyword='THUMBNAIL' )
{
  if( extension_loaded('exif') ){
    $exif = read_exif_data($jpegfile);
    while(list($k,$v)=each($exif)) {
      if ( strtoupper($k) == strtoupper($keyword) ) {
        return($v);
      }
    }
  }
  return;
}

///////////////////////////////////////////////////////////////////////
// Get image modification time
//	$img_path: image file path
///////////////////////////////////////////////////////////////////////
function GetImgModTime( $img_path )
{
  $imgtype = GetImgType($img_path);
  if ( $imgtype == 2 ) {
    $dtstring = GetExifData( $img_path, 'DateTime');
  }
  if (! empty($dtstring) ) {
    return $dtstring;
  } else {
    return strftime("%Y-%m-%d %H:%M", filemtime($img_path));
  }
}

///////////////////////////////////////////////////////////////////////
// Get image type name
//	$img_file: image file path name to read in
///////////////////////////////////////////////////////////////////////
function GetImgTypeName( $img_file )
{
  $i = GetImgType($img_file);
  // from ext/standard/php_image.h
  // (17:xpm is added by JuK)
  $imagename = array('0' => 'unknown',
		     '1' => 'gif',
		     '2' => 'jpeg',
		     '3' => 'png',
		     '4' => 'swf',
		     '5' => 'psd',
		     '6' => 'bmp',
		     '7' => 'tiff_ii',
		     '8' => 'tiff_mm',
		     '9' => 'jpc',
		     '10' => 'jp2',
		     '11' => 'jpx',
		     '12' => 'jb2',
		     '13' => 'swc',
		     '14' => 'iff',
		     '15' => 'wbmp',
		     '16' => 'xbm',
		     '17' => 'xpm' );
  return($imagename[$i]);
}

///////////////////////////////////////////////////////////////////////
// Create a image from reading a image file in
//	$img_file: image file path name to read in
// (NetPBM external commands are used for BMP and TIFF formats)
///////////////////////////////////////////////////////////////////////
function CreatImgFrom( $img_file )
{
  switch ( GetImgType($img_file) ) {
  case 1:	// GIF
	  $img = ImageCreateFromGIF($img_file);
	  break;
  case 2:	// JPEG
	  $img = ImageCreateFromJPEG($img_file);
	  break;
  case 3:	// PNG
	  $img = ImageCreateFromPNG($img_file);
	  break;
/*
;  case 4:	// SWF
	  $img = ImageCreateFromSWF($img_file);
	  break;
;  case 5:	// PSD
	  $img = ImageCreateFromPSD($img_file);
	  break;
*/
  case 6:	// BMP
	  $img_jpeg = $img_file.".jpeg";
	  $ret = `bmptopnm $img_file | pnmtojpeg > $img_jpeg`;
	  $img = ImageCreateFromJPEG($img_jpeg);
	  unlink($img_jpeg);
	  break;
  case 7:	// TIFF_II
  case 8:	// TIFF_MM
	  $img_jpeg = $img_file.".jpeg";
	  $ret = `tifftopnm $img_file | pnmtojpeg > $img_jpeg`;
	  $img = ImageCreateFromJPEG($img_jpeg);
	  unlink($img_jpeg);
	  break;
/*
;  case 9:	// JPC
	  $img = ImageCreateFromJPEG($img_file);
	  break;
;  case 10:	// JP2
	  $img = ImageCreateFromJPEG($img_file);
	  break;
;  case 11:	// JPX
	  $img = ImageCreateFromJPEG($img_file);
	  break;
;  case 12:	// JB2
	  $img = ImageCreateFromJPEG($img_file);
	  break;
;  case 13:	// SWC
	  $img = ImageCreateFromSWC($img_file);
	  break;
;  case 14:	// IFF
	  $img = ImageCreateFromIFF($img_file);
	  break;
*/
  case 15:	// WBMP
	  $img = ImageCreateFromWBMP($img_file);
	  break;
  case 16:	// XBM
	  $img = ImageCreateFromXBM($img_file);
	  break;
  case 17:	// XPM
	  $img = ImageCreateFromXPM($img_file);
	  break;
  default:
	  return;
	  break;
  }
  return $img;
}

///////////////////////////////////////////////////////////////////////
// Write a image file out
//	$img: internal image
//	$img_file: image file path name to write out
//	$img_fmt: image format(gif|jpeg|png|wbmp)
//	$qty: image quolity for JPEG compression(0-100)
///////////////////////////////////////////////////////////////////////
function SaveImgTo( $img, $img_file, $img_fmt="jpeg", $qty=81 )
{
  global $TEST;
  if ( $TEST > 3 ) {
    include( "print_func_args.php" );
  }

  // ImageInterlace($img, 1);

  switch ( strtolower($img_fmt) ) {
  case "gif":	// GIF
    return ImageGIF($img, $img_file);
    break;
  case "jpeg":	// JPG
    return ImageJpeg($img, $img_file, $qty);
    break;
  case "png":	// PNG
    return ImagePNG($img, $img_file);
    break;
  case "wbmp":	// SWF
    return ImageWBMP($img, $img_file);
    break;
  default:
    return 0;
    break;
  }
}

///////////////////////////////////////////////////////////////////////
// Read remarks for image from file.
//	$dir: directory
//	$img: image name(not a actual remark file name) 
///////////////////////////////////////////////////////////////////////
function RdImgRemark( $dir, $img, $line = __LINE__ )
{
  global $TEST;
  if ( $TEST > 3 ) {
    echo "Line: $line";
    include( "print_func_args.php" );
  }

  $rmk='';
  // The remarks file extention to be ".txt".
  $pieces = explode(".", $img);
  $file = "$pieces[0].txt";

  // Check readable and read remarks.
  $filename = ChkReadable($dir, $file, __LINE__);
  if ( empty($filename) ) {
    return;
  } else {
    $fd = fopen ($filename, "r");
    if ($fd) {
      $rmk = fread($fd, filesize($filename));
    } else {
      Error("$filename could not be opened to read.", $line);
      return;
    }
    fclose ($fd);
  }

  $i_enc = mb_internal_encoding();
  $d_enc = mb_detect_encoding($rmk);
  if (! empty($d_enc) ) {
    $rmk = mb_convert_encoding($rmk, $i_enc, $d_enc);
  }

  return $rmk;
}

///////////////////////////////////////////////////////////////////////
// Write remarks for image from file.
//	$dir: directory
//	$img: image name(not a remark file name) 
//	$rmk: remarks to save in a file
//	$edit: o: overwrite, a: append
///////////////////////////////////////////////////////////////////////
function WtImgRemark( $dir, $img, $rmk, $line = __LINE__, $edit="o" )
{
  global $TEST;
  if ( $TEST > 3 ) {
    echo "Line: $line";
    include( "print_func_args.php" );
  }

  $i_enc = mb_internal_encoding();
  $d_enc = mb_detect_encoding($rmk);
  if (! empty($d_enc) ) {
    $rmk = mb_convert_encoding($rmk, $i_enc, $d_enc);
  }

  $browser=$_SERVER['HTTP_USER_AGENT'];
  $cliaddr=$_SERVER['REMOTE_ADDR'];
  $clihost=gethostbyaddr($cliaddr);   
  $curdate=date("D M j G:i:s T Y");

  $d_enc = mb_detect_encoding($curdate);
  if (! empty($d_enc) ) {
    $curdate = mb_convert_encoding($curdate, $i_enc, $d_enc);
  }


  // The remarks file extention to be ".txt".
  $pieces = explode(".", $img);
  $file = "$pieces[0].txt";

  // Check writable and write remarks.
  $filename = ChkWritable($dir, $file, __LINE__);
  if ( empty($filename) ) {
    return 0;
  } else {
    if (! file_exists($filename) || filesize($filename) == 0 || $edit != "a") {
      $fd = fopen ($filename, "w");
      $edit = "o";
    } else {
      $fd = fopen ($filename, "r+");
    }
    if ($fd) {
      if ( $edit == "a" ) {
	fseek( $fd, 0, SEEK_END );
	$ret = fwrite($fd, "\n--\t--\n");
	if ($ret == -1 ) {
	  Error("write into the file: $filename.", $line);
	  return 0;
	}
      }
      $ret = fwrite($fd, "\t__ $curdate __\t\n");
      $ret = fwrite($fd, $rmk);
      $ret = fwrite($fd, "\n\t__ $browser @ $clihost __\t");
    } else {
      Error("$filename could not be opened to write.", $line);
      return 0;
    }
    fclose ($fd);
  }
  return $ret;
}

////////////////////////////////////////////////////////////////////////
// Image re-creation with some infomational texts.
//	$new_w: output image width in pixels.
//	$new_h: output image height in pixels.
//	$pic_frm: picture frame size(-1: no frame)
//	$frm_lbl: frame label size(-1: no no label)
//	$img_file: image file name.
//	$new_dir: directory for output image.
//	$org_dir: directory for output image.
//	$remark: remarkable information text to be added.
//	$rotangle: rotation angle.
//	$smooth: smoothing(sampling) when resize
//	$img_fmt: output image format(gif|jpeg|png|wbmp)
//	$img_qty: output image quolity(%) for jpeg
////////////////////////////////////////////////////////////////////////
function ReCreatImg( $new_w, $new_h, $pic_frm, $frm_lbl, $img_file, $new_dir=".", $org_dir=".", $remark="", $rotangle=0, $smooth=true, $img_fmt="jpeg", $img_qty=81 )
{
  Debug("ReCreatImg( $new_w, $new_h, $pic_frm, $frm_lbl, $img_file, $new_dir, $org_dir, $remark, $rotangle, $smooth, $img_fmt, $img_qty)", 1);

  //$i_enc = 'UTF-8'; //mb_internal_encoding();
  //$d_enc = mb_detect_encoding($remark);
  //$remark = mb_convert_encoding($remark, $i_enc, $d_enc);

  // Check the source image file and get information
  $filename = ChkReadable("$org_dir", "$img_file", __LINE__);
  if ( ! GetImgType($filename) ) {
    Error("Invalid image file:  $org_dir/$img_file");
    return 0;
  }
  $imagepixels = GetImgPixels($filename);
  if ( empty($imagepixels) ) {
    Error("Original image file couldnot be read:  $org_dir/$img_file");
    return 0;
  }
  $filesize = filesize("$org_dir/$img_file");
  $modtime =  GetImgModTime( "$org_dir/$img_file" );
  //echo "filename:imagepixels=$filename:$imagepixels <br>";
  //echo "filesize/modtime=$filesize/$modtime <br>";

  // read or create an original image
  if ( $filesize > 0 ) {
    // Read original image and set valiables for resize
    $org_img = CreatImgFrom("$org_dir/$img_file");
    $org_w = ImageSX($org_img);
    $org_h = ImageSY($org_img);
  } else {
    // dummy image generation
    $org_img = ImageCreateTrueColor($new_w, $new_h);
    $background_color = ImageColorAllocate($org_img, 0, 0, 0);
    $org_w = $new_w;
    $org_h = $new_h;
  }

  if ( $rotangle == 90 || $rotangle == 270 ) {
    $tmp_img = imagecreatetruecolor($org_h,$org_w);
    $distX = (double)($org_h/2.0);
    $distY = (double)($org_w/2.0);
    $tmp_img = ImageRotate($org_img, (float)$rotangle, 0);

    ImageDestroy($org_img);
    $org_img = $tmp_img;
    //ImageDestroy($tmp_img); DoNot destory at here!

    $tmp_w = $org_w;
    $tmp_h = $org_h;
    $org_w = $tmp_h;
    $org_h = $tmp_w;

    $tmp_w = $new_w;
    $tmp_h = $new_h;
    $new_w = $tmp_h;
    $new_h = $tmp_w;
  }

  // Set and calculate size informations for a new image
  if ( $new_w == 0 && $new_h == 0 ) {  // means generating in original size
    $font_id = 2;
    if( extension_loaded('gd') ){
      $fw=ImageFontWidth($font_id);
      $fh=ImageFontHeight($font_id);
    } else {
      $fw=8;
      $fh=10;
    }
    $base_w=$org_w;
    $base_h=$org_h;
    $new_x=$fh;
    $new_y=$fh;
    $new_file_path="$new_dir/org.$img_file";
  } else {
    $font_id = 1;
    if( extension_loaded('gd') ){
      $fw=ImageFontWidth($font_id);
      $fh=ImageFontHeight($font_id);
    } else {
      $fw = 5;
      $fh = 6;
    }
    // re-calc. new_? variables
    if ( $pic_frm == -1 ) {
      $base_w=$new_w;
      $base_h=$new_h;
    } else {
      $base_w=$new_w+$fh*2;
      $base_h=$new_h+$fh*2;
    }
    $fact = Min($new_w/$org_w, $new_h/$org_h);
    $new_w = $org_w*$fact;
    $new_h = $org_h*$fact;
    $new_x = ($base_w - $new_w)/2;
    $new_y = ($base_h - $new_h)/2;
    $new_file_path="$new_dir/$img_file";
  }

  // Check the directory and the file for a new image.
  $filename = ChkWritable("$new_dir", "$img_file", __LINE__);
  if ( empty($filename) ) {
    Error("New image file wouldnot be created:  $new_dir/$img_file");
    return 0;
  }

  if ( $new_w == 0 && $new_h == 0 ) {  // means generating original size
    $new_img = $org_img;
  } else {
    // Create new image canvas
    $new_img = ImageCreateTrueColor($base_w, $base_h);
    // set bgcolor
    $bg_color = ImageColorAllocate($new_img, 255, 255, 255);
    // Format a new image base canvas and write informations on it.
    ImageFill($new_img, 0, 0, $bg_color);

    // Resize and copy the original image.
    if ( $pic_frm == -1 ) {
      if ( $smooth ) {
	ImageCopyResampled($new_img, $org_img, 0, 0, 0, 0, $base_w, $base_h, $org_w, $org_h);
      } else {
	ImageCopyResized($new_img, $org_img, 0, 0, 0, 0, $base_w, $base_h, $org_w, $org_h);
      }
    } else {
      if ( $smooth ) {
	ImageCopyResampled($new_img, $org_img, $new_x, $new_y, 0, 0, $new_w, $new_h, $org_w, $org_h);
      } else {
	ImageCopyResized($new_img, $org_img, $new_x, $new_y, 0, 0, $new_w, $new_h, $org_w, $org_h);
      }
    }
    ImageDestroy($org_img);
  }

  //
  // write strings to the image
  //
  // set string colors
  $text_color = ImageColorAllocate($new_img, 233, 14, 91);
  //$text_color2 = ImageColorAllocate($new_img, 14, 233, 91);

  if ($frm_lbl > -1) {
    //  write file name at the top left
    $y = strlen($img_file) * $fw;
    ImageStringUp($new_img, $font_id, 0, $y,  $img_file, $text_color);

    //  write original modification date at the top right
    $x = $base_w - (strlen($modtime) * $fw);
    ImageString($new_img, $font_id, $x, 0,  $modtime, $text_color);

    //  write original file size and pixels at the bottom
    $y = $base_h - $fh;
    ImageString($new_img, $font_id, 0, $y,  "($imagepixels, $filesize)", $text_color);
  }

  //  write remark. 
  $x = $base_w - ($new_x*1.5);
  $y = $base_h - ($new_y*1.5);
  $font_kj = $font_id + 1;
  ImageKanjiUp($new_img, $font_kj, $x, $y,  $remark, $text_color);

  // Write a new image into the file with specified format.
  SaveImgTo($new_img, $new_file_path, $img_fmt, $img_qty);
  chmod($new_file_path, myfilemode());
  // Remove new image stream
  ImageDestroy($new_img);

  return 1;
}

////////////////////////////////////////////////////////////////////////
// Resize Image for Icon
//	$new_w: output image width in pixels.
//	$new_h: output image height in pixels.
//	$img_file: image file name.
//	$new_dir: directory for output image.
//	$org_dir: directory for output image.
//	$smooth: smoothing when resize
//	$img_fmt: output image format(gif|jpeg|png|wbmp)
//	$img_qty: output image quolity(%) for jpeg
////////////////////////////////////////////////////////////////////////
function ResizeImg( $new_w, $new_h, $img_file, $new_dir = ".", $org_dir = ".", $smooth=false, $prefix='', $img_fmt = "jpeg", $img_qty=81 )
{
  Debug("ResizeImg( $new_w, $new_h, $img_file, $new_dir, $org_dir, $img_fmt, $img_qty)", 1);

  // Check Source Image.
  $filename = ChkReadable($org_dir, $img_file, __LINE__);
  if ( ! GetImgType($filename) ) {
    Error("Invalid image file:  $org_dir/$img_file");
    return 0;
  }

  if ( $img_fmt == 'gif' ) {
    $ext = '.gif';
  } elseif ( $img_fmt == 'jpeg' ) {
    $ext = '.jpg';
  } elseif ( $img_fmt == 'bmp' ) {
    $ext = '.bmp';
  } else {
    $ext = ".$img_fmt";
  }
  $new_file = $prefix.basename($img_file).$ext;
  // Check the directory and the file for a new image.
  $filename = ChkWritable($new_dir, $new_file, __LINE__);
  if ( empty($filename) ) {
    Error("New image file wouldnot be created:  $new_dir/$new_file");
    return 0;
  }

  // Get information from image file.
  $filesize = filesize("$org_dir/$img_file");
  if ( $filesize > 0 ) {
    // Read original image from file
    $org_img = CreatImgFrom("$org_dir/$img_file"); 
  } else {
    // Generate dummy image
    $org_img = ImageCreateTrueColor($new_w, $new_h);
    $background_color = ImageColorAllocate($org_img, 0, 0, 0);
  }
  $org_w = ImageSX($org_img); 
  $org_h = ImageSY($org_img); 

  // Create new image canvas
  $new_img = ImageCreateTrueColor($new_w, $new_h);
  // set bgcolor
  $bg_color = ImageColorAllocate($new_img, 255, 255, 255);
  // Format a new image base canvas and write informations on it.
  ImageFill($new_img, 0, 0, $bg_color);
  // Resize and copy the original image.
  if ( $smooth ) {
    ImageCopyResampled($new_img, $org_img, 0, 0, 0, 0, $new_w, $new_h, $org_w, $org_h);
  } else {
    ImageCopyResized($new_img, $org_img, 0, 0, 0, 0, $new_w, $new_h, $org_w, $org_h);
  }
  // Remove old image stream
  ImageDestroy($org_img);

  // Write a new image file in specified format.
  SaveImgTo($new_img, $filename, $img_fmt, $img_qty);
  chmod($filename, myfilemode());
  // Remove new image stream
  ImageDestroy($new_img);

  return 1;
}

////////////////////////////////////////////////////////////////////////
// Remove the working image files.
//	$org_dir: original image directory
//	$tn_dir: thumbnail image directory
//	$wk_dir: work image directory
//	$image: image file name
////////////////////////////////////////////////////////////////////////
function RmWorkImg ( $org_path, $tn_dir, $wk_dir, $filename )
{
  global $TEST;
  if ( $TEST > 3 ) {
    include( "print_func_args.php" );
  }

  remove_file("$org_path/$tn_dir/$filename");
  remove_file("$org_path/$wk_dir/$filename");
  $pieces = explode(".", $filename);
  $txtfile = "$pieces[0].txt";
  $favfile = "fav.$filename.png";
  $orgfile = "org.$filename";
  remove_file("$org_path/$tn_dir/$txtfile");
  remove_file("$org_path/$tn_dir/$favfile");
  remove_file("$org_path/$wk_dir/$orgfile");
  //echo " ... succeeded.";
  //echo "$org_path/$filename";
}

?>
