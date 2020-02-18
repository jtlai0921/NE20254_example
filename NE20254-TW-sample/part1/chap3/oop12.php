<?php
class MyBookShop {
  protected $dbh;
  function __construct($dbh) {
    $this->dbh = $dbh;
  }
  function query($sql) {
    $stmt = $this->dbh->prepare($sql);
    if($stmt->execute()) {
      return $stmt->fetchAll();
    }
  }
}

$dbh = new PDO("sqlite:/tmp/test.db");
$shop = new MyBookShop($dbh);
print_r($shop->query("SELECT * FROM books"));
?>
