<html>
 <body>
  <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
   名前:<input type="text" name="name">
   コメント:<input type="text" name="comment">
   <input type="submit">
  </form>
  <hr />
<?php
 $con = sqlite_open('/tmp/guest.db',0666,$errmsg) or die($errmsg);
 if (!empty($_REQUEST['name'])){
   $sSQL = sprintf("INSERT INTO guestbook VALUES('%s','%s')",
		   sqlite_escape_string($_REQUEST['name']),
		   sqlite_escape_string($_REQUEST['comment']));
   sqlite_query($con, $sSQL);
 }
 $result = sqlite_query($con, 'SELECT * FROM guestbook');
 while($d = sqlite_fetch_array($result)){
  print "{$d['name']}:{$d['comment']}<br />";
 }
?>
</body></html>
