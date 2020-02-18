<?php
abstract class MyCart {
  abstract function show($name, $num);
}

class MyFruitCart extends MyCart {
  function show($name, $num) {
    print "$name $num ��\n";
  }
}

class MyBookCart extends MyCart {
  function show($name, $num) {
    print "$name $num ��\n";
  }
}

$fruit = new MyFruitCart();
$fruit->show("��l", 3);
$book = new MyBookCart();
$book->show("PHP ������", 2);
?>
