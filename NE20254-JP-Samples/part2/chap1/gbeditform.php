<?php
/*
 * DBハヤスク・ユ・ゥ。シ・�
 */
if($DEBUG)
{echo "{$_SERVER['PHP_SELF']}@<b>".__FILE__.":".__LINE__."</b><br />\n";};

// ハヤスクヘム・ユ・ゥ。シ・猖スシィ
echo <<<EOF3
<center><h3>ハヤスクヘム・ユ・ゥ。シ・�</h3></center>
<form action="{$_SERVER['PHP_SELF']}?mode=admin" method="post">
<input type="hidden" name="GUESTBOOKPASS" value="{$_POST['GUESTBOOKPASS']}">
<input type="hidden" name="GUESTBOOKARG" value="{$_POST['GUESTBOOKARG']}">
<input type="hidden" name="GUESTBOOKFUNC" value="update">
<font size=-1><tt><b>、ェフセチー</b></tt></font><br>
<input type="text" name="EditGuestName" value="$name"><br><br>
<font size=-1><tt><b>ナナサメ・癸シ・�</b></tt></font><br>
<input type="text" name="EditGuestEmail" value="$email"><br><br>
<font size=-1><tt><b>・ウ・皈��ネ</b></tt></font><br>
<textarea name="EditGuestComment" rows=4 cols=72>$comment</textarea><br><br>
<center><input type="submit" value=" ハヤスクニ簣ニ、��ンツク "></center>
</form>
EOF3;
?>
