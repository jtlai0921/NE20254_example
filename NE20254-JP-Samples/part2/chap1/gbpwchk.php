<?php
 /*
  * ¡¦¥à¡¦¥±¡¦þ£¥·¡¦¥Î¡¦¥Á¡¦¥¡¡¦¥Æ¡¦¥Ã
  */
if($DEBUG)
{echo "{$_SERVER['PHP_SELF']}@<b>".__FILE__.":".__LINE__."</b><br />\n";};

// DB¡¢€€¥©¡¢¡¢¡¢¥Ë¡¦¥à¡¦¥±¡¦þ£¥·¡¦¥Î¡¢€€¥Á¡¦¥¡¡¦¥Æ¡¦¥Ã¡¢¥±¡¢ë
$dbh = gbdbopen($fn);
if ($dbh == FALSE) {
  echo "DB($fn): ¡¦¥§¡£¥·¡¦¥é¡¦€€¥£¡¦ò£¥·¡£¡×<br>";
  include("gbtrailer.php");
  exit;
}
$res = (int)gbdbtblexists($dbh, 'user_tbl');
if (! $res ) {//"GUESTBOOKPASS"
  echo "¥¨¥Î¥Ø€€¥ä¥Ê¥ß¥Þ¥½¡¢¥ã¡¢¥ª¡¢ø¦¥Ë¡¢¡¢¡¢¡«¡¢¥µ¡¢€€¡×<br>";
  gbdbclose($dbh);
  include("gbtrailer.php");
  exit;
}

$gpass = gbdbselect($dbh,"user_tbl", "pass", "name = 'admin'");
//if($DEBUG)echo "gpass=\"${gpass['pass']}\"<br>\n";
if ( $gpass['pass'] != "{$_POST['GUESTBOOKPASS']}" ) {
  if ("{$_POST['GUESTBOOKPASS']}" == "") {
    echo "¡¦¥à¡¦¥±¡¦þ£¥·¡¦¥Î¡¢¥Û¥µ¥ê¥Èô¦¥ã¥Î¥ã¥Ø¥é¡¢¥Ì¡¢¥±¡£¡×<p>";
  } else {
    echo "¡¦¥à¡¦¥±¡¦þ£¥·¡¦¥Î¡¢€€¥è¡¼æ¦¥£¡¢¥Ë¡¢¡¢¡¢¡«¡¢¥±¡£¡×<p>";
  }
  unset($_POST['GUESTBOOKPASS']);
  gbdbclose($dbh);
}
gbdbclose($dbh);
?>
