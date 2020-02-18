<?php
$dbh = new PDO('sqlite:/tmp/guestbook.db','','');
$stmt = $dbh->prepare("SELECT * FROM guestbook");
if ($dbh->errorCode() != PDO_ERR_NONE) {
  print_r($dbh->errorInfo());
}

$stmt->execute();

while ($row = $stmt->fetch()) {
  echo "name={$row['name']} comment={$row['comment']}\n";
}
?>
