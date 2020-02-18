<?php
require_once('mobile.php');

$str = "\xf8\x9fのち\xf8\xa0";  // 絵文字を含む文字列
echo imode_emoji_cut($str);  // 絵文字をカットして表示
?>
