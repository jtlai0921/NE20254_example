<?php

function auth_login($username, $status) {

  switch($status) {
  case AUTH_IDLED:
    $message = '因長時間未操作所以認證被重設。';
    break;    
  case AUTH_EXPIRED:
    $message = '因認證失效所以認證被重設。';
    break;
  case AUTH_WRONG_LOGIN:
    $message = '使用者名稱或密碼錯誤。';
    break;
  case AUTH_SECURITY_BREACH:
    $message = '因為發現 IP 位址或瀏覽器產生變動所以認證被重設。';
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
    <td colspan="2" bgcolor="#eeeeee"><b>登入:</b></td>
    </tr>
    <tr>
    <td>使用者名稱:</td>
    <td><input type="text" name="username" value="$username" /></td>
    </tr>
    <tr>
    <td>密碼:</td>
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
