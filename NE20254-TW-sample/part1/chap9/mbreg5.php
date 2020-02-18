<?php
 $str = "中
 文";  // 對象字串
 mb_regex_encoding('Big5'); // 字元碼是 Big5
 if (mb_ereg("中.+$",$str,$regs)) { // 正規表示式比對
   print_r($regs);
 }
?>
