<?php
 require_once('jcode.php');
 include_once("./code_table.jis2ucs"); // JIS->Unicode変換テーブル
 $str="日本語";
 print JcodeConvert($str, 0, 4); // UTF-8で出力
?>
