<?php
require_once 'Auth/Container/DB.php';
require_once 'DB.php';
require_once 'Crypt/HMAC.php';

class Auth_Container_DB_Digest extends Auth_Container_DB
{
  function _setDefaults()
    {
      parent::_setDefaults();
      $this->options['cryptType']   = 'digest';
    }
  
  function verifyPassword($password1, $password2, $cryptType = "digest")
    {
      if ($cryptType == "digest") {
	$hmac = new Crypt_HMAC($_POST['key'], 'md5');
	$password2 = $hmac->hash("{$_POST['username']}:$password2");
	return $password1 == $password2;
      }
      return parent::verifyPassword($password1, $password2, $cryptType);
    }
  
  function getChallenge() {
    return md5(uniqid(mt_rand(), true));
  }
}
?>
