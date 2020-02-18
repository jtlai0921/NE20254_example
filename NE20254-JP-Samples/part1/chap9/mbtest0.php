<?php
 $str = "日本語文字列";
 // シフトJISで出力 (文字コードは自動検出)
 print mb_convert_encoding($str, "SJIS");
 // UTF-8で出力 (文字コード検出はJIS,EUC-JPから判定)
 print mb_convert_encoding($str, "UTF-8", array("JIS", "EUC-JP"));
?>
