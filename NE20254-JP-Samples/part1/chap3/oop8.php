<?php
abstract class MyCart {
  abstract function show($name, $num);
}

class MyFruitCart extends MyCart {
  function show($name, $num) {
    print "$name ¤ò $num ¸Ä\n";
  }
}

class MyBookCart extends MyCart {
  function show($name, $num) {
    print "$name ¤ò $num ºý\n";
  }
}

$fruit = new MyFruitCart();
$fruit->show("¤ß¤«¤ó", 3);
$book = new MyBookCart();
$book->show("PHPÅ°Äì¹¶Î¬", 2);
?>
