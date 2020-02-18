<?php
class MyShop {
  private $dbh;
  const DSN = 'sqlite:/tmp/shop.db';

  function __construct() {
    $this->dbh = new PDO(self::DSN,'',''); // 由方法內部存取
  }
}

$obj = new MyShop();
echo MyShop::DSN."\n"; // 由類別外部存取
?>
