<?php
$str = "���ܸ�abc";
$enc = "SJIS";
print iconv_strlen($str,$enc); // ����: 6
print iconv_substr($str,1,2,$enc); // ����: �ܸ�
print iconv_strpos($str,"��",0,$enc); // ����: 2
?>
