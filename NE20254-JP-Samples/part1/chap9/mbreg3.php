<?php
 $str = "���ܸ�abc";  // �о�ʸ����
 print mb_ereg_replace('([a-z])','ord("\1")',$str,'e'); // ����:����979899
?>
