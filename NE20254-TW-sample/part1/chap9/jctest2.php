<?php
 require_once('jcode.php');
 include_once("./code_table.jis2ucs"); // JIS->Unicode�ഫ��
 $str="���ܸ�";
 print JcodeConvert($str, 0, 4); // �HUTF-8��X
?>
