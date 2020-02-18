<?php
require_once 'Perm.php';
require_once 'auth_login.php';

define('DSN','sqlite://dummy:@localhost//tmp/user.db?mode=0644');
define('PUBLIC_AREA', 1);
define('PRIVATE_AREA', 2);

$options = array('dsn' => DSN, 'cryptType'=>'none', 'db_fields'=>'user_id');
$user = new Perm('DB', $options, 'auth_login');
$user->start();
?>
<html><head><title>Perm example 1</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
</head><body>
<?php
if($user->checkPerm(PUBLIC_AREA)){
  print '��������'.$user->getAreaName(PUBLIC_AREA).'�Υ���ƥ��<br />';
}

if($user->checkPerm(PRIVATE_AREA)){
  print '��������'.$user->getAreaName(PRIVATE_AREA).'�Υ���ƥ��<br />';
}

print '���ʤ��Υ��롼�ס�'.$user->getGroup().'<br />';
?>
</body></html>
