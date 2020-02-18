<?php

function auth_login($username, $status) {

  switch($status) {
  case AUTH_IDLED:
    $message = '長時間アクセスがなかったため認証をリセットしました。';
    break;    
  case AUTH_EXPIRED:
    $message = '有効期限切れのため認証をリセットしました。';
    break;
  case AUTH_WRONG_LOGIN:
    $message = 'ユーザ名またはパスワードが間違っています。';
    break;
  case AUTH_SECURITY_BREACH:
    $message = 'IPアドレスまたはブラウザを検出されたため認証をリセットしました。';
    break;
  default:
    $message = '';
    break;
  }
  print "<i>$message</i>\n";
  
  echo <<<EOS
<form method="post" action="{$_SERVER['PHP_SELF']}">
    <table border="0" cellpadding="2" cellspacing="0" summary="login form">
    <tr>
    <td colspan="2" bgcolor="#eeeeee"><b>ログイン:</b></td>
    </tr>
    <tr>
    <td>ユーザ名:</td>
    <td><input type="text" name="username" value="$username" /></td>
    </tr>
    <tr>
    <td>パスワード:</td>
    <td><input type="password" name="password" /></td>
    </tr>
    <tr>
    <td colspan="2" bgcolor="#eeeeee"><input type="submit" /></td>
    </tr>
    </table>
    </form>
    </center>
EOS;
}

?>
