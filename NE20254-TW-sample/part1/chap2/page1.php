<html>
 <body>
  <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
   �m�W:<input type="text" name="name">
   �K�X:<input type="text" name="password">
   <input type="submit">
  </form>
  <hr />
<?php
 $con = sqlite_open('/tmp/passwd.db',0666,$errmsg) or die($errmsg);
 $sSQL = sprintf("SELECT name FROM auth WHERE name='%s' AND password='%s'",
		 $_POST['name'], $_POST['password']);
 $result = sqlite_query($con, $sSQL);
 if (sqlite_num_rows($result)>0){
   print "�q�L�{�ҡC";
 }
?>
</body></html>
