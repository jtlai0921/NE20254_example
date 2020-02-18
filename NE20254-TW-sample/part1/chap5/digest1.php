<?php
require_once "Auth/HTTP.php";

define('DSN','sqlite://dummy:@localhost//tmp/user.db?mode=0644');
define('REALM','php-users');
define('DIGEST_REALM','php-users-digest');

$options = array('dsn'=>DSN, 'cryptType'=>'none', 
		 'authMethod'=>'digest');
$auth = new Auth_HTTP("DB", $options);

$auth->setRealm(REALM, DIGEST_REALM);
$auth->start();
?>
<html>
<head><title>digest authentication test</title></head>
<body>
<?php
if($auth->getAuth()) {
  print "authentication suceeded.";
  print "<hr>";
  print_r($auth->auth);
}
?>
</body></html>
