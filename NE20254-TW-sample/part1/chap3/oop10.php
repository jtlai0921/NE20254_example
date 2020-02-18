<?php
class MyShop {}
class MyFruitShop extends MyShop {}
class MyBookShop extends MyShop {}
class MyCarShop extends MyShop {}

class Calculate {
  function show($obj) {
    if ($obj instanceof MyFruitShop) {
      return "水果店";
    } else if ($obj instanceof MyBookShop) {
      return "書店";
    } else if ($obj instanceof MyShop) {
      return "商店";
    } else {
      return "不明";
    }
  }
}

// 定義各類別的介面
$fruit = new MyFruitShop;
$book = new MyBookShop;
$car = new MyCarShop;

print Calculate::show($fruit)."\n"; // 輸出: 水果店
print Calculate::show($book)."\n";  // 輸出: 書店
print Calculate::show($car)."\n";   // 輸出: 商店 
?>
