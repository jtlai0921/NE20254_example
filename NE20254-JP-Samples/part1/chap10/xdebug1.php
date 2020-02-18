<html><body>
<form action="xdebug1.php" method="POST"><pre>
  ユーザ名：<input type="text" name="uname"/>
パスワード：<input type="password" name="password"/>
</pre><input type="submit" /></form>
<?php
function adduser($user, $pwd) {
  $sql = sprintf("INSERT INTO user VALUES('%s','%s')",$user, $pwd);
  if ($db = sqlite_open('/tmp/user.db', 0666, $err)) {
    sqlite_query($db, $sql);
    return true;
  }
  return false;
}
$user = htmlentities($_POST['uname']);
$password = htmlentities($_POST['password']);
if (adduser($user,$password)) {
  print "ユーザ「".$user."」の登録を行いました。";
}
?>
</body></html>

