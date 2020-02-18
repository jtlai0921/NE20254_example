<?php
class Foo {
  function execQuery () {
    try {
      $dbh = new PDO('sqlite:/tmp/phpnews.db','','',
                     array(PDO_ATTR_ERRMODE=>PDO_ERRMODE_EXCEPTION));
      $sql = "SELECT * FROM news WHERE title LIKE '%{$keyword}%'";
      $stmt = $dbh->prepare($sql);
      $stmt->execute();
    } catch (PDOException $e) {
      echo $e->getMessage();
      exit(-1);
    }
    $result['time'] = time();
    $result['cnt'] = 0;
    while ($cols = $stmt->fetch(PDO_FETCH_ASSOC)) {
      $result[] = $cols['title'];
      $result['cnt']++;
    }
    return $result;
  }
}
  
$keyword = htmlentities($_GET['keyword']);
$key = crc32($_SERVER['PHP_SELF'].$keyword);
$result = eaccelerator_cache_result($key, "Foo::execQuery($keyword)", 60);
print $result['time']."<hr />";
for ($i=0;$i<$result['cnt'];$i++) {
  echo $result[$i]."<br />";
}
?>
