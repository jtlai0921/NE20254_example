<html>
<head><title>auth test1</title></head>
<body>
<?php
require_once('Auth/Auth.php');
require_once('auth_login.php');

define('DSN', 'sqlite://dummy:@localhost/c:/temp/user.db?mode=0644');

$options = array('dsn'=>DSN, 'cryptType'=>'none', 'db_fields'=>'user_id');
$auth = new Auth("DB", $options, 'auth_login');
$auth->start();
?>
<html><head><title>Perm example 1</title>
<meta http-equiv="Content-Type" content="text/html; charset=big5" />
</head><body>
<?php
if($auth->getAuth()) {
  print "認證成功。<br />";
}
?>
</body></html>
