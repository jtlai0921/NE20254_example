<?php
 require_once('jcode_wrapper.php');
 $str="ÆüËÜ¸ì";
 print jcode_convert_encoding($str, "UTF-8", "EUC-JP"); // ¥HUTF-8¿é¥X
?>
