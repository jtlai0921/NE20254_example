<?php
try {
  $dbh = new PDO('sqlite:/tmp/guestbook.db','','');
  $version = $dbh->getAttribute(PDO_ATTR_SERVER_VERSION);
  print_r($version);
  $version = $dbh->getAttribute(PDO_ATTR_CLIENT_VERSION);
  print_r($version);
} catch (PDOException $e) {
  echo $e->getMessage();
}
?>
