<html><head><meta http-equiv="Content-Type" content="text/html; chartset=utf-8" /></head><body>
<form action="xdebug1.php" method="POST"><pre>
使用者名稱：<input type="text" name="uname"/>
　　　密碼：<input type="password" name="password"/>
</pre><input type="submit" /></form>
<?php
function adduser($user, $pwd) {
  $sql = sprintf("INSERT INTO user VALUES('%s','%s')",$user, $pwd);
  if ($db = sqlite_open('c:/temp/user.db', 0666, $err)) {
    sqlite_query($db, $sql);
    return true;
  }
  return false;
}
$user = htmlentities($_POST['uname']);
$password = htmlentities($_POST['password']);
if (adduser($user,$password)) {
  print "已登錄「".$user."」使用者。";
}
?>
</body></html>

