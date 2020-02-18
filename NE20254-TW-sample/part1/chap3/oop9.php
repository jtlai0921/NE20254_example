<?php
interface MyMail {
  function sendMail($to);
}

abstract class MyCart {
  abstract function show($name, $num);
}

class MyFruitCart extends MyCart implements MyMail {
  function show($name, $num) {
    print "$name $num ��\n";
  }
  function sendMail($to) {
    print "�o�H�� $to�C\n";
    // Mail �o�H
  }
}

$fruit = new MyFruitCart();
$fruit->show("��l", 3);
$fruit->sendMail("foo@example.com");
?>
