<?php
class MyShop {}
class MyFruitShop extends MyShop {}
class MyBookShop extends MyShop {}
class MyCarShop extends MyShop {}

class Calculate {
  function show($obj) {
    if ($obj instanceof MyFruitShop) {
      return "くだもの屋";
    } else if ($obj instanceof MyBookShop) {
      return "本屋";
    } else if ($obj instanceof MyShop) {
      return "お店";
    } else {
      return "不明";
    }
  }
}

// 各クラスのインスタンスを定義
$fruit = new MyFruitShop;
$book = new MyBookShop;
$car = new MyCarShop;

print Calculate::show($fruit)."\n"; // 出力: くだもの屋
print Calculate::show($book)."\n";  // 出力: 本屋
print Calculate::show($car)."\n";   // 出力: お店 
?>
