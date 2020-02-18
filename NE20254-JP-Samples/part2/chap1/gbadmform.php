<?php
/*
 * DB¥¨¥Î¥Ø€€¥æ¡¦¥¥¡£¥·¡¦à
 */
if($DEBUG)
{echo "{$_SERVER['PHP_SELF']}@<b>".__FILE__.":".__LINE__."</b><br />\n";};

// ¥¨¥Î¥Ø€€¥à¡¦¥æ¡¦¥¥¡£¥·¡¦àË¥¹¥·¥£
echo <<<EOF4
<center><h3>¥¨¥Î¥Ø€€¥à¡¦¥æ¡¦¥¥¡£¥·¡¦à</h3></center>

<form action="{$_SERVER['PHP_SELF']}?mode=admin" method="post">
<input type="hidden" name="GUESTBOOKPASS" value="{$_POST['GUESTBOOKPASS']}">
<input type="hidden" name="GUESTBOOKFUNC" value="clear">
¡¢¥±¡¢¥ë¡¢¥Ë¡¢¥Û¥ª¥å¥³¥ï¡¢€€¥Æ¥ªü¦¥­¡¢¡«¡¢¥±¡£¡×
<input type="submit" value="¥Á¥¨¥ª¥å¥³¥ï¥»¥Æ¥ªî">
</form>

<form action="{$_SERVER['PHP_SELF']}?mode=admin" method="post">
<input type="hidden" name="GUESTBOOKPASS" value="{$_POST['GUESTBOOKPASS']}">
<input TYPE="hidden" name="GUESTBOOKFUNC" value="delete">
<input type="text" name="GUESTBOOKARG" value="30" size=4 maxlength=4>
¥Ë€€¥Ï¥»êÃ¡¼¡¢¥Û¥ª¥å¥³¥ï¡¢€€þ¿€€¥­¡¢¡«¡¢¥±¡£¡×
<input type="submit" value=" ¥Û¥µ¥¤ò ">
</form>

<form action="{$_SERVER['PHP_SELF']}?mode=admin" method="post">
<input type="hidden" name="GUESTBOOKPASS" value="{$_POST['GUESTBOOKPASS']}">
<input type="hidden" name="GUESTBOOKFUNC" value="edit">
¥ª¥å¥³¥ï¡¢¥ÛID: <INPUT TYPE="TEXT" NAME="GUESTBOOKARG">
<input type="submit" value="¥ª¥å¥³¥ï¡¢¥Û¥Ï¥ä¥¹¥¯">
</form>

<form action="{$_SERVER['PHP_SELF']}?mode=admin" method="post">
<input type="hidden" name="GUESTBOOKPASS" value="{$_POST['GUESTBOOKPASS']}">
<input type="hidden" name="GUESTBOOKFUNC" value="change_password">
¡¦¥à¡¦¥±¡¦þ£¥·¡¦¥Î¡¢€€¥à¥±¥±¡¢¥­¡¢¡«¡¢¥±¡£¥¡ <input type="password" name="GUESTBOOKARG">
<input type="submit" value=" ¥Û¥µ¥¤ò ">
</form>
EOF4;
?>
