<?php
$str = "����abc";
$enc = "Big5";
print iconv_strlen($str,$enc); // ��X: 5
print iconv_substr($str,1,2,$enc); // ��X: ��a
print iconv_strpos($str,"��",0,$enc); // ��X: 1
?>
