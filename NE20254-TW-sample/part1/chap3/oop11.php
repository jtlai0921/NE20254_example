<?php
abstract class DB {
  protected $dbh;
  abstract function query($sql);
}

class DB_SQLite extends DB {
  function __construct($dsn) {
    $this->dbh = sqlite_open($dsn);
  }
  function query($sql) {
    $result = sqlite_query($this->dbh, $sql);
    return sqlite_fetch_all($result, SQLITE_ASSOC);
  }
}

class DB_PgSQL extends DB {
  function __construct($dsn) {
    $this->dbh = pg_connect($dsn);
  }
  function query($sql) {
    $result = pg_query($this->dbh, $sql);
    return pg_fetch_all($result);
  }
}

$db = new DB_SQLite("/tmp/test.db");
print_r($db->query("SELECT * FROM books"));

$db = new DB_PgSQL("dbname=test");
print_r($db->query("SELECT * FROM books"));
?>
