<?php
/*
 * �����������͡�����DB�������女����Ρ������ߡ���
 */
if($DEBUG)
{echo "{$_SERVER['PHP_SELF']}@<b>".__FILE__.":".__LINE__."</b><br />\n";};

// �Υ������ˀ�����������POST���̡��������ϥॽ���㡢�֡����ߡ�������꿀��塢�����
$days = 1;
if (isset($_POST['PASTDAYS'])) {
  if(strtoupper($_POST['PASTDAYS']) == "ALL") {
    $days = 0;
  } elseif (intval($_POST['PASTDAYS']) >= 0) {
    $days = intval($_POST['PASTDAYS']);
  }
} else {
  // �������ۥ��ۥ̥�
  if (!empty($_SERVER['argv'][1])) {
    $days = intval($_SERVER['argv'][1]);
  } else {
    if (! empty($_GET['days']) ) {
      $days = (int)$_GET['days'];
    }
  }
}
?>

<center>
<form action="<?php echo $_SERVER['PHP_SELF'];?>?mode=read" method="post">
���女��Υ��������ץ���<input type="text" size=4 maxlength=4
               name="PASTDAYS" value="<?php echo $days;?>">�ˀ���. (0 = �������女��)
</form>
</center>

<?php
echo "<center><strong>\n";
// �Υ������ˀ����ҡ�����롦���ۥ��졢�ĥꡢ��
switch($days){
 case 0:
   echo "�������女��Υ�����";
   break;
 case 1:
   echo "�ҥ�ˀ��ۥ��女��Υ�����";
   break;
 case 2:
   echo "�ҥ�ˀ��ͥ������ۥ��女��Υ�����";
   break;
 default:
   echo "���� $days �ˀ��㡢�ۥ��女��Υ�����";
   break;
}
echo "</strong></center>\n";

// �����������͡�����DB����������
$dbh = gbdbopen($fn);
if ($dbh == false) {
  echo "�����������͡�����DB($fn): �����������顦������򣥷����<br />";
  include("gbtrailer.php");
  exit;
} else {
// dbm ���ۥ����
// (1) DBM���桦���������������˥���������থҥʥ㥱����������롢�ˡ��ۥ��������Ρ������ߡ���
//	$datekey = dbmfirstkey($dbmid);
//	$i=0;
//	while($datekey){
//	  if($datekey!="GUESTBOOKPASS") {
//	    $keyday = intval(date("Y",$datekey))*365+date("z",$datekey);
//	    $today = intval(date("Y"))*365+date("z");
//	    if(($today - $keyday < $days) || $days==0) {
//	      $keys[$i] = $datekey;
//	      $i++;
//	    }
//	  } else {
//	    if($DEBUG)echo "GUESTBOOKPASS=\"".dbmfetch($dbmid,$datekey)."\"<br />\n";
//	  }
//	  $datekey = dbmnextkey($dbmid,$datekey);
//	}
// (2) ������ߡ��������������ۥ̥�ۀ������������͡������
//	if (is_array($keys)) sort($keys);
// (3) �����ա����楹ҥΥ������������ˡ�즥�
//	$j=$i-1;
//	while($j>=0){
//	  // DBM���桦��������������򺡼���ҥĥߥ����������̡�������������������㡢��
//	  $entry = dbmfetch($dbmid,$keys[$j]);
//	  // ���桦�ס��������Ρ��ޡ������衦���������Υ��¥졢�
//	  $name = strtok($entry,"\t");
//	  $email = strtok("\t");
//	  $comment = strtok("\t");
//	  $entrydate = date("D M d/y H:i:s",$keys[$j]);
//	  echo <<<EOF4
//	    <b><i>$name</i></b>
//	    &lt;<a href="mailto: $email">$email</a>&gt;
//	    <b>$entrydate</b>
//	    <font size=-1><a href="{$_SERVER['PHP_SELF']}?admin+$keys[$j]">
//	    &lt;entry id: $keys[$j]&gt;</a></font>
//	    <br>$comment<br>
//	EOF4;
//	    $j--;
//	}

  // SQL ���̡����������롣���������̡��ޡ��ϥ������ۡ��͡������
  if ( $days > 0 ) {
    $today = time();
    $stadate = $today - $days*3600*24;
    // Select rows
    $sql = "SELECT * FROM note_tbl WHERE date >= $stadate ORDER BY date DESC";
  } else {
    $sql = "SELECT * FROM note_tbl ORDER BY date DESC";
  }
  $res = $dbh->getAll($sql, DB_FETCHMODE_ASSOC);
  if (DB::isError($res)){
    $msg .= $res->getMessage()."\n";
    echo $msg;
  }
  
  // Output result
  echo "<table borderwith='0'>\n";
  foreach ($res as $row => $cols){
    $name = strip_tags($cols['name']);
    $email = strip_tags(implode(' at ',explode('@', $cols['mail'])));
    $comment = strip_tags($cols['note']);
    $entrydate = date("D M d Y H:i:s",$cols['date']);
    
    echo <<<EOF4
 <tr><td colspan='4'><br />$comment<br /></td></tr>
 <tr>
  <td><font size="-1"><b><i>$name</i></b></font></td>
  <td><font size="-1">&lt;<a href="mailto: $email">$email</a>&gt;</font></td>
  <td><font size="-1"><b>$entrydate</b></font></td>
  <td><font size="-2">&lt; <a href="{$_SERVER['PHP_SELF']}?mode=admin&date=${cols['date']}">Edit </a>${cols['date']} &gt;</font></td>
 </tr>
EOF4;
  }
  echo "</table>\n";
}
gbdbclose($dbh);
?>
