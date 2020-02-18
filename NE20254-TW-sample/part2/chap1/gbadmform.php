<?php
/*
 * DB 管理表單
 */
if($DEBUG)
{echo "{$_SERVER['PHP_SELF']}@<b>".__FILE__.":".__LINE__."</b><br />\n";};

// 顯示管理用表單
echo <<<EOF4
<center><h3>管理用表單</h3></center>

<form action="{$_SERVER['PHP_SELF']}?mode=admin" method="post">
<input type="hidden" name="GUESTBOOKPASS" value="{$_POST['GUESTBOOKPASS']}">
<input type="hidden" name="GUESTBOOKFUNC" value="clear">
刪除全部留言
<input type="submit" value="刪除全部留言">
</form>

<form action="{$_SERVER['PHP_SELF']}?mode=admin" method="post">
<input type="hidden" name="GUESTBOOKPASS" value="{$_POST['GUESTBOOKPASS']}">
<input TYPE="hidden" name="GUESTBOOKFUNC" value="delete">
刪除 <input type="text" name="GUESTBOOKARG" value="30" size=4 maxlength=4>
天之前的留言
<input type="submit" value=" 確認 ">
</form>

<form action="{$_SERVER['PHP_SELF']}?mode=admin" method="post">
<input type="hidden" name="GUESTBOOKPASS" value="{$_POST['GUESTBOOKPASS']}">
<input type="hidden" name="GUESTBOOKFUNC" value="edit">
留言 ID: <INPUT TYPE="TEXT" NAME="GUESTBOOKARG">
<input type="submit" value="編輯留言">
</form>

<form action="{$_SERVER['PHP_SELF']}?mode=admin" method="post">
<input type="hidden" name="GUESTBOOKPASS" value="{$_POST['GUESTBOOKPASS']}">
<input type="hidden" name="GUESTBOOKFUNC" value="change_password">
變更密碼: <input type="password" name="GUESTBOOKARG">
<input type="submit" value=" 確認 ">
</form>
EOF4;
?>
