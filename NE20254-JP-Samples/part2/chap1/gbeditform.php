<?php
/*
 * DB�ϥ䥹�����桦���������
 */
if($DEBUG)
{echo "{$_SERVER['PHP_SELF']}@<b>".__FILE__.":".__LINE__."</b><br />\n";};

// �ϥ䥹���إࡦ�桦���������˥�����
echo <<<EOF3
<center><h3>�ϥ䥹���إࡦ�桦���������</h3></center>
<form action="{$_SERVER['PHP_SELF']}?mode=admin" method="post">
<input type="hidden" name="GUESTBOOKPASS" value="{$_POST['GUESTBOOKPASS']}">
<input type="hidden" name="GUESTBOOKARG" value="{$_POST['GUESTBOOKARG']}">
<input type="hidden" name="GUESTBOOKFUNC" value="update">
<font size=-1><tt><b>�����ե�����</b></tt></font><br>
<input type="text" name="EditGuestName" value="$name"><br><br>
<font size=-1><tt><b>�ʥʥ��ᡦ⣥����</b></tt></font><br>
<input type="text" name="EditGuestEmail" value="$email"><br><br>
<font size=-1><tt><b>������⧀���</b></tt></font><br>
<textarea name="EditGuestComment" rows=4 cols=72>$comment</textarea><br><br>
<center><input type="submit" value=" �ϥ䥹�����ϥˡ�����ĥ� "></center>
</form>
EOF3;
?>
