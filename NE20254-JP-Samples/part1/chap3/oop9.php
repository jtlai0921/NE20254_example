<?php
interface MyMail {
  function sendMail($to);
}

abstract class MyCart {
  abstract function show($name, $num);
}

class MyFruitCart extends MyCart implements MyMail {
  function show($name, $num) {
    print "$name �� $num ��\n";
  }
  function sendMail($to) {
    print "$to �˥᡼���������ޤ���\n";
    // �᡼������
  }
}

$fruit = new MyFruitCart();
$fruit->show("�ߤ���", 3);
$fruit->sendMail("foo@example.com");
?>
