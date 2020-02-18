<?php
class MyCart {
  protected $item = array();
  public $name;
  // 建構子
  function __construct($name) {
    $this->name = $name;
    print "歡迎光臨! 歡迎來到{$name}\n";
  }
  // 追加物品到購物車
  function addItem($name, $num) {
    if(isset($this->item[$name])) {
      $this->item[$name] += $num;
    } else {
      $this->item[$name] = $num;
    }
  }
  // 顯示購物車中的物品
  function show() {
    foreach($this->item as $name=>$value) {
      print "$name:$value\n";
    }
  }
  // 解構子
  function __destruct() {
    print "謝謝!\n";
  }
}
?>
