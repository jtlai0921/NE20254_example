<?php
class MyShop {
  private $dbh;
  const DSN = 'sqlite:/tmp/shop.db';

  function __construct() {
    $this->dbh = new PDO(self::DSN,'',''); // �᥽�å��⤫�饢������
  }
}

$obj = new MyShop();
echo MyShop::DSN."\n"; // ���饹�����饢������
?>
