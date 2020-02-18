<?php
require_once('mobile.php');

$str = "\xf8\x9f及切\xf8\xa0";  // 含有繪文字的字串
echo imode_emoji_cut($str);  // 去除繪文字之後顯示
?>
