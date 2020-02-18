<?php
/*
 * ¡¦¥¤¡¦¥±¡¦¥Í¡¦ú§¡¼DB¡¢¥Ò¥ª¥å¥³¥ï¡¢€€€€¥å¥±€€à
 *
 */
if($DEBUG)
{echo "{$_SERVER['PHP_SELF']}@<b>".__FILE__.":".__LINE__."</b><br />\n";};

// ¡¦¥¤¡¦¥±¡¦¥Í¡¦ú§¡¼DB¡¢€€¥©¡¢¥Ã
$dbh = gbdbopen($fn);
if ($dbh == FALSE) {
  echo "¡¦¥¤¡¦¥±¡¦¥Í¡¦ú§¡¼DB($fn): ¡¦¥§¡£¥·¡¦¥é¡¦€€¥£¡¦ò£¥·¡£¡×<br />";
  include("gbtrailer.php");
  exit;
}
// ¥ª¥å¥³¥ï¡¦¥Ì¡£¥·¡¦¥½¡¢€€B¡¢¥Ò¥È¥Î¥¤¥Æ¡¢¥±¡¢ë
$GuestTime = time(); 
$GuestName = htmlspecialchars($_POST['GuestName']);
$GuestEmail = htmlspecialchars($_POST['GuestEmail']);
$GuestComment = htmlspecialchars($_POST['GuestComment']);
echo<<<EOT1
<table>
 <tr><th>GuestTime</th>
  <td>GuestName</td><td>GuestEmail</td><td>GuestComment</td></tr>
 <tr><th>$GuestTime</th>
  <td>$GuestName</td><td>$GuestEmail</td><td>$GuestComment</td></tr>
</table>
EOT1;

$ret = gbdbaddrecord($dbh,$GuestTime,"$GuestName\t$GuestEmail\t$GuestComment");
if ( empty($ret) ) {
	echo "¡¢¡Ö¡¢ô¦¥ã¡¢¥Í¡¢¥ò¡¢¥¨¡¢¥«¡¢¡¢¡¢¡«¡¢¥­¡¢¥½¡£¡×¥ª¥å¥³¥ï¡¢¥ª¡¢ø¦¥½¥ËäÏ¥Ë¡¢€€¥Î¥¤¥Æ¡¢¥­¡¢¡«¡¢¥­¡¢¥½¡£¡×<br />";
} else {
	echo "¥ª¥å¥³¥ï¡¢¥Û¥Ê¥ß¥Þ¥½¡¢¥Ò¥·¥³¥Ì¥ä¡¢¥­¡¢¡«¡¢¥­¡¢¥½¡£¥Ï$ret¡£¥Ò¡£¡×<br />";
}
gbdbclose($dbh);
?>
