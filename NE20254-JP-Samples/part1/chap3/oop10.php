<?php
class MyShop {}
class MyFruitShop extends MyShop {}
class MyBookShop extends MyShop {}
class MyCarShop extends MyShop {}

class Calculate {
  function show($obj) {
    if ($obj instanceof MyFruitShop) {
      return "������β�";
    } else if ($obj instanceof MyBookShop) {
      return "�ܲ�";
    } else if ($obj instanceof MyShop) {
      return "��Ź";
    } else {
      return "����";
    }
  }
}

// �ƥ��饹�Υ��󥹥��󥹤����
$fruit = new MyFruitShop;
$book = new MyBookShop;
$car = new MyCarShop;

print Calculate::show($fruit)."\n"; // ����: ������β�
print Calculate::show($book)."\n";  // ����: �ܲ�
print Calculate::show($car)."\n";   // ����: ��Ź 
?>
