<?php
 $str = "����abc";  // ��H�r��
 mb_regex_encoding('Big5'); // �r���X�O Big5
 mb_ereg_search_init($str); // �]�w�˯���H�r��
 $regs = mb_ereg_search_regs("��."); // ���w�˯���H
 if (!empty($regs)) {
  print_r($regs); // ��X: array('����')
 }
?>
