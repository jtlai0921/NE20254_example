<?php
 $str = "���ܸ�abc";  // �о�ʸ����
 mb_regex_encoding('EUC-JP'); // ʸ�������ɤ�EUC-JP
 mb_ereg_search_init($str); // �����о�ʸ��������
 $regs = mb_ereg_search_regs("��."); // ����ɽ������ꤷ�ƥޥå��¹�
 if (!empty($regs)) {
  print_r($regs); // ����: array('����')
 }
?>
