<?php
class Counter {
  public $cnt = 1;
}

$a = new Counter();
$b = $a; // 複製物件
$b->cnt++; // 增加計數
print $a->cnt; // PHP5 輸出 "2"
?>
