<?php
class MyShop {
  private $name;
  static $items = 0; // 總商品數
  function __construct($name) {
    $this->name = $name;
  }
  function add($num) { // 追加商品的方法
    self::$items += $num;
    print "在 {$this->name} 追加了 {$num} 個商品。\n";
  }
}

$shop1 = new MyShop("書店"); // 產生書店物件
$shop2 = new MyShop("水果店"); // 產生水果店物件
$shop1->add(3); // 在書店追加3個商品
$shop2->add(2); // 在水果店追加2個商品
print "總商品數:".MyShop::$items."\n"; // 總商品數輸出 (5)
?>
