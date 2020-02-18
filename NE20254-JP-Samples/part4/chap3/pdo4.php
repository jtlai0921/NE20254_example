<?php
try {
  $dbh = new PDO('sqlite:/tmp/guestbook.db','',
                 array(PDO_ATTR_ERRMODE=>PDO_ERRMODE_EXCEPTION));
  $stmt = $dbh->prepare("SELECT * FROM guestbook");
  if ($stmt->execute()) {
    $stmt->bindColumn('name', $name);
    $stmt->bindColumn('comment', $comment);
    while ($stmt->fetch(PDO_FETCH_BOUND)) {
      echo "name=$name comment=$comment\n";
    }
  }
} catch (PDOException $e) {
  echo "PDO Exception::".$e->getMessage();
}
?>
