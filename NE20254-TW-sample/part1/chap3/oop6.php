<?php
class MyShop {
  static function addItem($name,$num) {
    print "{$name} 追加了";
    self::add($num);
  }
  static function add($num) {
    print $num."本。\n";
  }
}

MyShop::addItem("PHP 書","2");
?>
