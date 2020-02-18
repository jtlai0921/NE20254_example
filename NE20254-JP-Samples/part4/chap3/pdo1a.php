<?php
$dbh = new PDO('sqlite:/tmp/guestbook.db','','');
foreach ($dbh->query("SELECT * FROM guestbook") as $row) {
  echo "name={$row['name']} comment={$row['comment']}\n";
}
?>
