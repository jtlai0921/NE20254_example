<?php
/*
 * ¡¦¥¤¡¦¥±¡¦¥Í¡¦ú§¡¼DB¡¢¥Û¡¦¥à¡¦¥±¡¦þ£¥·¡¦¥Î¥¦¥Û¥Ì¥¡¡£¥½¥Ê¥ß¥Þ¥½
 *
 */
if($DEBUG)
{echo "{$_SERVER['PHP_SELF']}@<b>".__FILE__.":".__LINE__."</b><br />\n";};

// ¡¦¥¤¡¦¥±¡¦¥Í¡¦ú§¡¼DB¡¢¥Û¥Ä¥¯¥³¡¬¥¦¥Û¥Ì¥¡
if ( gbdbexists($fn) === false ) {
  // DB¥Õ¥ª¡¢¥­
  echo "<p>¡¦¥¤¡¦¥±¡¦¥Í¡¦ú§¡¼DB($fn)¡¢¥ã¡¢¡Ö¡¢ô¦¡«¡¢¥µ¡¢€€¥Û¡¢¥Ì¥³ü¦ô¦¡«¡¢¥±¡£¡×</p>\n";
  // ¡¢ä¦¥­¡£¡ÖDB¡¢¥ã¥Ä¥¯¥³¡¬¡¢¥­¡¢¥Ï¡¢¥¢¡¢ø¦¥ß¥½¥­¡¢¥­¡¢¥Ã¥³ü¦ë
  $dbh = gbdbopen($fn);
  if ($dbh === false) {
    echo "¡¦¥¤¡¦¥±¡¦¥Í¡¦ú§¡¼DB($fn)¡¢¥ã¥³ü¦ø¦¡«¡¢¥µ¡¢€€¡×<br />";
  } else {
    if ( gbdbinit ($dbh) ) {
      gbdbclose($dbh);
      echo <<<EOF1
¡¦¥¤¡¦¥±¡¦¥Í¡¦ú§¡¼DB¡¢€€¥­¡¢¥­¡¢¥Ã¥³ü¦ô¦¡«¡¢¥­¡¢¥½¡£¡×¥¨¥Î¥Ø€€¥à¡¢¥Û¡¦¥à¡¦¥±¡¦þ£¥·¡¦¥Î¡¢€€€€¥Þ¡¢¥­¡¢¥Ë¡¢¥Ã¡¢¥¿¡¢¥ª¡¢¡¢¡£¡×
¡¢¥¦¡¢¥Û¡¦¥à¡¦¥±¡¦þ£¥·¡¦¥Î¡¢¥Þ¡£¡Ö¥³¡×¥¯ê¦¥¦¡¢¥Û¡¦¥¤¡¦¥±¡¦¥Í¡¦ú§¡¼¡¢¥Û¥¨¥Î¥Ø€€ü¸¥Í¡¢€€¥±¡¢ö¦¥½¡¢â¦¥Ò¥Î¥ã¥Ø¥é¡¢¥Í¡¢¥Ï¡¢ô¦¡«¡¢¥±¡£¡×
<p><center>
<form action="{$_SERVER['PHP_SELF']}" method="post">
<input type="password" name="GUESTBOOKPASS">
<input type="submit" value=" ¥Û¥µ¥¤ò ">
</form>
</center></p>
EOF1;
    } else {
      echo "¡¦¥¤¡¦¥±¡¦¥Í¡¦ú§¡¼¡¢¥Û¥³üÂ¥ç¡¢¥Ò¥·¥³¥Ì¥ä¡¢¥­¡¢¡«¡¢¥­¡¢¥½¡£¡×<br />";
    }
	}
  include "gbtrailer.php";
  exit;
} else {
  $dbh = gbdbopen($fn);
  if ($dbh === false) {
    echo "¡¦¥¤¡¦¥±¡¦¥Í¡¦ú§¡¼DB($fn)¡¢¥Ò¥¹€€¥å¥±€€¡¬¡¢¥Ì¡¢¥å¡¢¡«¡¢¥µ¡¢€€¡×¡£¡×<br />";
    include("gbtrailer.php");
    exit;
  } else {
    $res = (int)gbdbtblexists($dbh, 'user_tbl');
    if (! $res ) {//"GUESTBOOKPASS"
	    // DB¡¢¥Ò¡¦¥à¡¦¥±¡¦þ£¥·¡¦¥Î¡¢¥Û¥Ê¥ß¥Þ¥½
	    $tuple = array( 'adm' => 1,
                      'name' => 'admin',
                      'pass' => $_POST['GUESTBOOKPASS']
                      );
	    
	    $ret = gbdbinsert($dbh, 'user_tbl', $tuple );
	    if ( empty($ret) ) {
        echo "¡¦¥à¡¦¥±¡¦þ£¥·¡¦¥Î¡¢€€¥ß¥Þ¥½¡¢¥­¡¢¡«¡¢¥­¡¢¥½¡£¥§<br />";
	    } else {
        echo "ERROR: ¡¦¥à¡¦¥±¡¦þ£¥·¡¦¥Î¡¢¥Û¥Ê¥ß¥Þ¥½¡¢¥Ò¥·¥³¥Ì¥ä¡¢¥­¡¢¡«¡¢¥­¡¢¥½¡£¥§<br />";
	    }
    }
  }
  gbdbclose($dbh);
}
?>
