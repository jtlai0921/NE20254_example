<?php
$str = "���ܸ��english(������)";
if (preg_match_all("/[��-��]/u", $str, $regs)) {
  print $str = join($regs[0]); // ����: ������
}
?>
