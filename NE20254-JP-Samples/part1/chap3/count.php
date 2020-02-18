<?php
class Counter {
  public $cnt = 1;
}

$a = new Counter();
$b = $a; // オブジェクトをコピー
$b->cnt++; // カウントアップ
print $a->cnt; // PHP5では「2」が出力される
?>