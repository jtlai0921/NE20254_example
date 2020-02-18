<?php
/*
 * DB¥¨¥Î¥Ø€€ðÏ€€¥Ä¥±¥ä
 */
if($DEBUG)
{echo "{$_SERVER['PHP_SELF']}@<b>".__FILE__.":".__LINE__."</b><br />\n";};

$dbh = gbdbopen($fn);
if ($dbh == FALSE) {
  echo "DB($fn): ¡¦¥§¡£¥·¡¦¥é¡¦€€¥£¡¦ò£¥·¡£¡×<br />";
  include("gbtrailer.php");
  exit;
}

// ¡¦¥¢¡£¥·¡¦¥±¡¢¥¨¡¢¥Í¡¢¥Û¥¹ðÏý
switch($_POST['GUESTBOOKFUNC']){
 case "clear":
   // ¥Á¥¨¥ª¥å¥³¥ï¥»¥Æ¥ªî
   $ret = gbdbdelete ($dbh, "note_tbl");
   echo "¥ª¥å¥³¥ï¡¢€€¥±¡¢¥ë¡¢¥Ë¥»¥Æ¥ªü¦¥­¡¢¡«¡¢¥­¡¢¥½¡£¡×<p>";
   break;
 case "delete":
   // ¥µ¥ê¥ÈôÈ€€€€¥Ï¥»ê¹¥ß¥¤â¦¥­¡¢¥½¥ª¥å¥³¥ï¡¢€€þ¿ü
   $days = (int)$_POST['GUESTBOOKARG'];
   $today = time();
   $stadate = $today - $days * 3600 * 24;;
   $condition = "date < $stadate";
   $ret = gbdbdelete ($dbh, "note_tbl", $condition);
   if ( $ret) {
	   echo "$stadate ¡¢¡«¡¢¥Ì¡¢¥Û¥ª¥å¥³¥ï¡¢€€þ¿€€¥­¡¢¡«¡¢¥­¡¢¥½¡£¡×<br />";
   } else {
	   echo "$stadate ¡¢¡«¡¢¥Ì¡¢¥Û¥ª¥å¥³¥ï¡¢¥Û¥³þ¿€€¥Ò¥·¥³¥Ì¥ä¡¢¥­¡¢¡«¡¢¥­¡¢¥½¡£¡×<br />";
   }
   break;
 case "change_password":
    // ¡¦¥à¡¦¥±¡¦þ£¥·¡¦¥Î¡¢¥Û¥±¥±¥½¥­
   $pass = $_POST['GUESTBOOKARG'];
   $ret = gbdbupdate ($dbh, 'user_tbl', 'pass', "'$pass'", "name = 'admin'");
   if (! empty($ret) ) {
     echo "¡¦¥à¡¦¥±¡¦þ£¥·¡¦¥Î¡¢¥Þ¥·¥³¥Ì¥ä¡¢¥­¡¢¡«¡¢¥­¡¢¥½($ret)¡£¡×<br />";
   } else {
     echo "¡¦¥à¡¦¥±¡¦þ£¥·¡¦¥Î¡¢€€¥à¥±¥±¡¢¥­¡¢¡«¡¢¥­¡¢¥½¡£¡×<br />";
   }
   break;
 case "edit":
   // ¥ª¥å¥³¥ï¥Ï¥à¥±¥±¥Ø¥à¡¢¥Û¡¦¥æ¡¦¥¥¡£¥·¡¦àË¥¹¥·¥£
   $condition = "date = ${_POST['GUESTBOOKARG']}";
   $entry=gbdbselect($dbh, 'note_tbl', '*', $condition);
   if (! is_array($entry) ) {
     echo "¥µ¥ê¥Èô¦¥Û¥ª¥å¥³¥ï({$_POST['GUESTBOOKARG']})¡¢¥Þ¥¯¥©¡¢¥È¡¢¥©¡¢ô¦¡«¡¢¥µ¡¢€€¡×<br />";
   } else {
     // ¡¦¥½¡¦¥è¥«ðÂ¥ì¡¢ô¦¥Û¡¦¥Ì¡£¥·¡¦¥½¡¢€€¥ã¥¤ò
     $name = $entry['name'];
     $email = $entry['mail'];
     $comment = $entry['note'];
     $entrydate = $entry['date'];
     // ¥ª¥å¥³¥ï¡¢¥Û¥Ï¥ä¥¹¥¯¡¦¥æ¡¦¥¥¡£¥·¡¦à
     include "gbeditform.php";
   }
   unset ($_POST['GUESTBOOKARG']);
   break;
 case "update":
   // ¥Ï¥à¥±¥±¥ËäÏ¥Ë¡¢¥Û¥Ï¥ó¥Ä¥¯
   $cols['name'] = "'{$_POST['EditGuestName']}'";
   $cols['mail'] = "'{$_POST['EditGuestEmail']}'";
   $cols['note'] = "'{$_POST['EditGuestComment']}'";
   $cond = "date = {$_POST['GUESTBOOKARG']}";
   $ret = gbdbupdatearray ($dbh, 'note_tbl', $cols, $cond);
   if (! empty($ret) ) {
     echo "¥ª¥å¥³¥ï¡¢¥Û¥±¥±¥½¥­¡¢¥Þ¥·¥³¥Ì¥ä¡¢¥­¡¢¡«¡¢¥­¡¢¥½($ret)¡£¡×<br />";
   } else {
     echo "¥Ï¥à¥±¥±¡¢¥­¡¢¥½¥ª¥å¥³¥ï¡¢€€¥ó¥Ä¥¯¡¢¥­¡¢¡«¡¢¥­¡¢¥½¡£¡×<br />";
   }
   break;
}
gbdbclose($dbh);
?>
