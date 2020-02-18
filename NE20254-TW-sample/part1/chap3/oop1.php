<?php
class MyShop {
  private $p = array();

  function __set($name, $value) { // 設定屬性
    print "set::$name:$value\n";
    $this->p[$name] = $value;
  }

  function __get($name) { // 取得屬性
    print "get::$name\n";
    return array_key_exists($name,$this->p) ? $this->p[$name] : null;
  }
}

$shop = new MyShop();
$shop->orange = 2;
$shop->banana = 3;
$shop->banana++; // banana = banana + 1
print "柳丁有". $shop->orange. "個。\n";
print "香蕉有". $shop->banana. "個。\n";
?>
