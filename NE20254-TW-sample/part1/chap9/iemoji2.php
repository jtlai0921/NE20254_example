<?php
 require_once('mobile.php');

 $str = "\xf8\x9f及切\xf8\xa0";  // 含有繪文字的字串
 echo imode_emoji2entity($str);  // 把繪文字變換成數值實體來表示
?>
