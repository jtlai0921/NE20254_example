<?php
interface MyMail {
  function sendMail($to);
}

abstract class MyCart {
  abstract function show($name, $num);
}

class MyFruitCart extends MyCart implements MyMail {
  function show($name, $num) {
    print "$name $num 個\n";
  }
  function sendMail($to) {
    print "發信給 $to。\n";
    // Mail 發信
  }
}

$fruit = new MyFruitCart();
$fruit->show("橘子", 3);
$fruit->sendMail("foo@example.com");
?>
