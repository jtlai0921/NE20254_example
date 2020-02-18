<?php
/*
 * 將留言內容寫入 GuestlogDB
 *
 */
if($DEBUG)
{echo "{$_SERVER['PHP_SELF']}@<b>".__FILE__.":".__LINE__."</b><br />\n";};

// 開啟 guestlogDB
$dbh = gbdbopen($fn);
if ($dbh == FALSE) {
  echo "開啟 guestlogDB ($fn) 的時候發生錯誤。<br />";
  include("gbtrailer.php");
  exit;
}
// 將留言資料追加到DB
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
	echo "謝謝。已成功儲存留言內容。<br />";
} else {
	echo "留言內容儲存失敗 ($ret)。<br />";
}
gbdbclose($dbh);
?>
