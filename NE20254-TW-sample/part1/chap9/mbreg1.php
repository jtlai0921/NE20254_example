<?php
 $str = "中文abc";  // 對象字串
 mb_regex_encoding('Big5'); // 字元碼是 Big5
 if (mb_ereg("中.",$str,$regs)) { // 比對正規表示式
   print_r($regs); // 輸出: array('中文')
 }
?>
