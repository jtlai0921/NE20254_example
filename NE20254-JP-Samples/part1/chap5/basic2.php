<?php
require_once "Auth/HTTP.php";

define('DSN','sqlite://dummy:@localhost//tmp/user.db?mode=0644');
define('REALM','php-users');

$options = array('dsn'=>DSN, 'cryptType'=>'none');
$auth = new Auth_HTTP("DB", $options);

$auth->setRealm(REALM);
$auth->setCancelText('ǧ�ڤ�����󥻥뤵��ޤ�����');
$auth->start();
?>
<html>
<head><title>basic test2</title></head>
<body>
<?php
if($auth->getAuth()) {
  print "ǧ�ڤ��������ޤ�����<br />";
}
?>
</body></html>
