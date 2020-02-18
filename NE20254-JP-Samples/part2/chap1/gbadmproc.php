<?php
/*
 * DB���Υ؀��π��ĥ���
 */
if($DEBUG)
{echo "{$_SERVER['PHP_SELF']}@<b>".__FILE__.":".__LINE__."</b><br />\n";};

$dbh = gbdbopen($fn);
if ($dbh == FALSE) {
  echo "DB($fn): �����������顦������򣥷����<br />";
  include("gbtrailer.php");
  exit;
}

// �������������������͡��ۥ����
switch($_POST['GUESTBOOKFUNC']){
 case "clear":
   // �������女�糧�ƥ��
   $ret = gbdbdelete ($dbh, "note_tbl");
   echo "���女��������롢�˥��ƥ���������������������<p>";
   break;
 case "delete":
   // ������Ȁ����ϥ�깥ߥ�⦥��������女������
   $days = (int)$_POST['GUESTBOOKARG'];
   $today = time();
   $stadate = $today - $days * 3600 * 24;;
   $condition = "date < $stadate";
   $ret = gbdbdelete ($dbh, "note_tbl", $condition);
   if ( $ret) {
	   echo "$stadate �������̡��ۥ��女�������������������������<br />";
   } else {
	   echo "$stadate �������̡��ۥ��女��ۥ������ҥ����̥䡢������������������<br />";
   }
   break;
 case "change_password":
    // ���ࡦ�����������Ρ��ۥ�������
   $pass = $_POST['GUESTBOOKARG'];
   $ret = gbdbupdate ($dbh, 'user_tbl', 'pass', "'$pass'", "name = 'admin'");
   if (! empty($ret) ) {
     echo "���ࡦ�����������Ρ��ޥ����̥䡢��������������($ret)����<br />";
   } else {
     echo "���ࡦ�����������Ρ����ॱ����������������������<br />";
   }
   break;
 case "edit":
   // ���女��ϥॱ���إࡢ�ۡ��桦���������˥�����
   $condition = "date = ${_POST['GUESTBOOKARG']}";
   $entry=gbdbselect($dbh, 'note_tbl', '*', $condition);
   if (! is_array($entry) ) {
     echo "��������ۥ��女��({$_POST['GUESTBOOKARG']})���ޥ������ȡ�������������������<br />";
   } else {
     // �������襫�¥졢���ۡ��̡������������㥤�
     $name = $entry['name'];
     $email = $entry['mail'];
     $comment = $entry['note'];
     $entrydate = $entry['date'];
     // ���女��ۥϥ䥹�����桦���������
     include "gbeditform.php";
   }
   unset ($_POST['GUESTBOOKARG']);
   break;
 case "update":
   // �ϥॱ�����ϥˡ��ۥϥ�ĥ�
   $cols['name'] = "'{$_POST['EditGuestName']}'";
   $cols['mail'] = "'{$_POST['EditGuestEmail']}'";
   $cols['note'] = "'{$_POST['EditGuestComment']}'";
   $cond = "date = {$_POST['GUESTBOOKARG']}";
   $ret = gbdbupdatearray ($dbh, 'note_tbl', $cols, $cond);
   if (! empty($ret) ) {
     echo "���女��ۥ����������ޥ����̥䡢��������������($ret)����<br />";
   } else {
     echo "�ϥॱ�������������女�����ĥ���������������������<br />";
   }
   break;
}
gbdbclose($dbh);
?>
