<?php
 $str = "���ܸ�abcʸ����";
 print mb_substr($str, 1, 3); // ����: �ܸ�a
 print mb_strcut($str, 1, 3); // ����: ��
?>
