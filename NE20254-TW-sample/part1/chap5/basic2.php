<?php
require_once "Auth/HTTP.php";

define('DSN','sqlite://dummy:@localhost//tmp/user.db?mode=0644');
define('REALM','php-users');

$options = array('dsn'=>DSN, 'cryptType'=>'none');
$auth = new Auth_HTTP("DB", $options);

$auth->setRealm(REALM);
$auth->setCancelText('�{�ҳQ�����F�C');
$auth->start();
?>
<html>
<head><title>basic test2</title></head>
<body>
<?php
if($auth->getAuth()) {
  print "�{�Ҧ��\�C<br />";
}
?>
</body></html>
