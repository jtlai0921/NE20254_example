<html>
<head><title>auth test2</title></head>
<body>
<?php
require_once('Auth/Auth.php');
require_once('auth_login.php');

define('DSN', 'sqlite://dummy:@localhost/c:/temp/user.db?mode=0644');

$options = array('dsn'=>DSN, 'cryptType'=>'none');
$auth = new Auth("DB", $options, 'auth_login');
$auth->start();

if(!empty($_GET['logout']) && $_GET['logout'] == 1) {
  print $auth->getUsername()."�n�X�F�C";
  $auth->logout();
}
  
if($auth->getAuth()) {
  print "�{�Ҧ��\�C<br />";
}
?>
<hr />
<a href="<?php echo $_SERVER['PHP_SELF'];?>?logout=1">�n�X</a>
</body></html>
