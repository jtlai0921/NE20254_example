<?php
 require_once('jcode.php');
 include_once("./code_table.jis2ucs"); // JIS->Unicode�Ѵ��ơ��֥�
 $str="���ܸ�";
 print JcodeConvert($str, 0, 4); // UTF-8�ǽ���
?>
