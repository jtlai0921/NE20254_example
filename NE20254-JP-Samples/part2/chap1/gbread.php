<?php
/*
 * ・イ・ケ・ネ・�А�DB、ォ、魴ュコワ、��ノ、゜スミ、ケ
 */
if($DEBUG)
{echo "{$_SERVER['PHP_SELF']}@<b>".__FILE__.":".__LINE__."</b><br />\n";};

// ノスシィニ����゜ト遙「POST・ヌ。シ・ソハムソ��ャ、「、�Ε漾�������蠖��ュ、ケ、�
$days = 1;
if (isset($_POST['PASTDAYS'])) {
  if(strtoupper($_POST['PASTDAYS']) == "ALL") {
    $days = 0;
  } elseif (intval($_POST['PASTDAYS']) >= 0) {
    $days = intval($_POST['PASTDAYS']);
  }
} else {
  // ー����ホウホヌァ
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
オュコワノスシィ。」イ盞�<input type="text" size=4 maxlength=4
               name="PASTDAYS" value="<?php echo $days;?>">ニ��ャ. (0 = チエオュコワ)
</form>
</center>

<?php
echo "<center><strong>\n";
// ノスシィニ����ヒ、隍��鬣ル・�Ε曠織譟♯張蝓▲�
switch($days){
 case 0:
   echo "チエオュコワノスシィ";
   break;
 case 1:
   echo "ヒワニ��ホオュコワノスシィ";
   break;
 case 2:
   echo "ヒワニ��ネコ����ホオュコワノスシィ";
   break;
 default:
   echo "イ盞� $days ニ��ャ、ホオュコワノスシィ";
   break;
}
echo "</strong></center>\n";

// ・イ・ケ・ネ・�А�DB、��ォ、ッ
$dbh = gbdbopen($fn);
if ($dbh == false) {
  echo "・イ・ケ・ネ・�А�DB($fn): ・ェ。シ・ラ・��ィ・鬘シ。」<br />";
  include("gbtrailer.php");
  exit;
} else {
// dbm 、ホセ�試�ァ
// (1) DBM・ユ・。・、・�Ε�、鯔スシィエ��爨ヒナャケ遉ケ、�Ε院▲襦▲法▲曠�ー、��ノ、゜スミ、ケ
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
// (2) シ隍�織漾▲�、ソクー、ホヌロホ����ス。シ・ネ、ケ、�
//	if (is_array($keys)) sort($keys);
// (3) キ�乾奸���ユス遉ヒノスシィ、キ、ニ、讀ッ
//	$j=$i-1;
//	while($j>=0){
//	  // DBM・ユ・。・、・�Ε�、鮑ー、ヒツミア��ケ、�Д漫�シ・ソ、��郛。、オ、ャ、ケ
//	  $entry = dbmfetch($dbmid,$keys[$j]);
//	  // ・ユ・」。シ・�Д痢▲沺Ε宗Ε茵ΕΑ�シ・ノカ霏レ、�
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

  // SQL ・ヌ。シ・ソ・ル。シ・ケ、ヌ、マーハイシ、ホ、ネ、ェ、�
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
