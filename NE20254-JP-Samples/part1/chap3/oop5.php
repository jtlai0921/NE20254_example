<?php
class MyShop {
  private $name;
  static $items = 0; // ���ʿ�
  function __construct($name) {
    $this->name = $name;
  }
  function add($num) { // ���ʿ����ɲä���᥽�å�
    self::$items += $num;
    print "{$this->name}�˾��ʤ�{$num}���ɲä��ޤ�����\n";
  }
}

$shop1 = new MyShop("�ܲ�"); // �ܲ����֥������Ȥ�����
$shop2 = new MyShop("��ʪ��"); // ��ʪ�����֥������Ȥ�����
$shop1->add(3); // �ܲ��˾��ʤ�3���ɲ�
$shop2->add(2); // ��ʪ���˾��ʤ�2���ɲ�
print "���ʿ�:".MyShop::$items."\n"; // ���ʿ�(5)�����
?>
