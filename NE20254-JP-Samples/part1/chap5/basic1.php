<?php
require_once 'DB.php';

define('DSN','sqlite://dummy:@localhost//tmp/user.db?mode=0644');
define('REALM','php-users');

function auth_func($realm) {
  header('HTTP/1.0 401 Unauthorized');
  header("WWW-authenticate: Basic realm=\"$realm\"");
  echo 'パスワードまたはユーザ名が無効です。';
  exit;
}

if (!isset($_SERVER['PHP_AUTH_USER']) || empty($_SERVER['PHP_AUTH_USER'])) {
  auth_func(REALM);
} else { // ユーザ名/パスワードが入力されている場合
  $db = DB::connect(DSN, false) or die ("can't connect database.");
  
  $username = addslashes($_SERVER['PHP_AUTH_USER']);
  $password1 = addslashes($_SERVER['PHP_AUTH_PW']);

  $sSQL = sprintf("SELECT password FROM auth WHERE username='%s' LIMIT 1", $username); 
  $password2 = $db->getOne($sSQL);
  
  if (DB::isError($password2) || ($password1 != $password2)) {
    auth_func(REALM);
  }

}
?>
<html>
<head><title>basic test1</title></head>
<body>
認証に成功しました。
</body></html>
