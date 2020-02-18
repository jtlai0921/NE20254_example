<?php
 require_once('mobile.php');

 $str = "\xf8\x9f及切\xf8\xa0";  // 含有繪文字的字串
 echo imode_emoji2image($str, true);  // 把繪文字變換成圖示連結來表示
?>
