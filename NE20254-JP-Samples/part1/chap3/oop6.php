<?php
class MyShop {
  static function addItem($name,$num) {
    print "{$name}��";
    self::add($num);
  }
  static function add($num) {
    print $num."���ɲä��ޤ�����\n";
  }
}

MyShop::addItem("PHP��","2");
?>
