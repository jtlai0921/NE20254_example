<?php
   header("Content-type: image/png");
   $f = $_GET['file'];
   if ( file_exists($f) ) {
      $im = imagecreatefrompng($f);
      imagepng($im);
      imagedestroy($im);
   }
?> 
