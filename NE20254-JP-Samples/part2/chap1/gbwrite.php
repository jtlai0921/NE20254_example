<?php
/*
 * ・イ・ケ・ネ・�А�DB、ヒオュコワ、����ュケ���
 *
 */
if($DEBUG)
{echo "{$_SERVER['PHP_SELF']}@<b>".__FILE__.":".__LINE__."</b><br />\n";};

// ・イ・ケ・ネ・�А�DB、��ォ、ッ
$dbh = gbdbopen($fn);
if ($dbh == FALSE) {
  echo "・イ・ケ・ネ・�А�DB($fn): ・ェ。シ・ラ・��ィ・鬘シ。」<br />";
  include("gbtrailer.php");
  exit;
}
// オュコワ・ヌ。シ・ソ、��B、ヒトノイテ、ケ、�
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
	echo "、「、熙ャ、ネ、ヲ、エ、カ、、、゛、キ、ソ。」オュコワ、オ、�Ε愁埋魯法���ノイテ、キ、゛、キ、ソ。」<br />";
} else {
	echo "オュコワ、ホナミマソ、ヒシコヌヤ、キ、゛、キ、ソ。ハ$ret。ヒ。」<br />";
}
gbdbclose($dbh);
?>
