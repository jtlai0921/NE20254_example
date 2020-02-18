<?php
///////////////////////////////////
// JPEG EXIF infomation print
// $jpegfile must be substituted.
//
// Created for imagelist.php.
//	2002-02-17 by Jun Kuwamura <juk@yokohama.email.ne.jp>
//
// 2005-02-08 JuK Mod print thumbnail.
// 2003-08-10 JuK Mod for sub-array values
// 2003-07-21 JuK Mod for THUMBNAIL and ComponentsConfiguration
// 2002-03-14 JuK Add checking for ListCam.
//
///////////////////////////////////
if ( empty($_GET['thumbnail']) ) {
  echo "<blockquote>\n";
  echo "<table border=\"1\" cellspacing=\"0\">\n";
  echo "<caption>EXIF informations in \"".basename($jpegfile)."\" file</caption>\n";
  // Print out information in text.
  $exif = read_exif_data($jpegfile);
echo "FileName=".$exif['FileName']."<br>";
echo "FileDateTime=".$exif['FileDateTime']."<br>";
  while(list($k,$v)=each($exif)) {
    echo "<tr>";
    echo "<td> $k </td>";
    echo "<td>";
    switch( trim($k) ) {
    case 'MakerNote':
    case 'Thumbnail':
      echo "<img src=\"print_exif_data.php?thumbnail=$jpegfile\">";
      break;
    case 'ComponentsConfiguration':
      echo '0x'.bin2hex($v);
      break;
    default:
      if ( is_array($v) ) {
	      echo "<table border=\"1\" cellpadding=\"0\"  cellspacing=\"0\" width=\"100%\">\n";
	      while(list($sk,$sv)=each($v)) {
		      echo "<tr>";
		      echo "<td> $sk </td>";
		      echo "<td>";
		      if ( is_array($sv) ) {
			      echo "<pre>";
			      var_dump($sv);
			      echo "</pre>\n";
		      } else {
			      echo "$sv";
		      }
	      }
	      echo "</table>\n";
      } else {
        echo "$v";
      }
      if ( $k == "Software" ) {
        $coder = substr(trim($v), 0, 7);
	// Checking for ListCam
        if  ( "$coder" == "LcLight" || "$coder" == "ListCam" ) {
          echo "<div align=\"right\"> <a href=\"http://www.clavis.ne.jp/~listcam/index.ssi\">
		   <img src=\"kansoku/lclogow.gif\" border=\"0\" target=\"new\"></a>
	       </div>\n";
        }
      }
    }
    echo "</td>\n";
    echo "</tr>\n";
  }
  echo "</table>\n";
  echo "</blockquote>\n";
} else {
  // Extract thumbnail if $_GET['thumbnail'] is specified.
  $f = $_GET['thumbnail'];
  $tnail = exif_thumbnail( $f, $width, $height, $type);
  ob_end_clean();
  header('Content-type: '.image_type_to_mime_type($type));
  echo $tnail;
  ob_start();
}
?>
