<?php
/*
 * DB���Υ؀��桦���������
 */
if($DEBUG)
{echo "{$_SERVER['PHP_SELF']}@<b>".__FILE__.":".__LINE__."</b><br />\n";};

// ���Υ؀��ࡦ�桦���������˥�����
echo <<<EOF4
<center><h3>���Υ؀��ࡦ�桦���������</h3></center>

<form action="{$_SERVER['PHP_SELF']}?mode=admin" method="post">
<input type="hidden" name="GUESTBOOKPASS" value="{$_POST['GUESTBOOKPASS']}">
<input type="hidden" name="GUESTBOOKFUNC" value="clear">
�������롢�ˡ��ۥ��女����ƥ�����������������
<input type="submit" value="�������女�糧�ƥ��">
</form>

<form action="{$_SERVER['PHP_SELF']}?mode=admin" method="post">
<input type="hidden" name="GUESTBOOKPASS" value="{$_POST['GUESTBOOKPASS']}">
<input TYPE="hidden" name="GUESTBOOKFUNC" value="delete">
<input type="text" name="GUESTBOOKARG" value="30" size=4 maxlength=4>
�ˀ��ϥ��á����ۥ��女���������������������
<input type="submit" value=" �ۥ���� ">
</form>

<form action="{$_SERVER['PHP_SELF']}?mode=admin" method="post">
<input type="hidden" name="GUESTBOOKPASS" value="{$_POST['GUESTBOOKPASS']}">
<input type="hidden" name="GUESTBOOKFUNC" value="edit">
���女���ID: <INPUT TYPE="TEXT" NAME="GUESTBOOKARG">
<input type="submit" value="���女��ۥϥ䥹��">
</form>

<form action="{$_SERVER['PHP_SELF']}?mode=admin" method="post">
<input type="hidden" name="GUESTBOOKPASS" value="{$_POST['GUESTBOOKPASS']}">
<input type="hidden" name="GUESTBOOKFUNC" value="change_password">
���ࡦ�����������Ρ����ॱ������������������ <input type="password" name="GUESTBOOKARG">
<input type="submit" value=" �ۥ���� ">
</form>
EOF4;
?>
