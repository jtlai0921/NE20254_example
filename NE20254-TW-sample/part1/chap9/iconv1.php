<?php
$str = "中文abc";
$enc = "Big5";
print iconv_strlen($str,$enc); // 輸出: 5
print iconv_substr($str,1,2,$enc); // 輸出: 文a
print iconv_strpos($str,"文",0,$enc); // 輸出: 1
?>
