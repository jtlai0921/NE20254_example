<?php
class Counter {
  public $cnt;
  function __construct() {
    $this->cnt = rand(); // 初始物年的計數
  }
  function __clone() {
    $this->cnt = rand(); // 初始複製的物件的計數
  }
}

$a = new Counter();
$b = clone $a;
print "a 的計數:".$a->cnt."\n";
print "b 的計數:".$b->cnt."\n";
?>
