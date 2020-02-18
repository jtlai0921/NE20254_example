<?php
function auth_login_js($username, $status, $obj) {
  $key = $obj->storage->getChallenge();

  echo <<<EOS
<script language="JavaScript" src="md5.js"></script>
<script language="JavaScript"><!--
function login(p) {
  p['password'].value = hex_hmac_md5( p['key'].value, 
				      p['username'].value + ':' + 
				      p['password'].value);
  p['hash'].value = 1;
  return true;
}
//--></script>
 <form method="post" action="{$_SERVER['PHP_SELF']}" onSubmit="return login(this);">
    <table border="0" cellpadding="2" cellspacing="0" summary="login form">
    <tr>
    <td colspan="2" bgcolor="#eeeeee"><b>ログイン:</b></td>
    </tr><tr>
    <td>ユーザ名:</td>
    <td><input type="text" name="username" value="$username" /></td>
    </tr><tr>
    <td>パスワード:</td>
    <td>
    <input type="hidden" name="key" value="$key" />
    <input type="hidden" name="hash" value="0" />
    <input type="password" name="password" />
    </td>
    </tr><tr>
    <td colspan="2" bgcolor="#eeeeee"><input type="submit" /></td>
    </tr>
    </table></form>
EOS;
}
?>
