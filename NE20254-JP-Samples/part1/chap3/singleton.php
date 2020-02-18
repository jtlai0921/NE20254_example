<?php
class CachedQuery {
  static protected $obj = null;
  static protected $books = array();
  const DSN='sqlite:/tmp/test.db';
  protected function __construct() {}

  static function getInstance() {
    if (!is_object(self::$obj)) {
      self::$obj = new CachedQuery();
    }
    return self::$obj;
  }

  function getAuthor($name) {
    if (isset($this->books[$name])) {
      return $this->books[$name];
    }
    $this->dbh = new PDO(self::DSN);
    $sql = "SELECT author FROM books WHERE name like '$name'";
    $stmt = $this->dbh->prepare($sql);
    if($stmt->execute()) {
      print "query executed.\n";
      $this->books[$name] = $stmt->fetch(PDO_FETCH_ASSOC);
      return  $this->books[$name];
    }
  }
}

for ($cnt=0;$cnt<5;$cnt++) {
  $db = CachedQuery::getInstance();
  $result = $db->getAuthor("%PHP5%");
  print $result['author']."\n";
}
?>
