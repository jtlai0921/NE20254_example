<?php
/*
 * ����ȡ֥ʥߥޥ��ˀ��ޥ�����
 */
if($DEBUG)
{echo "{$_SERVER['PHP_SELF']}@<b>".__FILE__.":".__LINE__."</b><br />\n";};
?>
�������ơ�����榡������������ס��ϥ������ۥ������ҥ���ˀ������˥ʥߥޥ��������ˡ��á���������������<a href="<?php echo $_SERVER['PHP_SELF']; ?>?mode=read&days=7">������</a>��䦥̡��塢����������

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
  <font size=-1><tt><b>�����ե�����</b></tt></font><br />
  <input type="text" name="GuestName"><br /><br />
  <font size=-1><tt><b>�ʥʥ��ᡦ⣥����</b></tt></font><br />
  <input type="text" name="GuestEmail" value="<?php echo $_SERVER['EMAIL_ADDR']; ?>"><br /><br />
  <font size=-1><tt><b>������⧀���</b></tt></font><br />
  <textarea name="GuestComment" rows=4 cols=72></textarea><br /><br />
  <center><input type="submit" value=" ���女����ϥˡ����ߥޥ� "></center>
</form>
