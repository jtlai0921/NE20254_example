<?php
require_once('MyCart.php');

$obj = new MyCart("�ѩ�");
$obj->addItem("�p��",2);
$obj->addItem("���x",1);
$obj->show();
?>
