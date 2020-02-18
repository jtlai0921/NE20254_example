<?php
//   Mode Proccess Functions for Image List Creation
//
// Jun Kuwamura <juk@yokohama.email.ne.jp>
//	Mon Jan 22 01:22:57 JST 2001
//
// 2003-12-08 JuK Add frame label parameter to ReCreatImg
// 2003-12-07 JuK Add ImageResample option for smoothing resize.
// 2003-11-24 JuK Add call RmWorkImg in CreatThumbNails.
// 2003-11-24 JuK Add frame size parameter to ReCreatImg
// 2003-11-23 JuK Add folder name specification.
// 2003-08-28 JuK Mod remove timestamp for edit when overwrite mode
// 2003-07-27 JuK Add icon creation(ResizeImg)
// 2003-07-21 JuK Add no buffering to create images.
// 2003-07-20 JuK Distinguish web uri from directory path.
// 2002-09-16 JuK Use file list instead of directory info. in while loop.
// 2002-07-04 JuK Add original sized image viewer.
// 2002-07-04 JuK Add edit mode for remarks(append or overwrite)
// 2002-02-17 JuK devide process functions to here.
//
require_once("imagetool.php");
require_once("fileutil.php");

////////////////////////////////////////////////////////////////////////
// Create thumbnail images from the original files
//	$org_dir: original image directory
//	$tn_dir: thumbnail image output directory
//	$br_dir: browsable image output directory
//	$br_uri: browsable image web uri
//	$lis:	image files list
//	$tn_w: width of thumbnail
//	$tn_h: height of thumbnail
//	$br_w: width of browsable image
//	$br_h: height of browsable image
//	$image: first image file name to be processed
//	$url: url for reference next mode
//	$pic_frm: picture frame size(-1: no frame)
//	$smooth: smoothing when resize(true or false)
////////////////////////////////////////////////////////////////////////
function CreatThumbNails( $org_dir, $tn_dir, $tn_uri, $br_dir, $br_uri, $lis, $tn_w, $tn_h, $br_w, $br_h, $image, $url, $pic_frm=0, $frm_lbl=0, $smooth, $img_fmt="jpeg", $img_qty=81 )
{
  global $TEST, $foldername;
  if ( $TEST > 3 ) {
    include( "print_func_args.php" );
  }

  //
  // Process for each images in the list.
  //
  // Pass through until the specified image
  if ( ! empty($image) ) {
  // pass through untill the specified file appeared.
    while (list ($key, $entry) = each ($lis)) {
      if ( $entry == $image ) {
  	break;
      }
    }
    // remove the 1st image which specifiled
    RmWorkImg($org_dir, $tn_dir, $br_dir, $image);
  }

  // stop output bufferling and flush buffer.
  ob_end_flush ();
  // Create thumbnail and browsable images
  do {
    $remark = RdImgRemark($tn_dir, $entry, __LINE__);
    if ( ! empty($remark) ) {
      $remark = ereg_replace ( "--\t--\n", "/", $remark );
      $remark = ereg_replace ( "\t__ .* __\t\n", "/", $remark );
      $remark = ereg_replace ( "\t__ .* __\t", "/", $remark );
    }
    //echo "remark: $remark<br>";

    $rotangle = 0;
    if (! file_exists("$tn_dir/$entry") ) {
      // create thumbnail
      if ( ReCreatImg( $tn_w, $tn_h, $pic_frm, $frm_lbl, $entry, $tn_dir, $org_dir, $remark, $rotangle, $smooth, $img_fmt, $img_qty) ) {
        // create browsable file for present
        if (! ReCreatImg( $br_w, $br_h, $pic_frm, $frm_lbl, $entry, $br_dir, $org_dir, $remark, $rotangle, $smooth, $img_fmt, $img_qty) ) {
            Error("CreatThumbNails: creating browsable size image.", __LINE__);
	    exit;
        }
	echo "<a href=\"$url?folder=$foldername&mode=create&image=$entry\">continue from $entry</a><br>\n";
	echo "<A href=$br_uri/$entry?folder=$foldername><br>\n"; 
	echo "$entry<br>\n";
	echo "<img src=$tn_uri/$entry><br>\n"; 
	echo "</A><br>\n"; 
      } else {
        Error("CreatThumbNails: creating browsable size image.", __LINE__);
	exit;
      }
    }
    // create icon image
    $prefix='fav.';
    if (! file_exists("$tn_dir/$prefix".basename($entry).'.png') ) {
      if (! ResizeImg( 24, 20, $entry, $tn_dir, $org_dir, $smooth, $prefix, 'png') ) {
        Error("CreatThumbNails: creating favicon size image.", __LINE__);
	exit;
      }
    }
    // flush current buffer.
    flush();
  } while (list ($key, $entry) = each ($lis));
  echo "<br />\n";
  echo "<a href=$url?folder=$foldername><br>\n";
  echo "$url?folder=$foldername\n";
  echo "</a>\n";
}

