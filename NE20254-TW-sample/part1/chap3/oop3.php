<?php
class Counter {
  public $cnt;
  function __construct() {
    $this->cnt = rand(); // ��l���~���p��
  }
  function __clone() {
    $this->cnt = rand(); // ��l�ƻs�����󪺭p��
  }
}

$a = new Counter();
$b = clone $a;
print "a ���p��:".$a->cnt."\n";
print "b ���p��:".$b->cnt."\n";
?>
