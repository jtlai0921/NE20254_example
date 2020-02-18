<?php
 $str = "日本語abc";  // 対象文字列
 mb_regex_encoding('EUC-JP'); // 文字コードはEUC-JP
 if (mb_ereg("日.",$str,$regs)) { // 正規表現マッチ
   print_r($regs); // 出力: array('日本')
 }
?>