////////////////////////////////////////////////////////////////////////
// List image file names and informations in the original directory.
//	$org_dir: original image directory
//	$lis:	image files list
//	$url: url for reference next mode
////////////////////////////////////////////////////////////////////////
function ListImgDir( $org_dir, $lis, $url )
{
  global $TEST, $foldername;
  if ( $TEST > 3 ) {
    include( "print_func_args.php" );
  }

  // List for each image
  while (list ($key, $entry) = each ($lis)) {
    if ( is_dir("$org_dir/$entry") ) {
      echo $entry."/<br>\n";
    } else {
      if ( GetImgType("$org_dir/$entry") ) {
	$filesize = filesize("$org_dir/$entry");
	$modtime = strftime("%Y-%m-%d %H:%M", filemtime("$org_dir/$entry"));
	echo "<a href=\"$url?folder=$foldername&mode=show&image=$entry\">$entry"." $modtime ($filesize)"."</a><br>\n";
      } else {
	echo $entry."<br>\n";
      }
    }
  }
}

////////////////////////////////////////////////////////////////////////
// Edit the remarks file of the image.
//	$org_dir: original image directory
//	$org_uri: original image web uri
//	$tn_dir: thumbnail image directory
//	$tn_uri: thumbnail image web uri
//	$image: image file name
//	$url: url for reference next mode
//	$edit: o: overwrite, a: appand
////////////////////////////////////////////////////////////////////////
function EditImgRemarks( $org_dir, $org_uri, $tn_dir, $tn_uri, $image, $url, $edit="a" )
{
  global $TEST, $foldername;
  if ( $TEST > 3 ) {
    include( "print_func_args.php" );
  }
  $remark = '';

  // Edit label strings for the image.
  if ( empty($image) ) {
    Error("image=<> must be specified for edit!", __LINE__);
  }
  if ( $TEST ) {
    echo "<A href=$org_uri/$image?folder=$foldername><br>\n"; 
    echo "Original Image of $image";
  }
  echo "<br>\n";
  echo "<FORM METHOD=GET ACTION=\"$url\">\n"; 
  echo "<INPUT TYPE=\"hidden\" NAME=\"folder\" VALUE=\"$foldername\">\n";
  echo "<INPUT TYPE=\"hidden\" NAME=\"mode\" VALUE=\"show\">\n";
  echo "<INPUT TYPE=\"hidden\" NAME=\"image\" VALUE=\"$image\">\n";
  echo "<img src=$tn_uri/$image>\n";
  echo "<INPUT TYPE=\"submit\" VALUE=\"¥Æì½¡¬\">\n";
  echo "</FORM>\n";
  if ( $TEST ) {
    echo "</A>"; 
  }
  echo "<br>\n"; 
  echo "<FORM METHOD=GET ACTION=\"$url\">\n"; 
  echo "<INPUT TYPE=\"hidden\" NAME=\"mode\" VALUE=\"save\">\n";
  echo "<INPUT TYPE=\"hidden\" NAME=\"folder\" VALUE=\"$foldername\">\n";
  echo "Edit comment for this picture:<br>\n"; 
  echo "<TEXTAREA NAME=\"remark\"  COLS=52 ROWS=8>";
  if ( $edit == "o" ) {
    $remark = RdImgRemark($tn_dir, $image, __LINE__);
    if ( ! empty($remark) ) {
      $remark = ereg_replace ( "--\t--\n", "", $remark );
      $remark = ereg_replace ( "\t__ .* __\t\n", "", $remark );
      $remark = ereg_replace ( "\t__ .* __\t", "", $remark );
      echo $remark;
    }
  }
  echo "</TEXTAREA>\n";
  echo "<INPUT TYPE=\"hidden\" NAME=\"image\" VALUE=\"$image\">\n";
  echo "<INPUT TYPE=\"submit\" VALUE=\"¥Ï¥ó¥Ä¥¯\">\n";
  echo "<br>¥¤€€¥»:\n";
  echo "<INPUT TYPE=\"radio\" NAME=\"rotate\" VALUE=\"\">¡¢¥¹¡¢¥Û¡¢¡«¡¢¡«\n";
  echo "<INPUT TYPE=\"radio\" NAME=\"rotate\" VALUE=\"left\">¥³¥¯¡¢¥ê90¡£õ½n";
  echo "<INPUT TYPE=\"radio\" NAME=\"rotate\" VALUE=\"right\">¥¢¥ò¡¢¥ê90¡£õ½n";
  echo "</FORM>\n"; 

  return $remark;
}

