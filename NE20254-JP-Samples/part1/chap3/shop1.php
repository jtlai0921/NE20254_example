<?php
require_once('MyCart.php');

$obj = new MyCart("�ܲ�");
$obj->addItem("����",2);
$obj->addItem("����",1);
$obj->show();
?>
