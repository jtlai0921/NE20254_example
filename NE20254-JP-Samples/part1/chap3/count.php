<?php
class Counter {
  public $cnt = 1;
}

$a = new Counter();
$b = $a; // ���֥������Ȥ򥳥ԡ�
$b->cnt++; // ������ȥ��å�
print $a->cnt; // PHP5�Ǥϡ�2�פ����Ϥ����
?>