<?php
 $str = "日本語abc文字列";
 print mb_substr($str, 1, 3); // 出力: 本語a
 print mb_strcut($str, 1, 3); // 出力: 日
?>
