<?php
$str = "日本語abc";
$enc = "SJIS";
print iconv_strlen($str,$enc); // 出力: 6
print iconv_substr($str,1,2,$enc); // 出力: 本語
print iconv_strpos($str,"語",0,$enc); // 出力: 2
?>
