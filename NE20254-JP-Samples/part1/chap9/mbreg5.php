<?php
 $str = "��
�ܸ�";  // �о�ʸ����
 mb_regex_encoding('EUC-JP'); // ʸ�������ɤ�EUC-JP
 if (mb_ereg("��.+$",$str,$regs)) { // ����ɽ���ޥå�
   print_r($regs);
 }
?>
