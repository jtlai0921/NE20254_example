<?php
class MyShop {
  private $p = array();

  function __set($name, $value) { // �]�w�ݩ�
    print "set::$name:$value\n";
    $this->p[$name] = $value;
  }

  function __get($name) { // ���o�ݩ�
    print "get::$name\n";
    return array_key_exists($name,$this->p) ? $this->p[$name] : null;
  }
}

$shop = new MyShop();
$shop->orange = 2;
$shop->banana = 3;
$shop->banana++; // banana = banana + 1
print "�h�B��". $shop->orange. "�ӡC\n";
print "������". $shop->banana. "�ӡC\n";
?>
