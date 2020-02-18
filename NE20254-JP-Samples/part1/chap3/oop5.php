<?php
class MyShop {
  private $name;
  static $items = 0; // 総商品数
  function __construct($name) {
    $this->name = $name;
  }
  function add($num) { // 商品数を追加するメソッド
    self::$items += $num;
    print "{$this->name}に商品を{$num}個追加しました。\n";
  }
}

$shop1 = new MyShop("本屋"); // 本屋オブジェクトを生成
$shop2 = new MyShop("果物屋"); // 果物屋オブジェクトを生成
$shop1->add(3); // 本屋に商品を3つ追加
$shop2->add(2); // 果物屋に商品を2つ追加
print "総商品数:".MyShop::$items."\n"; // 総商品数(5)を出力
?>
