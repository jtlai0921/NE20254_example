<?php // HTTP��X�J�B�z�禡 (jcode ��)
 require_once("jcode.php");
 // �`�ƪ��w�q
 define("JC_AUTO",0);
 define("JC_EUCJP",1);
 define("JC_SJIS",2);
 define("JC_JIS",3);
 define("JC_UTF8",4);
 define("JC_UNKNOWN",5);
 
 define("METHOD_POST",1);
 define("METHOD_GET",2);
 define("METHOD_COOKIE",3);
 
 $int_enc = JC_EUCJP; // �����r���X
 $out_enc = JC_SJIS; // ��X�r���X
 $input_enc = JC_AUTO; // ��J�r���X
 
 $detected_enc = array(); // �x�s��J�r���X���}�C
 $enc_str = array("US-ASCII","EUC-JP","SJIS","JIS","UTF-8","UNKNOWN");
?>

