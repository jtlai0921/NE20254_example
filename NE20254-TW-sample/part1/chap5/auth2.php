<html>
<head><title>auth test2</title></head>
<body>
<?php
require_once('Auth/Auth.php');
require_once('auth_login_js.php');

define('DSN', 'sqlite://dummy:@localhost/c:/temp/user.db?mode=0644');

$options = array('dsn'=>DSN);
$auth = new Auth("DB_Digest", $options, 'auth_login_js');
$auth->start();

if($auth->getAuth()) {
  print "private contents.";
}
?>
</body></html>
