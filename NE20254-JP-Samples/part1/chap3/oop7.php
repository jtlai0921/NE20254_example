<?php
class MyShop {
  private $dbh;
  const DSN = 'sqlite:/tmp/shop.db';

  function __construct() {
    $this->dbh = new PDO(self::DSN,'',''); // メソッド内からアクセス
  }
}

$obj = new MyShop();
echo MyShop::DSN."\n"; // クラス外からアクセス
?>
