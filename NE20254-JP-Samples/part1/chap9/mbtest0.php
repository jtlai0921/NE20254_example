<?php
 $str = "���ܸ�ʸ����";
 // ���ե�JIS�ǽ��� (ʸ�������ɤϼ�ư����)
 print mb_convert_encoding($str, "SJIS");
 // UTF-8�ǽ��� (ʸ�������ɸ��Ф�JIS,EUC-JP����Ƚ��)
 print mb_convert_encoding($str, "UTF-8", array("JIS", "EUC-JP"));
?>