////////////////////////////////////////////////////////////////////////
// Save the remarks file of the image and re-create thumb nail.
//	$org_dir: original image directory
//	$org_uri: original image web uri
//	$tn_dir: thumbnail image directory
//	$tn_uri: thumbnail image web uri
//	$br_dir: browsable image output directory
//	$br_w: width of browsable image
//	$br_h: height of browsable image
//	$image: first image file name to be processed
//	$remark: remarks to be saved for the image
//	$url: url for reference next mode
//	$edit: o: overwrite, a: append
//	$pic_frm: picture frame size(-1: no frame)
////////////////////////////////////////////////////////////////////////
function SaveImgRemarks( $org_dir, $org_uri, $tn_dir, $tn_uri, $br_dir, $br_w, $br_h, $image, $remark, $rotate, $url, $edit="a", $pic_frm=-1, $frm_lbl=0 )
{
  global $TEST, $foldername;
  if ( $TEST > 3 ) {
    include( "print_func_args.php" );
  }
  if ( $TEST ) {
    echo "<A href=$org_uri/$image?folder=$foldername><br>\n"; 
    echo "$image<br>\n";
    echo "<img src=$tn_uri/$image><br>\n"; 
    echo "</A><br>\n"; 
    echo "<a href=\"$url?folder=$foldername&mode=edit&image=$image\">$remark</a><br>\n";
  }

  // Save remarks for image
  if ( empty($image) ) {
    Error("image=<> must be specified for save!", __LINE__);
  }
  WtImgRemark( $tn_dir, $image, $remark, __LINE__, $edit );

  // image rotation
  $rotangle = 0;
  if (! empty($rotate) ) {
	  if ( $rotate == "left" ) {
		  $rotangle = 90;
	  } elseif ( $rotate == "right" ) {
		  $rotangle = 270;
	  }
  }
  //// Re-create a browsable image with remarks
  //if ( $rotangle == 90 || $rotangle == 270 ) {
    if (! ReCreatImg( $br_w, $br_h, $pic_frm, $frm_lbl, $image, $br_dir, $org_dir, $remark, $rotangle, "jpeg" ) ) {
      Error("creating browsable size image.", __LINE__);
    }
  //}
  if (! ReCreatImg( 0, 0, $pic_frm, $frm_lbl, $image, $br_dir, $org_dir, $remark, $rotangle, "jpeg" ) ) {
    Error("creating original size image.", __LINE__);
  }
}

