<?php
/*
 * ¥ª¥å¥È¡Ö¥Ê¥ß¥Þ¥½¥Ë€€¥Þ¥¹€€¡¼
 */
if($DEBUG)
{echo "{$_SERVER['PHP_SELF']}@<b>".__FILE__.":".__LINE__."</b><br />\n";};
?>
¡¢¡¢¡¢ò¦¥Æ¡¢¥­¡¢æ¦¡¢¡¢¡«¡¢¥µ¡£¡×¡¼¥Ï¥¤¥·¡¢¥Û¥«€€€€¥Ò¥ª¥å¥Ë€€¥­¡¢¥Ë¥Ê¥ß¥Þ¥½¡¢¥­¡¢¥Ë¡¢¥Ã¡¢¥¿¡¢¥ª¡¢¡¢¡£¡×<a href="<?php echo $_SERVER['PHP_SELF']; ?>?mode=read&days=7">¥¢¥ï¥Ø÷</a>¡¢ä¦¥Ì¡¢¥å¡¢¡«¡¢¥±¡£¡×

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
  <font size=-1><tt><b>¡¢¥§¥Õ¥»¥Á¡¼</b></tt></font><br />
  <input type="text" name="GuestName"><br /><br />
  <font size=-1><tt><b>¥Ê¥Ê¥µ¥á¡¦â£¥·¡¦ë</b></tt></font><br />
  <input type="text" name="GuestEmail" value="<?php echo $_SERVER['EMAIL_ADDR']; ?>"><br /><br />
  <font size=-1><tt><b>¡¦¥¦¡¦â§€€¥Í</b></tt></font><br />
  <textarea name="GuestComment" rows=4 cols=72></textarea><br /><br />
  <center><input type="submit" value=" ¥ª¥å¥³¥ï¥ËäÏ¥Ë¡¢€€¥ß¥Þ¥½ "></center>
</form>
