<?php
 $str = "����abc";  // ��H�r��
 mb_regex_encoding('Big5'); // �r���X�O Big5
 if (mb_ereg("��.",$str,$regs)) { // ��勵�W��ܦ�
   print_r($regs); // ��X: array('����')
 }
?>
