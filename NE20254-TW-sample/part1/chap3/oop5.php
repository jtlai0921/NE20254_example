<?php
class MyShop {
  private $name;
  static $items = 0; // �`�ӫ~��
  function __construct($name) {
    $this->name = $name;
  }
  function add($num) { // �l�[�ӫ~����k
    self::$items += $num;
    print "�b {$this->name} �l�[�F {$num} �Ӱӫ~�C\n";
  }
}

$shop1 = new MyShop("�ѩ�"); // ���ͮѩ�����
$shop2 = new MyShop("���G��"); // ���ͤ��G������
$shop1->add(3); // �b�ѩ��l�[3�Ӱӫ~
$shop2->add(2); // �b���G���l�[2�Ӱӫ~
print "�`�ӫ~��:".MyShop::$items."\n"; // �`�ӫ~�ƿ�X (5)
?>
