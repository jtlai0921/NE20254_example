<?php

function auth_login($username, $status) {

  switch($status) {
  case AUTH_IDLED:
    $message = 'Ĺ���֥����������ʤ��ä�����ǧ�ڤ�ꥻ�åȤ��ޤ�����';
    break;    
  case AUTH_EXPIRED:
    $message = 'ͭ�������ڤ�Τ���ǧ�ڤ�ꥻ�åȤ��ޤ�����';
    break;
  case AUTH_WRONG_LOGIN:
    $message = '�桼��̾�ޤ��ϥѥ���ɤ��ְ�äƤ��ޤ���';
    break;
  case AUTH_SECURITY_BREACH:
    $message = 'IP���ɥ쥹�ޤ��ϥ֥饦���򸡽Ф��줿����ǧ�ڤ�ꥻ�åȤ��ޤ�����';
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
    <td colspan="2" bgcolor="#eeeeee"><b>������:</b></td>
    </tr>
    <tr>
    <td>�桼��̾:</td>
    <td><input type="text" name="username" value="$username" /></td>
    </tr>
    <tr>
    <td>�ѥ����:</td>
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
