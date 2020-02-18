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
  private $auth;
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
  function __construct ( $dsn="pgsql://user:pass@localhost/database", $expire=28800, $idle=1800 ) {
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
    $this->auth->expire = $expire; // ¡¦¥µ¡¦¥Æ¡¦¥­¡¦î§€€€€¥è¥¿¥ì¡¢ì 28800 for 8hr.
    $this->auth->idle = $idle;  // ¡¦¡Ö¡¦¡¢¡¦¥Î¡¦ô§€€¡¼¥µ€€¥è¥¿¥ì¡¢ì 1800 for 30min.
    $this->auth->setShowLogin( true );
  }

  function getAuth() {
    return $this->auth;
  }

  function getStorage() {
    // DB¡¦¡Ö¡¦¥Ã¡¦¥µ¡¦¥±¥Ø¥à¡¦¥§¡¦¥è¡¦¥¯¡¦¥¡¡¦¥Ã¡¦¥Í
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
    <h3>¡¦ì£¥·¡¦¥«¥Ì¥¡¥»¥ì</h3>
        (${_SERVER['PHP_SELF']})
    <br>
    <br>
    <br>
    <form method="post">
      <table><!-- cellpadding="0" cellspacing="0" border="0" width="200"-->
       <tr>
        <td><small>¡¦ì£¥·¡¦¥«¥Õ¥»</small></td>
        <td>
     <input type='text' name='username' />
        </td>
       </tr>
       <tr>
        <td><small>¡¦¥à¡¦¥±¡¦þ£¥·¡¦¥Î</small></td>
        <td>
     <input type='password' name='password' />
        </td>
       </tr>
       <tr>
        <td></td>
        <td align='right'>
        <input type='submit' value='¡¦ú§¡¼¡¦¡¢¡¦ó' />
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
		$msg = "AUTH_WRONG_LOGIN: ¡¦ú§¡¼¡¦¡¢¡¦€€¥³¥Ì¥ä";
		break;
	case AUTH_EXPIRED :
		$msg = "AUTH_EXPIRED: ¥Ø¥å¥¯€€€€¥Ä¥¿¥ì¡¢ì";
		break;
	case AUTH_IDLED :
		$msg = "AUTH_IDLED: ¡¦¡Ö¡¦¡¢¡¦¥Î¡¦ö½€€¥è¥¿¥ì¡¢ì";
		break;
	case '':
		$msg = "¥Õ¡¢¥Ì¥¡¥»¥ì";
		break;
	default:
		$msg = "¥Î¥ä¥Õ¥¿";
		break;
	}
	$_SESSION['error_msg'][] = $msg;
	$message = "¥»€€¥è¡£¥¡".$msg;
	if (1) {
		$message .= "<br>\n¡¦¥µ¡¦¥Æ¡¦¥­¡¦î§€€¥»¡£¥¡".session_name();
		$message .= "<br>\n ¡¦¥µ¡¦¥Æ¡¦¥­¡¦î§€€D¡£¥¡".session_id();
		$message .= "<br>\n ¡¦¥µ¡¦¥Æ¡¦¥­¡¦î§€€ä§¥¯¡¦ê£¥·¡¦öÎ¥»¡£¥¡".session_module_name();
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
