<?php
abstract class DB {
  protected $dbh;
  abstract function query($sql);
}

class DB_SQLite extends DB {
  function __construct($params) {
    $this->dbh = sqlite_open($params, 0666);
  }
  function query($sql) {
    $result = sqlite_query($this->dbh, $sql);
    return sqlite_fetch_array($result,SQLITE_ASSOC);
  }
}

class DB_PGSQL extends DB {
  function __construct($params) {
    $this->dbh = pg_connect($params);
  }
  function query($sql) {
    $result = pg_query($this->dbh, $sql);
    return pg_fetch_assoc($result);
  }
}

class DBFactory {
  protected function __construct() {}
  static function create($dsn) {
    list($db, $params) = split(":",$dsn, 2);
    switch ($db) {
    case "sqlite" : return new DB_SQLite($params);
    case "pgsql"  : return new DB_PGSQL($params);
    }
  }  
}

$dbs = array("sqlite"=>"sqlite:/tmp/test2.db",
             "pgsql"=>"pgsql:dbname=test");

foreach ($dbs as $dbname => $dsn) {
  $db = DBFactory::create($dsn);
  $result = $db->query("SELECT author FROM books WHERE name like '%PHP4%'");
  print $dbname."::".$result['author']."\n";
}
?>
