<?php
require_once('Auth/Auth.php');
require_once('auth_login.php');
define('DSN', 'sqlite://dummy:@localhost/c:/temp/user.db?mode=0644');
$options = array('dsn'=>DSN, 'cryptType'=>'none', 'db_fields'=>'user_id');
$auth = new Auth("DB", $options, 'auth_login');
$auth->start();
?>
<html><head><title>user administration</title>
<meta http-equiv="Content-Type" content="text/html; charset=big5" />
</head><body>
<h1>�ϥΪ̺޲zScript</h1>
<h2>�w�n�����ϥΪ�</h2>
<?php
if($auth->getAuth()) {
  $users = $auth->listUsers(); // ���o�n���ϥΪ̪���T
  echo '<table border="1">';
  foreach ($users as $user) {
    echo <<<EOS
      <tr><td>{$user['user_id']}</td><td>{$user['username']}</td></tr>
EOS;
  }
  echo '</table><hr />';
?>
<h2>�l�[�ϥΪ�</h2>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'].'?func=add';?>">
ID: <input type="text" name="id" size="3">
�ϥΪ̦W��: <input type="text" name="username" size="10">
�K�X: <input type="password" name="password" size="10">
<input type="submit">
</form>

<h2>�R���ϥΪ̰�</h2>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'].'?func=remove';?>">
�ϥΪ̦W��: <input type="text" name="username" size="10">
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
	echo "$username �l�[�F�C\n";
      }
    }
  } else if ($_GET['func'] == 'remove') {
    if (!empty($_POST['username'])) {
      $username = htmlentities($_POST['username']);
      if ($auth->removeUser($username)) {
	echo "$username �R���F�C\n";
      }
    }
  }
}
?>
</body></html>
