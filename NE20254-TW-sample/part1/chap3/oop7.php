<?php
class MyShop {
  private $dbh;
  const DSN = 'sqlite:/tmp/shop.db';

  function __construct() {
    $this->dbh = new PDO(self::DSN,'',''); // �Ѥ�k�����s��
  }
}

$obj = new MyShop();
echo MyShop::DSN."\n"; // �����O�~���s��
?>
