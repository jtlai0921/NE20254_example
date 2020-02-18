<?php
 $str = "日本語abc";  // 対象文字列
 mb_regex_encoding('EUC-JP'); // 文字コードはEUC-JP
 mb_ereg_search_init($str); // 検索対象文字列設定
 $regs = mb_ereg_search_regs("日."); // 正規表現を指定してマッチ実行
 if (!empty($regs)) {
  print_r($regs); // 出力: array('日本')
 }
?>
