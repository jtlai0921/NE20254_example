<?php
/*
 * ¡¦¥¤¡¦¥±¡¦¥Í¡¦ú§¡¼DB¡¢¥©¡¢ò·¥å¥³¥ï¡¢€€¥Î¡¢¡¬¥¹¥ß¡¢¥±
 */
if($DEBUG)
{echo "{$_SERVER['PHP_SELF']}@<b>".__FILE__.":".__LINE__."</b><br />\n";};

// ¥Î¥¹¥·¥£¥Ë€€€€¡¬¥Èô£¡ÖPOST¡¦¥Ì¡£¥·¡¦¥½¥Ï¥à¥½€€¥ã¡¢¡Ö¡¢ø¦¥ß¡¼€€€€€€ê¿€€¥å¡¢¥±¡¢ë
$days = 1;
if (isset($_POST['PASTDAYS'])) {
  if(strtoupper($_POST['PASTDAYS']) == "ALL") {
    $days = 0;
  } elseif (intval($_POST['PASTDAYS']) >= 0) {
    $days = intval($_POST['PASTDAYS']);
  }
} else {
  // ¡¼€€€€¥Û¥¦¥Û¥Ì¥¡
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
¥ª¥å¥³¥ï¥Î¥¹¥·¥£¡£¡×¥¤â·î<input type="text" size=4 maxlength=4
               name="PASTDAYS" value="<?php echo $days;?>">¥Ë€€¥ã. (0 = ¥Á¥¨¥ª¥å¥³¥ï)
</form>
</center>

<?php
echo "<center><strong>\n";
// ¥Î¥¹¥·¥£¥Ë€€€€¥Ò¡¢ð¦ö§ò§¥ë¡¦ö¦¥Û¥¿¥ì¡¢ôÄ¥ê¡¢¥£
switch($days){
 case 0:
   echo "¥Á¥¨¥ª¥å¥³¥ï¥Î¥¹¥·¥£";
   break;
 case 1:
   echo "¥Ò¥ï¥Ë€€¥Û¥ª¥å¥³¥ï¥Î¥¹¥·¥£";
   break;
 case 2:
   echo "¥Ò¥ï¥Ë€€¥Í¥³€€€€¥Û¥ª¥å¥³¥ï¥Î¥¹¥·¥£";
   break;
 default:
   echo "¥¤â·î $days ¥Ë€€¥ã¡¢¥Û¥ª¥å¥³¥ï¥Î¥¹¥·¥£";
   break;
}
echo "</strong></center>\n";

// ¡¦¥¤¡¦¥±¡¦¥Í¡¦ú§¡¼DB¡¢€€¥©¡¢¥Ã
$dbh = gbdbopen($fn);
if ($dbh == false) {
  echo "¡¦¥¤¡¦¥±¡¦¥Í¡¦ú§¡¼DB($fn): ¡¦¥§¡£¥·¡¦¥é¡¦€€¥£¡¦ò£¥·¡£¡×<br />";
  include("gbtrailer.php");
  exit;
} else {
// dbm ¡¢¥Û¥»ø»î£¥¡
// (1) DBM¡¦¥æ¡¦¡£¡¦¡¢¡¦ö¦¥©¡¢òË¥¹¥·¥£¥¨€€à¦¥Ò¥Ê¥ã¥±î¦¥±¡¢ö¦¥±¡¢¥ë¡¢¥Ë¡¢¥Û¥¯¡¼¡¢€€¥Î¡¢¡¬¥¹¥ß¡¢¥±
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
// (2) ¥·ð¦ô¿¥ß¡¢¥­¡¢¥½¥¯¡¼¡¢¥Û¥Ì¥í¥Û€€€€¥¹¡£¥·¡¦¥Í¡¢¥±¡¢ë
//	if (is_array($keys)) sort($keys);
// (3) ¥­ö´¥Õ¡¢€€¥æ¥¹î¦¥Ò¥Î¥¹¥·¥£¡¢¥­¡¢¥Ë¡¢ì¦¥Ã
//	$j=$i-1;
//	while($j>=0){
//	  // DBM¡¦¥æ¡¦¡£¡¦¡¢¡¦ö¦¥©¡¢òº¡¼¡¢¥Ò¥Ä¥ß¥¢€€¥±¡¢ö§¥Ì¡£¥·¡¦¥½¡¢€€î¾¡£¡¢¥ª¡¢¥ã¡¢¥±
//	  $entry = dbmfetch($dbmid,$keys[$j]);
//	  // ¡¦¥æ¡¦¡×¡£¥·¡¦ö§¥Î¡¢¥Þ¡¦¥½¡¦¥è¡¦¥¦¡£¥·¡¦¥Î¥«ðÂ¥ì¡¢ê
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

  // SQL ¡¦¥Ì¡£¥·¡¦¥½¡¦¥ë¡£¥·¡¦¥±¡¢¥Ì¡¢¥Þ¡¼¥Ï¥¤¥·¡¢¥Û¡¢¥Í¡¢¥§¡¢ê
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
