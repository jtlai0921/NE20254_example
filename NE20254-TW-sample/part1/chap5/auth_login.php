<?php

function auth_login($username, $status) {

  switch($status) {
  case AUTH_IDLED:
    $message = '�]���ɶ����ާ@�ҥH�{�ҳQ���]�C';
    break;    
  case AUTH_EXPIRED:
    $message = '�]�{�ҥ��ĩҥH�{�ҳQ���]�C';
    break;
  case AUTH_WRONG_LOGIN:
    $message = '�ϥΪ̦W�٩αK�X���~�C';
    break;
  case AUTH_SECURITY_BREACH:
    $message = '�]���o�{ IP ��}���s���������ܰʩҥH�{�ҳQ���]�C';
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
    <td colspan="2" bgcolor="#eeeeee"><b>�n�J:</b></td>
    </tr>
    <tr>
    <td>�ϥΪ̦W��:</td>
    <td><input type="text" name="username" value="$username" /></td>
    </tr>
    <tr>
    <td>�K�X:</td>
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
