<?php
 require_once('jcode_wrapper.php');
 $str="日本語";
 print jcode_convert_encoding($str, "UTF-8", "EUC-JP"); // UTF-8で出力
?>
