<?php
class MyShop {}
class MyFruitShop extends MyShop {}
class MyBookShop extends MyShop {}
class MyCarShop extends MyShop {}

class Calculate {
  function show($obj) {
    if ($obj instanceof MyFruitShop) {
      return "���G��";
    } else if ($obj instanceof MyBookShop) {
      return "�ѩ�";
    } else if ($obj instanceof MyShop) {
      return "�ө�";
    } else {
      return "����";
    }
  }
}

// �w�q�U���O������
$fruit = new MyFruitShop;
$book = new MyBookShop;
$car = new MyCarShop;

print Calculate::show($fruit)."\n"; // ��X: ���G��
print Calculate::show($book)."\n";  // ��X: �ѩ�
print Calculate::show($car)."\n";   // ��X: �ө� 
?>
