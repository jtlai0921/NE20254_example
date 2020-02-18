<?php
 $str = "日
本語";  // 対象文字列
 mb_regex_encoding('EUC-JP'); // 文字コードはEUC-JP
 if (mb_ereg("日.+$",$str,$regs)) { // 正規表現マッチ
   print_r($regs);
 }
?>
