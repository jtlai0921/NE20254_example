<?php
class MyShop {
  private $p = array();

  function __set($name, $value) { // �ץ�ѥƥ�������
    print "set::$name:$value\n";
    $this->p[$name] = $value;
  }

  function __get($name) { // �ץ�ѥƥ������
    print "get::$name\n";
    return array_key_exists($name,$this->p) ? $this->p[$name] : null;
  }
}

$shop = new MyShop();
$shop->orange = 2;
$shop->banana = 3;
$shop->banana++; // banana = banana + 1
print "����󥸤�".$shop->orange."�Ĥ���ޤ���\n";
print "�Хʥʤ�".$shop->banana."�Ĥ���ޤ���\n";
?>
