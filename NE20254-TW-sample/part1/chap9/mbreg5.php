<?php
 $str = "��
 ��";  // ��H�r��
 mb_regex_encoding('Big5'); // �r���X�O Big5
 if (mb_ereg("��.+$",$str,$regs)) { // ���W��ܦ����
   print_r($regs);
 }
?>
