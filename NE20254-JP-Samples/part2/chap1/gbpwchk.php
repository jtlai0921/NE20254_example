<?php
 /*
  * ���ࡦ�����������Ρ����������ơ���
  */
if($DEBUG)
{echo "{$_SERVER['PHP_SELF']}@<b>".__FILE__.":".__LINE__."</b><br />\n";};

// DB�������������ˡ��ࡦ�����������Ρ������������ơ��á������
$dbh = gbdbopen($fn);
if ($dbh == FALSE) {
  echo "DB($fn): �����������顦������򣥷����<br>";
  include("gbtrailer.php");
  exit;
}
$res = (int)gbdbtblexists($dbh, 'user_tbl');
if (! $res ) {//"GUESTBOOKPASS"
  echo "���Υ؀���ʥߥޥ����㡢�������ˡ�����������������<br>";
  gbdbclose($dbh);
  include("gbtrailer.php");
  exit;
}

$gpass = gbdbselect($dbh,"user_tbl", "pass", "name = 'admin'");
//if($DEBUG)echo "gpass=\"${gpass['pass']}\"<br>\n";
if ( $gpass['pass'] != "{$_POST['GUESTBOOKPASS']}" ) {
  if ("{$_POST['GUESTBOOKPASS']}" == "") {
    echo "���ࡦ�����������Ρ��ۥ��������Υ�إ顢�̡�������<p>";
  } else {
    echo "���ࡦ�����������Ρ����衼榥����ˡ���������������<p>";
  }
  unset($_POST['GUESTBOOKPASS']);
  gbdbclose($dbh);
}
gbdbclose($dbh);
?>
