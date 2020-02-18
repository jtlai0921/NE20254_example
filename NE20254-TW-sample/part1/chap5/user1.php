<?php
require_once 'Perm.php';
require_once 'auth_login.php';

define('DSN','sqlite://dummy:@localhost/c:/temp/user.db?mode=0644');
define('PUBLIC_AREA', 1);
define('PRIVATE_AREA', 2);

$options = array('dsn' => DSN, 'cryptType'=>'none', 'db_fields'=>'user_id');
$user = new Perm('DB', $options, 'auth_login');
$user->start();
?>
<html><head><title>Perm example 1</title>
<meta http-equiv="Content-Type" content="text/html; charset=big5" />
</head><body>
<?php
if($user->checkPerm(PUBLIC_AREA)){
  print '����}'.$user->getAreaName(PUBLIC_AREA).'�����e<br />';
}

if($user->checkPerm(PRIVATE_AREA)){
  print '����}'.$user->getAreaName(PRIVATE_AREA).'�����e<br />';
}

print '�z���s��:'.$user->getGroup().'<br />';
?>
</body></html>
