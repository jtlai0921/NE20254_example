<?php
/*
 * �����������͡�����DB���ҥ��女������奱���
 *
 */
if($DEBUG)
{echo "{$_SERVER['PHP_SELF']}@<b>".__FILE__.":".__LINE__."</b><br />\n";};

// �����������͡�����DB����������
$dbh = gbdbopen($fn);
if ($dbh == FALSE) {
  echo "�����������͡�����DB($fn): �����������顦������򣥷����<br />";
  include("gbtrailer.php");
  exit;
}
// ���女��̡�����������B���ҥȥΥ��ơ������
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
	echo "���֡����㡢�͡��򡢥������������������������ץ��女������������ϥˡ����Υ��ơ�������������������<br />";
} else {
	echo "���女��ۥʥߥޥ����ҥ����̥䡢������������������$ret���ҡ���<br />";
}
gbdbclose($dbh);
?>