////////////////////////////////////////////////////////////////////////
// Image file name should be specified after '\?' character at here.
//	$org_dir: original image directory
//	$tn_dir: thumbnail image directory
//	$br_dir: browsable image directory
//	$br_uri: browsable image web uri
//	$lis:	image files list
//	$image: image file name
//	$remark: remarks to be saved for the image
//	$url: url for reference next mode
//	$edit: o: overwrite, a: append
////////////////////////////////////////////////////////////////////////
function ShowImgUp( $org_dir, $tn_dir, $br_dir, $br_uri, $lis, $image, $remark, $url, $edit="a" )
{
  global $TEST, $foldername;
  if ( $TEST > 3 ) {
    include( "print_func_args.php" );
  }

  // Look for the previous and next images.
  $imgprev="";
  $imgnext="";
  while (list ($key, $curent) = each ($lis)) {
    Debug ("$curent =?= $image", 9);
    if ( $curent == $image ) {
      while (list ($key, $curent) = each ($lis)) {
	if ( GetImgType("$org_dir/$curent") ) {
	  $imgnext = $curent;
	  break;
	  break;
	}
      }
      break;
    }
    if ( GetImgType("$org_dir/$curent") ) {
      $imgprev = $curent;
    }
  }
  Debug ("$imgprev <=> $imgnext", 9);

  echo "<table borderwidth=\"0\"><tr><th colspan=3 align=left>\n";
  // Show the top navigator( "_-^-_" ).
  echo "<a href=\"$url?folder=$foldername\"><font size=\"big\">_.:^:._</font></a>\n";
  // Left Navigator
  if ( $imgprev != "" ) {
    // Show the left navigator ( "<=" ).
    echo "<a href=\"$url?folder=$foldername&mode=show&image=$imgprev\">&lt;=</a>";
  } else {
    // Show the left navigator ( "||" ).
    echo "||";
  }
  // Right Navigator
  if ( $imgnext != "" ) {
    // Show right navigator ( "=>" )
    echo "<a href=\"$url?folder=$foldername&mode=show&image=$imgnext\">=&gt;</a>";
  } else {
    // Show the right navigator ( "||" ).
    echo "||";
  }
  echo "</th></tr><th>\n";
  // Left Navigator
  if ( $imgprev != "" ) {
    // Show the left navigator ( "<=" ).
    echo "<a href=\"$url?folder=$foldername&mode=show&image=$imgprev\">&lt;=</a>";
  } else {
    // Show the left navigator ( "||" ).
    echo "||";
  }
  echo "</th><td>\n";
  if ( GetImgType("$org_dir/$image") ) {
    // Show specified image.
    //echo "<a href=\"$url?folder=$foldername&mode=show&image=$image\">$image</a><br>\n";
    echo "$image -- <font size=\"small\">" . GetImgModTime( "$org_dir/$image" ) . "</font><br>\n";
    echo "<A href=\"$url?folder=$foldername&mode=max&image=$image\"><img src=\"$br_uri/$image\"><br></A>\n"; 
    if ( $edit == "o" || $edit == "a" ) {
      if ( $edit == "o" ) {
        $label = "[EDIT COMMENT]";
      } else {
        $label = "[ADD COMMENT]";
      }
      echo "<br><a href=\"$url?folder=$foldername&mode=edit&image=$image\">$label</a><br><br>\n";
    }
  } else {
    Error("$image is not in reasonable image format.", __LINE__);
  }
  echo "</td><th>\n";
  // Right Navigator
  if ( $imgnext != "" ) {
    // Show right navigator ( "=>" )
    echo "<a href=\"$url?folder=$foldername&mode=show&image=$imgnext\">=&gt;</a>";
  } else {
    // Show the right navigator ( "||" ).
    echo "||";
  }
  echo "</th></tr></table>\n";

  if ( $edit != "n" ) {
    echo "<blockquote>\n";
    $label = RdImgRemark($tn_dir, $image, __LINE__);
    // simple converter
    $label = str_replace ( "--\t--", "<hr size=1>", $label);
    $label = str_replace ( "\t__", "<font size=2 color=gray>", $label);
    $label = str_replace ( "__\t", "</font>", $label);
    echo nl2br($label);
    echo "</blockquote>\n";
  }
}


////////////////////////////////////////////////////////////////////////
// Image file name should be specified after '\?' character at here.
//	$org_dir: original image directory
//	$tn_dir: thumbnail image directory
//	$br_dir: browsable image directory
//	$br_uri: browsable image web uri
//	$image: image file name
//	$remark: remarks to be saved for the image
//	$url: url for reference next mode
////////////////////////////////////////////////////////////////////////
function ShowImgMax( $org_dir, $tn_dir, $br_dir, $br_uri, $image, $remark, $url )
{
  global $TEST, $foldername;
  if ( $TEST > 3 ) {
    include( "print_func_args.php" );
  }

  echo "<table borderwidth=\"0\"><tr><th align=center>\n";
  // Show the top navigator( "_-^-_" ).
  echo "<a href=\"$url?folder=$foldername&mode=show&image=$image\"><font size=\"big\">_.:^:._</font></a>\n";
  echo "</th></tr>\n";
  echo "<tr><td>\n";
  if ( GetImgType("$org_dir/$image") ) {
    if ( GetImgType("$br_dir/org.$image") ) {
      echo "<A href=\"$url?folder=$foldername&mode=show&image=$image\"><img src=\"$br_uri/org.$image\"><br></A>\n"; 
    } else {
      echo "<A href=\"$url?folder=$foldername&mode=show&image=$image\"><font color=\"red\">Warning: commenting required to see in original size.</font><br></A>\n"; 
    }
  } else {
    Error("$image is not in reasonable image format.", __LINE__);
    echo "<br>\n"; 
  }
  echo "</td></tr>\n";
  echo "</th></tr></table>\n";

  // Show JPEG EXIF information if possible
  if( extension_loaded('exif') ){
    $jpegfile = "$org_dir/$image";
    if ( GetImgType($jpegfile) == 2 ) {
      $tn_file = "$br_dir/tn_$image";
      include('print_exif_data.php');
    }
  }
}
?>
