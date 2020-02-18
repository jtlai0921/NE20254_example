<?php
class MyBookShop {
  protected $dbh;
  function __construct($dsn) {
    $this->dbh = new PDO($dsn);
  }
  function query($sql) {
    $stmt = $this->dbh->prepare($sql);
    if($stmt->execute()) {
      return $stmt->fetchAll();
    }
  }
}

$shop = new MyBookShop("sqlite:/tmp/test.db");
print_r($shop->query("SELECT * FROM books"));
?>
