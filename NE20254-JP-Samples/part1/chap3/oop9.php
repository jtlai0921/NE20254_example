<?php
interface MyMail {
  function sendMail($to);
}

abstract class MyCart {
  abstract function show($name, $num);
}

class MyFruitCart extends MyCart implements MyMail {
  function show($name, $num) {
    print "$name を $num 個\n";
  }
  function sendMail($to) {
    print "$to にメール送信します。\n";
    // メール送信
  }
}

$fruit = new MyFruitCart();
$fruit->show("みかん", 3);
$fruit->sendMail("foo@example.com");
?>
