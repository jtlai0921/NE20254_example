<?php
 $str = "����abc";  // ��H�r��
 print mb_ereg_replace('([a-z])','ord("\1")',$str,'e'); // ��X: ����979899
?>
