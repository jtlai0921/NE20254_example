<?php
class Counter {
  public $cnt = 1;
}

$a = new Counter();
$b = $a; // �ƻs����
$b->cnt++; // �W�[�p��
print $a->cnt; // PHP5 ��X "2"
?>
