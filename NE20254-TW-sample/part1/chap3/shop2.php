<?php
require_once('MyFruitCart.php');

$obj = new MyFruitCart("水果店","站前站");
$obj->addItem("橘子",1);
$obj->addItem("蘋果",3);
$obj->show();
?>
