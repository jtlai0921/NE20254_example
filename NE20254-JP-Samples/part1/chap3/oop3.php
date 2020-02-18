<?php
class Counter {
  public $cnt;
  function __construct() {
    $this->cnt = rand(); // オブジェクトのカウンタを初期化
  }
  function __clone() {
    $this->cnt = rand(); // コピー先のオブジェクトのカウンタを初期化
  }
}

$a = new Counter();
$b = clone $a;
print "aのカウンタ:".$a->cnt."\n";
print "bのカウンタ:".$b->cnt."\n";
?>
