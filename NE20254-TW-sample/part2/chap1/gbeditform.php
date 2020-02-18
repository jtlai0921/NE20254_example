<?php
/*
 * DB 編輯表單
 */
if($DEBUG)
{echo "{$_SERVER['PHP_SELF']}@<b>".__FILE__.":".__LINE__."</b><br />\n";};

// 顯示編輯表單
echo <<<EOF3
<center><h3>編輯用表單</h3></center>
<form action="{$_SERVER['PHP_SELF']}?mode=admin" method="post">
<input type="hidden" name="GUESTBOOKPASS" value="{$_POST['GUESTBOOKPASS']}">
<input type="hidden" name="GUESTBOOKARG" value="{$_POST['GUESTBOOKARG']}">
<input type="hidden" name="GUESTBOOKFUNC" value="update">
<font size=-1><tt><b>名稱</b></tt></font><br>
<input type="text" name="EditGuestName" value="$name"><br><br>
<font size=-1><tt><b>電子信箱</b></tt></font><br>
<input type="text" name="EditGuestEmail" value="$email"><br><br>
<font size=-1><tt><b>留言</b></tt></font><br>
<textarea name="EditGuestComment" rows=4 cols=72>$comment</textarea><br><br>
<center><input type="submit" value=" 儲存編輯結果 "></center>
</form>
EOF3;
?>
