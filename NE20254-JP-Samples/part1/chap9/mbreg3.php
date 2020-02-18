<?php
 $str = "日本語abc";  // 対象文字列
 print mb_ereg_replace('([a-z])','ord("\1")',$str,'e'); // 出力:日本979899
?>
