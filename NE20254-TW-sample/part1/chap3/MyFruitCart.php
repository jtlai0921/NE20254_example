<?php
require_once('MyCart.php');
class MyFruitCart extends MyCart {
  private $place;
  // 建構子
  function __construct($name, $place) {
    $this->place = $place;
    parent::__construct($name); // 呼叫父類別的建構子
  }
  // 顯示購物車裡的物品
  function show() {
    print $this->name.$this->place."\n";
    foreach($this->item as $name=>$value) {
      print "$name $value 個\n";
    }
  }
}
?>
