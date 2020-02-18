<?php
/*
 * DB¥Ï¥ä¥¹¥¯¡¦¥æ¡¦¥¥¡£¥·¡¦à
 */
if($DEBUG)
{echo "{$_SERVER['PHP_SELF']}@<b>".__FILE__.":".__LINE__."</b><br />\n";};

// ¥Ï¥ä¥¹¥¯¥Ø¥à¡¦¥æ¡¦¥¥¡£¥·¡¦àË¥¹¥·¥£
echo <<<EOF3
<center><h3>¥Ï¥ä¥¹¥¯¥Ø¥à¡¦¥æ¡¦¥¥¡£¥·¡¦à</h3></center>
<form action="{$_SERVER['PHP_SELF']}?mode=admin" method="post">
<input type="hidden" name="GUESTBOOKPASS" value="{$_POST['GUESTBOOKPASS']}">
<input type="hidden" name="GUESTBOOKARG" value="{$_POST['GUESTBOOKARG']}">
<input type="hidden" name="GUESTBOOKFUNC" value="update">
<font size=-1><tt><b>¡¢¥§¥Õ¥»¥Á¡¼</b></tt></font><br>
<input type="text" name="EditGuestName" value="$name"><br><br>
<font size=-1><tt><b>¥Ê¥Ê¥µ¥á¡¦â£¥·¡¦ë</b></tt></font><br>
<input type="text" name="EditGuestEmail" value="$email"><br><br>
<font size=-1><tt><b>¡¦¥¦¡¦â§€€¥Í</b></tt></font><br>
<textarea name="EditGuestComment" rows=4 cols=72>$comment</textarea><br><br>
<center><input type="submit" value=" ¥Ï¥ä¥¹¥¯¥ËäÏ¥Ë¡¢€€¥ó¥Ä¥¯ "></center>
</form>
EOF3;
?>
