<?php
class Counter {
  public $cnt;
  function __construct() {
    $this->cnt = rand(); // ���֥������ȤΥ����󥿤�����
  }
  function __clone() {
    $this->cnt = rand(); // ���ԡ���Υ��֥������ȤΥ����󥿤�����
  }
}

$a = new Counter();
$b = clone $a;
print "a�Υ�����:".$a->cnt."\n";
print "b�Υ�����:".$b->cnt."\n";
?>
