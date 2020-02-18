<?php
class Counter {
  public $cnt;
  function __construct() {
    $this->cnt = rand(); // ﹍璸计
  }
  function __clone() {
    $this->cnt = rand(); // ﹍狡籹ン璸计
  }
}

$a = new Counter();
$b = clone $a;
print "a 璸计:".$a->cnt."\n";
print "b 璸计:".$b->cnt."\n";
?>
