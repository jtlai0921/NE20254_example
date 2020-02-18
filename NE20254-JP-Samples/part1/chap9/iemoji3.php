<?php
 require_once('mobile.php');

 $str = "\xf8\x9fのち\xf8\xa0";  // 絵文字を含む文字列
 echo imode_emoji2image($str, true);  // 絵文字をイメージリンクに変換して表示
?>
