<?php
 $str = "中文abc";  // 對象字串
 print mb_ereg_replace('([a-z])','ord("\1")',$str,'e'); // 輸出: 中文979899
?>
