<?php // HTTP�����Ͻ����ؿ� (jcode ��)
 require_once("jcode.php");
 // ��������
 define("JC_AUTO",0);
 define("JC_EUCJP",1);
 define("JC_SJIS",2);
 define("JC_JIS",3);
 define("JC_UTF8",4);
 define("JC_UNKNOWN",5);
 
 define("METHOD_POST",1);
 define("METHOD_GET",2);
 define("METHOD_COOKIE",3);
 
 $int_enc = JC_EUCJP; // ����ʸ��������
 $out_enc = JC_SJIS; // ����ʸ��������
 $input_enc = JC_AUTO; // ����ʸ��������
 
 $detected_enc = array(); // ����ʸ���������ݻ�������
 $enc_str = array("US-ASCII","EUC-JP","SJIS","JIS","UTF-8","UNKNOWN");
?>

