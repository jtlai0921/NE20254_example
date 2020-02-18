<?php
// 2005-10-05 JuK Add zoom option for ReCreatImg()
// 2005-10-04 JuK Add aspect option for ReCreatImg()
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
//	$zoom: zoom(-1: no zoom in/out, 0: no zoom in, 1: zoom in/out)
//	$aspect: fitting or trimming image(1: fit in to the canvas, 2: trim out from the canvas)
//	$img_fmt: output image format(gif|jpeg|png|wbmp)
//	$img_qty: output image quality(%) for jpeg
////////////////////////////////////////////////////////////////////////
function ReCreatImg( $new_w, $new_h, $pic_frm, $frm_lbl, $img_file, $new_dir=".", $org_dir=".", $remark="", $rotangle=0, $smooth=true, $zoom=0, $aspect = 1, $img_fmt="jpeg", $img_qty=81 )
{
  Debug("ReCreatImg( $new_w, $new_h, $pic_frm, $frm_lbl, $img_file, $new_dir, $org_dir, $remark, $rotangle, $smooth, $zoom, $aspect, $img_fmt, $img_qty)", 1);

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
  //echo "$org_w x $org_h <br>";

 if ( $rotangle == 90 || $rotangle == 270 ) { // rotate
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
  if ( $new_w == 0 && $new_h == 0 ) {  // means generating in original size canvas
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
    $off_x=$fh;
    $off_y=$fh;
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
    //$fact = Min($new_w/$org_w, $new_h/$org_h);
    //$new_w = $org_w*$fact;
    //$new_h = $org_h*$fact;
    $off_x = ($base_w - $new_w)/2;
    $off_y = ($base_h - $new_h)/2;
    $new_file_path="$new_dir/$img_file";
  }

  // determin portrait or landscale for new image against to old image aspect ratio.
  $r_x = (float)$new_w / (float)$org_w;
  $r_y = (float)$new_h / (float)$org_h;

  $org_x = $org_y = 0;
  switch ($zoom) {
    case -1: // no zoom in/out
      if ($r_x > 1.0) {
        $off_x += ($new_w - $org_w) / 2.;
        $new_w = $org_w;
      } else {
        $org_x = ($org_w - $new_w) / 2.;
        $org_w = $new_w;
      }
      if ($r_y > 1.0) {
        $off_y += ($new_h - $org_h) / 2.;
        $new_h = $org_h;
      } else {
        $org_y = ($org_h - $new_h) / 2.;
        $org_h = $new_h;
      }
      $r_x = $r_y = 1.0;
      break;
    case 0: // no zoom in(zoom out only)
      if ($r_x > 1.0 && $r_y > 1.0) {
        $r_x = $r_y = 1.0;
        $off_x += ($new_w - $org_w) / 2.;
        $new_w = $org_w;
        $off_y += ($new_h - $org_h) / 2.;
        $new_h = $org_h;
      }
      break;
    case 1: // zoom in/out
      $r_x = $r_y = Min($r_x, $r_y);
      $new_w = $org_w * $r_x;
      $new_h = $org_h * $r_y;
      $off_x = ($base_w - $new_w) / 2.;
      $off_y = ($base_h - $new_h) / 2.;
      break;
  }

  //echo "$org_w x $org_h => $new_w x $new_h - ($off_x x $off_y) <br> $r_x : $r_y <br>";

  if ( $r_x > $r_y ) {		// portrait
    //echo "[portrate]<br>";
    switch ($aspect) {
    case 1: // fitting
      //echo "  FIT<br>";
      $dst_w = (int)$org_w * $r_y;
      $dst_x = (int)($new_w - $dst_w) / 2.;
      $dst_h = (int)$new_h;
      $dst_y = 0;
      $src_w = $org_w;
      $src_x = 0;
      $src_h = $org_h;
      $src_y = (int)$org_y;
      break;
    case 2: // trimming
      //echo "  TRIM<br>";
      $src_h = (int)$new_h / $r_x;
      $src_y = (int)($org_h - $src_h) / 2.;
      $src_w = $org_w;
      $src_x = 0;
      $dst_w = (int)$new_w;
      $dst_x = 0;
      $dst_h = (int)$new_h;
      $dst_y = 0;
      break;
    }
  } elseif ( $r_x < $r_y ) {	// landscale
    //echo "[landscale]<br>";
    switch ($aspect) {
    case 1: // fitting
      //echo "  FIT<br>";
      $dst_h = (int)$org_h * $r_x;
      $dst_y = (int)($new_h - $dst_h) / 2.;
      $dst_w = (int)$new_w;
      $dst_x = 0;
      $src_h = $org_h;
      $src_y = 0;
      $src_w = $org_w;
      $src_x = 0;
      break;
    case 2: // trimming
      //echo "  TRIM<br>";
      $src_w = (int)$new_w / $r_y;
      $src_x = (int)($org_w - $src_w) / 2.;
      $src_h = $org_h;
      $src_y = 0;
      $dst_w = (int)$new_w;
      $dst_x = 0;
      $dst_h = (int)$new_h;
      $dst_y = 0;
      break;
    }
  } else { // change aspect
    //echo "[change aspect]<br>";
    $dst_x = 0;
    $dst_y = 0;
    $dst_w = (int)$new_w;
    $dst_h = (int)$new_h;
    $src_x = (int)$org_x;
    $src_y = (int)$org_y;
    $src_w = (int)$org_w;
    $src_h = (int)$org_h;
  }
  $dst_x += (int)$off_x;
  $dst_y += (int)$off_y;

  //echo "$src_w x $src_h => $dst_w x $dst_h - ($dst_x x $dst_y) <br>";


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

    Debug("ImageCopyRes(..., $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h)<br>", 1);
    // Resize and copy the original image.
    if ( $smooth ) {
      $ret = ImageCopyResampled($new_img, $org_img, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);
    } else {
      $ret = ImageCopyResized($new_img, $org_img, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);
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
    $x = $base_w - $fh;
    $y = $base_h;
    ImageStringUp($new_img, $font_id, $x, $y,  "($imagepixels, $filesize)", $text_color);
  }

  //  write remark. 
  $x = $fh*1.5;
  $y = $base_h - ($fh*1.5);
  $font_kj = $font_id + 1;
  ImageKanji($new_img, $font_kj, $x, $y,  $remark, $text_color);

  // Write a new image into the file with specified format.
  //echo "SaveImgTo($new_img, $new_file_path, $img_fmt, $img_qty)<br>";
  $ret = SaveImgTo($new_img, $new_file_path, $img_fmt, $img_qty);

  chmod($new_file_path, myfilemode());
  // Remove new image stream
  ImageDestroy($new_img);

  return 1;
}
?>
