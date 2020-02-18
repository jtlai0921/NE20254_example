<?php // HTTP入出力処理関数 (jcode 版)
 require_once("jcode.php");
 // 定数の定義
 define("JC_AUTO",0);
 define("JC_EUCJP",1);
 define("JC_SJIS",2);
 define("JC_JIS",3);
 define("JC_UTF8",4);
 define("JC_UNKNOWN",5);
 
 define("METHOD_POST",1);
 define("METHOD_GET",2);
 define("METHOD_COOKIE",3);
 
 $int_enc = JC_EUCJP; // 内部文字コード
 $out_enc = JC_SJIS; // 出力文字コード
 $input_enc = JC_AUTO; // 入力文字コード
 
 $detected_enc = array(); // 入力文字コード保持用配列
 $enc_str = array("US-ASCII","EUC-JP","SJIS","JIS","UTF-8","UNKNOWN");
?>

