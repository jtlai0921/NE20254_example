<?php
/*
 * �����������͡�����DB���ۡ��ࡦ�����������Υ��ۥ̥������ʥߥޥ�
 *
 */
if($DEBUG)
{echo "{$_SERVER['PHP_SELF']}@<b>".__FILE__.":".__LINE__."</b><br />\n";};

// �����������͡�����DB���ۥĥ��������ۥ̥�
if ( gbdbexists($fn) === false ) {
  // DB�ե�����
  echo "<p>�����������͡�����DB($fn)���㡢�֡��������������ۡ��̥���������������</p>\n";
  // ��䦥�����DB����ĥ������������ϡ��������ߥ����������å����
  $dbh = gbdbopen($fn);
  if ($dbh === false) {
    echo "�����������͡�����DB($fn)���㥳����������������<br />";
  } else {
    if ( gbdbinit ($dbh) ) {
      gbdbclose($dbh);
      echo <<<EOF1
�����������͡�����DB�������������å������������������ץ��Υ؀��ࡢ�ۡ��ࡦ�����������Ρ������ޡ������ˡ��á���������������
�������ۡ��ࡦ�����������Ρ��ޡ��֥��ץ�ꦥ����ۡ����������͡��������ۥ��Υ؀����͡�������������⦥ҥΥ�إ顢�͡��ϡ�������������
<p><center>
<form action="{$_SERVER['PHP_SELF']}" method="post">
<input type="password" name="GUESTBOOKPASS">
<input type="submit" value=" �ۥ���� ">
</form>
</center></p>
EOF1;
    } else {
      echo "�����������͡��������ۥ��¥硢�ҥ����̥䡢������������������<br />";
    }
	}
  include "gbtrailer.php";
  exit;
} else {
  $dbh = gbdbopen($fn);
  if ($dbh === false) {
    echo "�����������͡�����DB($fn)���ҥ����奱�������̡��塢�����������ס���<br />";
    include("gbtrailer.php");
    exit;
  } else {
    $res = (int)gbdbtblexists($dbh, 'user_tbl');
    if (! $res ) {//"GUESTBOOKPASS"
	    // DB���ҡ��ࡦ�����������Ρ��ۥʥߥޥ�
	    $tuple = array( 'adm' => 1,
                      'name' => 'admin',
                      'pass' => $_POST['GUESTBOOKPASS']
                      );
	    
	    $ret = gbdbinsert($dbh, 'user_tbl', $tuple );
	    if ( empty($ret) ) {
        echo "���ࡦ�����������Ρ����ߥޥ���������������������<br />";
	    } else {
        echo "ERROR: ���ࡦ�����������Ρ��ۥʥߥޥ����ҥ����̥䡢������������������<br />";
	    }
    }
  }
  gbdbclose($dbh);
}
?>
