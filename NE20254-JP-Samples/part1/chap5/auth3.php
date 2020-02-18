<html>
<head><title>auth test2</title></head>
<body>
<?php
require_once('Auth/Auth.php');
require_once('auth_login.php');

define('DSN', 'sqlite://dummy:@localhost//tmp/user.db?mode=0644');

$options = array('dsn'=>DSN, 'cryptType'=>'none');
$auth = new Auth("DB", $options, 'auth_login');
$auth->start();

if(!empty($_GET['logout']) && $_GET['logout'] == 1) {
  print $auth->getUsername()."はログアウトしました。";
  $auth->logout();
}
  
if($auth->getAuth()) {
  print "認証に成功しました。<br />";
}
?>
<hr />
<a href="<?php echo $_SERVER['PHP_SELF'];?>?logout=1">ログアウト</a>
</body></html>
