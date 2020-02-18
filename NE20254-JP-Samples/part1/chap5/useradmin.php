<?php
require_once('Auth/Auth.php');
require_once('auth_login.php');
define('DSN', 'sqlite://dummy:@localhost//tmp/user.db?mode=0644');
$options = array('dsn'=>DSN, 'cryptType'=>'none', 'db_fields'=>'user_id');
$auth = new Auth("DB", $options, 'auth_login');
$auth->start();
?>
<html><head><title>user administration</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
</head><body>
<h1>�桼������������ץ�</h1>
<h2>��Ͽ�Ѥߥ桼��</h2>
<?php
if($auth->getAuth()) {
  $users = $auth->listUsers(); // ��Ͽ�桼���˴ؤ����������
  echo '<table border="1">';
  foreach ($users as $user) {
    echo <<<EOS
      <tr><td>{$user['user_id']}</td><td>{$user['username']}</td></tr>
EOS;
  }
  echo '</table><hr />';
?>
<h2>�桼���ɲ�</h2>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'].'?func=add';?>">
       ID��<input type="text" name="id" size="3">
  �桼��̾��<input type="text" name="username" size="10">
�ѥ���ɡ�<input type="password" name="password" size="10">
<input type="submit">
</form>

<h2>�桼�����</h2>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'].'?func=remove';?>">
  �桼��̾��<input type="text" name="username" size="10">
<input type="submit"></form>
<hr />
<?php
  if ($_GET['func'] == 'add') {
    if (!empty($_POST['username']) && !empty($_POST['password']) 
	&& !empty($_POST['id'])) {
      $username = htmlentities($_POST['username']);
      $password = htmlentities($_POST['password']);
      $id = htmlentities($_POST['id']);
      if ($auth->addUser($username , $password, array('user_id'=>$id))) {
	echo "$username ���ɲä��ޤ�����\n";
      }
    }
  } else if ($_GET['func'] == 'remove') {
    if (!empty($_POST['username'])) {
      $username = htmlentities($_POST['username']);
      if ($auth->removeUser($username)) {
	echo "$username ���ɲä��ޤ�����\n";
      }
    }
  }
}
?>
</body></html>
