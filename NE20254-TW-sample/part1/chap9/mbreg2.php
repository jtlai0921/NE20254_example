<?php
 $str = "中文abc";  // 對象字串
 mb_regex_encoding('Big5'); // 字元碼是 Big5
 mb_ereg_search_init($str); // 設定檢索對象字串
 $regs = mb_ereg_search_regs("中."); // 指定檢索對象
 if (!empty($regs)) {
  print_r($regs); // 輸出: array('中文')
 }
?>
