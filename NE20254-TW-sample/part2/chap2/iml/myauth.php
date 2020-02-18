<?php
/*
 *  myauth
 *  -----------
 *   File:    myauth.php
 *   Usage:   Authenticate with PEAR Auth
 *   Date:    2005-02-20
 *   Auther:  Jun Kuwamura <juk at yokohama.email.ne.jp>
 *   Version: 0.1
 *   History:
 *    2005-02-26 JuK Mod Changed to wrapper of Auth class
 *    2005-02-20 JuK Add Authentication with PEAR Auth
 */
require_once 'Auth/Auth.php';

class MyAuth {
  //private $auth;
  var $auth;
  ////
  //// Start Authentication
  ////
  //$auth = new MyAuth($dsn, 28800, 1800 );
  //if ( $action == 'logout' || $action == 'login' ) {
  //	if ( $auth->checkAuth() ) {
  //		echo "User \"".$auth->getUsername()."\" logged out.";
  //	}
  //	$auth->logout();
  //} 
  //$auth->start();
  //function __construct ( $dsn="pgsql://user:pass@localhost/database", $expire=28800, $idle=1800 ) {
  function MyAuth ( $dsn="pgsql://user:pass@localhost/database", $expire=28800, $idle=1800 ) {
    $auth_params =
      array(
            "table" => "usertbl",
            "usernamecol" => "userid",
            "passwordcol" => "passwd",
            "cryptType" => "none",
            "dsn" => $dsn
            );
    //var_dump($auth_params);
    $this->auth = new Auth("DB", $auth_params, "loginDummy", true);
    $this->auth->expire = $expire; // Session 時限 28800 for 8hr.
    $this->auth->idle = $idle;  // 閒置時限 1800 for 30min.
    $this->auth->setShowLogin( true );
  }

  function getAuth() {
    return $this->auth;
  }

  function getStorage() {
    // 執行 DB 處理的物件
    return $this->auth->storage;
  }
  function start() {
    return $this->auth->start();
  }
  function checkAuth() {
    return $this->auth->checkAuth();
  }
  function logout() {
    return $this->auth->logout();
  }
}

function loginDummy() {
    echo <<<__EOF__
    <h3>使用者認證</h3>
        (${_SERVER['PHP_SELF']})
    <br>
    <br>
    <br>
    <form method="post">
      <table><!-- cellpadding="0" cellspacing="0" border="0" width="200"-->
       <tr>
        <td><small>使用者名稱</small></td>
        <td>
     <input type='text' name='username' />
        </td>
       </tr>
       <tr>
        <td><small>密碼</small></td>
        <td>
     <input type='password' name='password' />
        </td>
       </tr>
       <tr>
        <td></td>
        <td align='right'>
        <input type='submit' value='登入' />
        </td>
       </tr>
       <tr>
        <td></td>
        <td align='right'>
        </td>
       </tr>
      </table>
    </form>
    <br/>
    <a href="imagelist.php">imagelist.php</a>
__EOF__;
}

require_once 'HTML/Template/IT.php';
function loginForm($username, $status)
{
	switch ($status) {
	case AUTH_WRONG_LOGIN :
		$msg = "AUTH_WRONG_LOGIN: ログイン失敗";
		break;
	case AUTH_EXPIRED :
		$msg = "AUTH_EXPIRED: 有効期限切れ";
		break;
	case AUTH_IDLED :
		$msg = "AUTH_IDLED: アイドル時間切れ";
		break;
	case '':
		$msg = "未認証";
		break;
	default:
		$msg = "不明";
		break;
	}
	$_SESSION['error_msg'][] = $msg;
	$message = "状態：".$msg;
	if (1) {
		$message .= "<br>\nセッション名：".session_name();
		$message .= "<br>\n セッションID：".session_id();
		$message .= "<br>\n セッションモジュール名：".session_module_name();
	}

	$password = '';

	$tpl = new HTML_Template_IT("./template/");
	$tpl->loadTemplatefile("myauth.html", true, true);
	$tpl->setCurrentBlock("login");
	$tpl->setVariable("ENTRY_ID", $username);
	$tpl->setVariable("PASSWORD", $password);
	$tpl->setVariable("ACTION", $_SERVER['PHP_SELF']);
	$tpl->setVariable("MESSAGE", $message);
	$tpl->parseCurrentBlock();
	$tpl->show();
}
?>
