<?php // HTTP輸出入處理函式 (jcode 版)
 require_once("jcode.php");
 // 常數的定義
 define("JC_AUTO",0);
 define("JC_EUCJP",1);
 define("JC_SJIS",2);
 define("JC_JIS",3);
 define("JC_UTF8",4);
 define("JC_UNKNOWN",5);
 
 define("METHOD_POST",1);
 define("METHOD_GET",2);
 define("METHOD_COOKIE",3);
 
 $int_enc = JC_EUCJP; // 內部字元碼
 $out_enc = JC_SJIS; // 輸出字元碼
 $input_enc = JC_AUTO; // 輸入字元碼
 
 $detected_enc = array(); // 儲存輸入字元碼的陣列
 $enc_str = array("US-ASCII","EUC-JP","SJIS","JIS","UTF-8","UNKNOWN");
?>

