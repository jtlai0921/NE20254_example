<?php
 require_once('jcode.php');
 include_once("./code_table.jis2ucs"); // JIS->Unicode轉換表
 $str="ゥ呿賄";
 print JcodeConvert($str, 0, 4); // 以UTF-8輸出
?>
