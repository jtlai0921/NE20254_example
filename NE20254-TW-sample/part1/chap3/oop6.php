<?php
class MyShop {
  static function addItem($name,$num) {
    print "{$name} �l�[�F";
    self::add($num);
  }
  static function add($num) {
    print $num."���C\n";
  }
}

MyShop::addItem("PHP ��","2");
?>
