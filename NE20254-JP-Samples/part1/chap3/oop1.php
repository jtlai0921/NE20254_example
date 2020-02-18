<?php
class MyShop {
  private $p = array();

  function __set($name, $value) { // プロパティを設定
    print "set::$name:$value\n";
    $this->p[$name] = $value;
  }

  function __get($name) { // プロパティを取得
    print "get::$name\n";
    return array_key_exists($name,$this->p) ? $this->p[$name] : null;
  }
}

$shop = new MyShop();
$shop->orange = 2;
$shop->banana = 3;
$shop->banana++; // banana = banana + 1
print "オレンジは".$shop->orange."個あります。\n";
print "バナナは".$shop->banana."個あります。\n";
?>
