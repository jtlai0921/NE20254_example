<?php
try {
  $dbh = new PDO('sqlite:/tmp/guestbook.db','','');
  $dbh->setAttribute(PDO_ATTR_ERRMODE,PDO_ERRMODE_EXCEPTION);  
  foreach ($dbh->query("SELECT * FROM guestbook") as $row) {
    echo "name={$row['name']} comment={$row['comment']}\n";
  }
} catch (PDOException $e) {
  echo "PDO Exception::".$e->getMessage();
} catch (Exception $e) {
  echo $e->getMessage();
}
?>
