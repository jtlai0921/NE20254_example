<?php
 /*
  * ・ム・ケ・��シ・ノ・チ・ァ・テ・ッ
  */
if($DEBUG)
{echo "{$_SERVER['PHP_SELF']}@<b>".__FILE__.":".__LINE__."</b><br />\n";};

// DB、��ォ、、、ニ・ム・ケ・��シ・ノ、��チ・ァ・テ・ッ、ケ、�
$dbh = gbdbopen($fn);
if ($dbh == FALSE) {
  echo "DB($fn): ・ェ。シ・ラ・��ィ・鬘シ。」<br>";
  include("gbtrailer.php");
  exit;
}
$res = (int)gbdbtblexists($dbh, 'user_tbl');
if (! $res ) {//"GUESTBOOKPASS"
  echo "エノヘ��ヤナミマソ、ャ、オ、�Ε法◆◆◆�、サ、��」<br>";
  gbdbclose($dbh);
  include("gbtrailer.php");
  exit;
}

$gpass = gbdbselect($dbh,"user_tbl", "pass", "name = 'admin'");
//if($DEBUG)echo "gpass=\"${gpass['pass']}\"<br>\n";
if ( $gpass['pass'] != "{$_POST['GUESTBOOKPASS']}" ) {
  if ("{$_POST['GUESTBOOKPASS']}" == "") {
    echo "・ム・ケ・��シ・ノ、ホサリト熙ャノャヘラ、ヌ、ケ。」<p>";
  } else {
    echo "・ム・ケ・��シ・ノ、��ヨー网ィ、ニ、、、゛、ケ。」<p>";
  }
  unset($_POST['GUESTBOOKPASS']);
  gbdbclose($dbh);
}
gbdbclose($dbh);
?>
