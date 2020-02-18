<?php
class MyShop {
  static function addItem($name,$num) {
    print "{$name}を";
    self::add($num);
  }
  static function add($num) {
    print $num."つ追加しました。\n";
  }
}

MyShop::addItem("PHP本","2");
?>
